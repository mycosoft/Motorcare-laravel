<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataTablesColumnsBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTeamRequest;
use App\Http\Requests\Admin\UpdateTeamRequest;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Blade;
use Yajra\DataTables\DataTables;

class TeamController extends Controller
{
    public function index(Request $request): View | JsonResponse
    {
        validate_permission('teams.read');

        $tableConfigs = (new DataTablesColumnsBuilder(Team::class))
            ->setName('full_name', 'Full Name')
            ->setName('position', 'Position')
            ->withActions()
            ->removeColumns(['deleted_at', 'updated_at'])
            ->make();

        if ($request->ajax()) {
            $query = Team::query();
            
            return DataTables::of($query)
                ->addColumn('actions', function ($team) {
                    $editBtn = '';
                    $deleteBtn = '';
                    
                    if (auth()->user()->can('teams.update')) {
                        $editBtn = '<a href="' . route('admin.teams.edit', $team->id) . '" class="btn btn-sm btn-default mr-1">Edit</a>';
                    }
                    
                    if (auth()->user()->can('teams.delete')) {
                        $deleteBtn = '<button type="button" class="btn btn-sm btn-danger delete-btn" data-destroy="' . route('admin.teams.destroy', $team->id) . '">Delete</button>';
                    }
                    
                    return '<div class="btn-group">' . $editBtn . $deleteBtn . '</div>';
                })
                ->addColumn('image', function ($team) {
                    return '<img src="' . $team->image_url . '" alt="' . $team->full_name . '" class="img-circle" style="width: 40px; height: 40px; object-fit: cover;">';
                })
                ->editColumn('created_at', function ($team) {
                    return $team->formatted_created_at;
                })
                ->rawColumns(['image', 'actions'])
                ->toJson();
        }

        return view('admin.teams.index', compact('tableConfigs'));
    }

    public function create(): View
    {
        validate_permission('teams.create');
        return view('admin.teams.create');
    }

    public function store(StoreTeamRequest $request): RedirectResponse
    {
        validate_permission('teams.create');

        DB::transaction(function () use ($request) {
            $data = $request->validated();
            
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                // Create directory if it doesn't exist
                $path = public_path('uploads/team');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $image->move($path, $filename);
                $data['image'] = $filename;
            }

            Team::create($data);
        });

        return redirect()
            ->route('admin.teams.index')
            ->with('success', 'Team member created successfully!');
    }

    public function edit(Team $team): View
    {
        validate_permission('teams.update');
        return view('admin.teams.edit', compact('team'));
    }

    public function update(UpdateTeamRequest $request, Team $team): RedirectResponse
    {
        validate_permission('teams.update');

        DB::transaction(function () use ($request, $team) {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($team->image) {
                    $oldImage = public_path('uploads/team/' . $team->image);
                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }
                }
                
                $image = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                // Create directory if it doesn't exist
                $path = public_path('uploads/team');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $image->move($path, $filename);
                $data['image'] = $filename;
            }

            $team->update($data);
        });

        return redirect()
            ->route('admin.teams.index')
            ->with('success', 'Team member updated successfully!');
    }

    public function destroy(Team $team): JsonResponse
    {
        validate_permission('teams.delete');

        DB::transaction(function () use ($team) {
            // Delete image if exists
            if ($team->image) {
                $imagePath = public_path('uploads/team/' . $team->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            $team->delete();
        });

        return response()->json(['success' => true]);
    }
}
