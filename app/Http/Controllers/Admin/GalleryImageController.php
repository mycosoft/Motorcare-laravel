<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryImageRequest;
use App\Http\Requests\Admin\UpdateGalleryImageRequest;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryImageController extends Controller
{
    public function index(Gallery $gallery): View
    {
        validate_permission('galleries.read');
        $images = $gallery->images()->orderBy('order')->get();
        return view('admin.gallery-images.index', compact('gallery', 'images'));
    }

    public function create(Gallery $gallery): View
    {
        validate_permission('galleries.create');
        return view('admin.gallery-images.create', compact('gallery'));
    }

    public function store(Request $request, Gallery $gallery)
    {
        validate_permission('galleries.create');

        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::transaction(function () use ($request, $gallery) {
            foreach ($request->file('images', []) as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $path = 'uploads/gallery/' . $gallery->id;

                // Create directory if it doesn't exist
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0777, true);
                }

                $image->move(public_path($path), $filename);
                $gallery->images()->create([
                    'image_path' => $path . '/' . $filename,
                    'alt_text' => '',
                    'is_featured' => false,
                ]);
            }
        });

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()
            ->route('admin.galleries.images.index', $gallery->id)
            ->with('success', 'Images added successfully!');
    }

    public function edit(Gallery $gallery, GalleryImage $image): View
    {
        validate_permission('galleries.update');
        return view('admin.gallery-images.edit', compact('gallery', 'image'));
    }

    public function update(UpdateGalleryImageRequest $request, Gallery $gallery, GalleryImage $image): RedirectResponse
    {
        validate_permission('galleries.update');

        DB::transaction(function () use ($request, $gallery, $image) {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                // Delete old image
                if ($image->image_path && file_exists(public_path($image->image_path))) {
                    unlink(public_path($image->image_path));
                }

                $newImage = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $newImage->getClientOriginalExtension();
                $path = 'uploads/gallery/' . $gallery->id;

                // Create directory if it doesn't exist
                if (!file_exists(public_path($path))) {
                    mkdir(public_path($path), 0777, true);
                }

                $newImage->move(public_path($path), $filename);
                $data['image_path'] = $path . '/' . $filename;
            }

            $image->update($data);
        });

        return redirect()
            ->route('admin.galleries.images.index', $gallery->id)
            ->with('success', 'Image updated successfully!');
    }

    public function destroy(Gallery $gallery, GalleryImage $image): JsonResponse
    {
        validate_permission('galleries.delete');

        // Ensure the image belongs to the gallery
        if ($image->gallery_id !== $gallery->id) {
            abort(404);
        }

        DB::transaction(function () use ($image) {
            if ($image->image_path && file_exists(public_path($image->image_path))) {
                unlink(public_path($image->image_path));
            }
            $image->delete();
        });

        return response()->json(['success' => true]);
    }

    public function reorder(Request $request, Gallery $gallery): JsonResponse
    {
        validate_permission('galleries.update');

        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|exists:gallery_images,id',
            'images.*.order' => 'required|integer|min:0'
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->images as $item) {
                GalleryImage::where('id', $item['id'])->update(['order' => $item['order']]);
            }
        });

        return response()->json(['success' => true]);
    }
} 