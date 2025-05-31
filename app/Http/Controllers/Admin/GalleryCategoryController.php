<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataTablesColumnsBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryCategoryRequest;
use App\Http\Requests\Admin\UpdateGalleryCategoryRequest;
use App\Models\GalleryCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class GalleryCategoryController extends Controller
{
    public function index(Request $request): View | JsonResponse
    {
        validate_permission('gallery_categories.read');

        $tableConfigs = (new DataTablesColumnsBuilder(GalleryCategory::class))
            ->setName('name', 'Name')
            ->setName('description', 'Description')
            ->withActions()
            ->removeColumns(['deleted_at', 'updated_at'])
            ->make();

        if ($request->ajax()) {
            $query = GalleryCategory::query();
            
            return DataTables::of($query)
                ->addColumn('actions', function ($category) {
                    $editBtn = '';
                    $deleteBtn = '';
                    
                    if (auth()->user()->can('gallery_categories.update')) {
                        $editBtn = '<a href="' . route('admin.gallery-categories.edit', $category->id) . '" class="btn btn-sm btn-default mr-1">Edit</a>';
                    }
                    
                    if (auth()->user()->can('gallery_categories.delete')) {
                        $deleteBtn = '<button type="button" class="btn btn-sm btn-danger delete-btn" data-destroy="' . route('admin.gallery-categories.destroy', $category->id) . '">Delete</button>';
                    }
                    
                    return '<div class="btn-group">' . $editBtn . $deleteBtn . '</div>';
                })
                ->editColumn('created_at', function ($category) {
                    return $category->formatted_created_at;
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        return view('admin.gallery-categories.index', compact('tableConfigs'));
    }

    public function create(): View
    {
        validate_permission('gallery_categories.create');
        return view('admin.gallery-categories.create');
    }

    public function store(StoreGalleryCategoryRequest $request): RedirectResponse
    {
        validate_permission('gallery_categories.create');

        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['slug'] = \Str::slug($data['name']);
            // Ensure is_active is set to 0 or 1
            $data['is_active'] = $request->has('is_active') ? 1 : 0;
            GalleryCategory::create($data);
        });

        return redirect()
            ->route('admin.gallery-categories.index')
            ->with('success', 'Gallery category created successfully!');
    }

    public function edit(GalleryCategory $galleryCategory): View
    {
        validate_permission('gallery_categories.update');
        return view('admin.gallery-categories.edit', compact('galleryCategory'));
    }

    public function update(UpdateGalleryCategoryRequest $request, GalleryCategory $galleryCategory): RedirectResponse
    {
        validate_permission('gallery_categories.update');

        DB::transaction(function () use ($request, $galleryCategory) {
            $data = $request->validated();
            $data['slug'] = \Str::slug($data['name']);
            $data['is_active'] = $request->has('is_active') ? 1 : 0;
            $galleryCategory->update($data);
        });

        return redirect()
            ->route('admin.gallery-categories.index')
            ->with('success', 'Gallery category updated successfully!');
    }

    public function destroy(GalleryCategory $galleryCategory): RedirectResponse|JsonResponse
    {
        validate_permission('gallery_categories.delete');

        DB::transaction(function () use ($galleryCategory) {
            $galleryCategory->delete();
        });

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()
            ->route('admin.gallery-categories.index')
            ->with('success', 'Gallery category deleted successfully!');
    }
} 