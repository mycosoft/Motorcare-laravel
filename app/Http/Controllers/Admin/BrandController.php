<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataTablesColumnsBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBrandRequest;
use App\Http\Requests\Admin\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    public function index(Request $request): View | JsonResponse
    {
        validate_permission('brands.read');

        $tableConfigs = (new DataTablesColumnsBuilder(Brand::class))
            ->setName('name', 'Name')
            ->setName('link', 'Website')
            ->withActions()
            ->removeColumns(['deleted_at', 'updated_at', 'description'])
            ->make();

        if ($request->ajax()) {
            $query = Brand::query();
            
            return DataTables::of($query)
                ->addColumn('logo', function ($brand) {
                    return '<img src="' . $brand->logo_url . '" alt="' . $brand->name . '" class="img-circle" style="width: 40px; height: 40px; object-fit: contain;">';
                })
                ->addColumn('link', function ($brand) {
                    return $brand->link ? '<a href="' . $brand->link . '" target="_blank">' . parse_url($brand->link, PHP_URL_HOST) . '</a>' : '-';
                })
                ->addColumn('actions', function ($brand) {
                    $editBtn = '';
                    $deleteBtn = '';
                    
                    if (auth()->user()->can('brands.update')) {
                        $editBtn = '<a href="' . route('admin.brands.edit', $brand->id) . '" class="btn btn-sm btn-default mr-1">Edit</a>';
                    }
                    
                    if (auth()->user()->can('brands.delete')) {
                        $deleteBtn = '<button type="button" class="btn btn-sm btn-danger delete-btn" data-destroy="' . route('admin.brands.destroy', $brand->id) . '">Delete</button>';
                    }
                    
                    return '<div class="btn-group">' . $editBtn . $deleteBtn . '</div>';
                })
                ->editColumn('created_at', function ($brand) {
                    return $brand->formatted_created_at;
                })
                ->rawColumns(['logo', 'link', 'actions'])
                ->toJson();
        }

        return view('admin.brands.index', compact('tableConfigs'));
    }

    public function create(): View
    {
        validate_permission('brands.create');
        return view('admin.brands.create');
    }

    public function store(StoreBrandRequest $request): RedirectResponse
    {
        validate_permission('brands.create');

        DB::transaction(function () use ($request) {
            $data = $request->validated();
            
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                // Create directory if it doesn't exist
                $path = public_path('uploads/brands');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $image->move($path, $filename);
                $data['logo'] = $filename;
            }

            Brand::create($data);
        });

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand created successfully!');
    }

    public function edit(Brand $brand): View
    {
        validate_permission('brands.update');
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand): RedirectResponse
    {
        validate_permission('brands.update');

        DB::transaction(function () use ($request, $brand) {
            $data = $request->validated();

            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($brand->logo) {
                    $oldLogo = public_path('uploads/brands/' . $brand->logo);
                    if (file_exists($oldLogo)) {
                        unlink($oldLogo);
                    }
                }
                
                $image = $request->file('logo');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                // Create directory if it doesn't exist
                $path = public_path('uploads/brands');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $image->move($path, $filename);
                $data['logo'] = $filename;
            }

            $brand->update($data);
        });

        return redirect()
            ->route('admin.brands.index')
            ->with('success', 'Brand updated successfully!');
    }

    public function destroy(Brand $brand): JsonResponse
    {
        validate_permission('brands.delete');

        DB::transaction(function () use ($brand) {
            // Delete logo if exists
            if ($brand->logo) {
                $logoPath = public_path('uploads/brands/' . $brand->logo);
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }
            $brand->delete();
        });

        return response()->json(['success' => true]);
    }
}
