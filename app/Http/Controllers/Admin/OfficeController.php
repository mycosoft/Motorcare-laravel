<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataTablesColumnsBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOfficeRequest;
use App\Http\Requests\Admin\UpdateOfficeRequest;
use App\Models\Office;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OfficeController extends Controller
{
    public function index(Request $request): View | JsonResponse
    {
        validate_permission('offices.read');

        $tableConfigs = (new DataTablesColumnsBuilder(Office::class))
            ->setName('name', 'Office Name')
            ->setName('type', 'Type')
            ->setName('city', 'City')
            ->setName('region', 'Region')
            ->setName('phone', 'Phone')
            ->setName('is_active', 'Status')
            ->removeColumns(['deleted_at', 'created_at', 'updated_at', 'address', 'email', 'latitude', 'longitude', 'services', 'working_hours', 'manager_name', 'manager_phone', 'description', 'image'])
            ->withActions()
            ->make();

        if ($request->ajax()) {
            $query = Office::query()->orderBy('city');

            return DataTables::of($query)
                ->addColumn('type', function ($office) {
                    $badges = [
                        'branch' => 'badge-primary',
                        'service_center' => 'badge-success',
                        'parts_center' => 'badge-warning'
                    ];
                    $badgeClass = $badges[$office->type] ?? 'badge-secondary';
                    return "<span class='badge {$badgeClass}'>" . ucfirst(str_replace('_', ' ', $office->type)) . "</span>";
                })
                ->addColumn('is_active', function ($office) {
                    return $office->is_active 
                        ? '<span class="badge badge-success">Active</span>' 
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('actions', function ($office) {
                    $actions = '';

                    if (auth()->user()->can('offices.update')) {
                        $actions .= '<a href="' . route('admin.offices.edit', $office) . '" class="btn btn-sm btn-primary mr-1">
                            <i class="fas fa-edit"></i>
                        </a>';
                    }

                    if (auth()->user()->can('offices.delete')) {
                        $actions .= '<button type="button" class="btn btn-sm btn-danger" onclick="deleteRecord(' . $office->id . ')">
                            <i class="fas fa-trash"></i>
                        </button>';
                    }

                    return $actions;
                })
                ->rawColumns(['type', 'is_active', 'actions'])
                ->make(true);
        }

        return view('admin.offices.index', compact('tableConfigs'));
    }

    public function create(): View
    {
        validate_permission('offices.create');
        return view('admin.offices.create');
    }

    public function store(StoreOfficeRequest $request): RedirectResponse
    {
        validate_permission('offices.create');

        DB::transaction(function () use ($request) {
            $data = $request->validated();
            
            // Handle services array
            if ($request->has('services')) {
                $data['services'] = $request->input('services');
            }
            
            // Handle working hours
            $data['working_hours'] = [
                'monday_friday' => $request->input('monday_friday'),
                'saturday' => $request->input('saturday'),
                'sunday' => $request->input('sunday', 'Closed')
            ];

            Office::create($data);
        });

        return redirect()
            ->route('admin.offices.index')
            ->with('success', 'Office created successfully!');
    }

    public function edit(Office $office): View
    {
        validate_permission('offices.update');
        return view('admin.offices.edit', compact('office'));
    }

    public function update(UpdateOfficeRequest $request, Office $office): RedirectResponse
    {
        validate_permission('offices.update');

        DB::transaction(function () use ($request, $office) {
            $data = $request->validated();
            
            // Handle services array
            if ($request->has('services')) {
                $data['services'] = $request->input('services');
            }
            
            // Handle working hours
            $data['working_hours'] = [
                'monday_friday' => $request->input('monday_friday'),
                'saturday' => $request->input('saturday'),
                'sunday' => $request->input('sunday', 'Closed')
            ];

            $office->update($data);
        });

        return redirect()
            ->route('admin.offices.index')
            ->with('success', 'Office updated successfully!');
    }

    public function destroy(Office $office): RedirectResponse
    {
        validate_permission('offices.delete');

        $office->delete();
        
        return redirect()
            ->route('admin.offices.index')
            ->with('success', 'Office deleted successfully!');
    }
}
