<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataTablesColumnsBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryRequest;
use App\Http\Requests\Admin\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class GalleryController extends Controller
{
    public function index(Request $request): View | JsonResponse
    {
        validate_permission('galleries.read');

        $tableConfigs = (new DataTablesColumnsBuilder(Gallery::class))
            ->setName('title', 'Title')
            ->setName('category_id', 'Category')
            ->setName('is_featured', 'Featured')
            ->setName('is_active', 'Status')
            ->setName('created_at', 'Created At')
            ->withActions()
            ->removeColumns(['deleted_at', 'updated_at', 'description', 'slug'])
            ->make();

        if ($request->ajax()) {
            $query = Gallery::with('category');
            
            return DataTables::of($query)
                ->addColumn('category_id', function ($gallery) {
                    return $gallery->category->name;
                })
                ->addColumn('is_featured', function ($gallery) {
                    return $gallery->is_featured ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-secondary">No</span>';
                })
                ->addColumn('is_active', function ($gallery) {
                    return $gallery->is_active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('actions', function ($gallery) {
                    $editBtn = '';
                    $deleteBtn = '';
                    $imagesBtn = '';
                    
                    if (auth()->user()->can('galleries.update')) {
                        $editBtn = '<a href="' . route('admin.galleries.edit', $gallery->id) . '" class="btn btn-sm btn-default mr-1">Edit</a>';
                    }
                    
                    if (auth()->user()->can('galleries.delete')) {
                        $deleteBtn = '<button type="button" class="btn btn-sm btn-danger delete-btn" data-destroy="' . route('admin.galleries.destroy', $gallery->id) . '">Delete</button>';
                    }

                    if (auth()->user()->can('galleries.read')) {
                        $imagesBtn = '<a href="' . route('admin.galleries.images.index', $gallery->id) . '" class="btn btn-sm btn-info mr-1">Images</a>';
                    }
                    
                    return '<div class="btn-group">' . $editBtn . $imagesBtn . $deleteBtn . '</div>';
                })
                ->editColumn('created_at', function ($gallery) {
                    return $gallery->created_at ? $gallery->created_at->format('Y-m-d H:i') : '';
                })
                ->rawColumns(['is_featured', 'is_active', 'actions'])
                ->toJson();
        }

        return view('admin.galleries.index', compact('tableConfigs'));
    }

    public function create(): View
    {
        validate_permission('galleries.create');
        $categories = GalleryCategory::where('is_active', true)->get();
        return view('admin.galleries.create', compact('categories'));
    }

    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        validate_permission('galleries.create');

        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['slug'] = \Str::slug($data['title']);
            $data['is_active'] = $request->input('is_active', 0);
            $data['is_featured'] = $request->input('is_featured', 0);
            Gallery::create($data);
        });

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery created successfully!');
    }

    public function edit(Gallery $gallery): View
    {
        validate_permission('galleries.update');
        $categories = GalleryCategory::where('is_active', true)->get();
        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        validate_permission('galleries.update');

        DB::transaction(function () use ($request, $gallery) {
            $data = $request->validated();
            $data['slug'] = \Str::slug($data['title']);
            $data['is_active'] = $request->input('is_active', 0);
            $data['is_featured'] = $request->input('is_featured', 0);
            $gallery->update($data);
        });

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery updated successfully!');
    }

    public function destroy(Gallery $gallery): RedirectResponse|JsonResponse
    {
        validate_permission('galleries.delete');

        DB::transaction(function () use ($gallery) {
            // Delete associated images
            foreach ($gallery->images as $image) {
                if (file_exists(public_path($image->image_path))) {
                    unlink(public_path($image->image_path));
                }
            }
            $gallery->delete();
        });

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery deleted successfully!');
    }
} 