<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function home()
    {
        return view('welcome');
    }

    /**
     * Display the about us page.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display the contact us page.
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Handle contact form submission.
     */
    public function submitContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'inquiry_type' => 'required|in:general,sales,service,parts'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please check your form and try again.');
        }

        try {
            Contact::create($request->all());

            return back()
                ->with('success', 'Thank you for your message! We will get back to you soon.')
                ->withInput([]);
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Something went wrong. Please try again later.')
                ->withInput();
        }
    }

    /**
     * Display the services page.
     */
    public function services()
    {
        return view('services');
    }

    /**
     * Display the gallery page.
     */
    public function gallery()
    {
        $categories = GalleryCategory::where('is_active', true)
            ->with(['galleries' => function($query) {
                $query->where('is_active', true)
                      ->with(['images' => function($imageQuery) {
                          $imageQuery->orderBy('order');
                      }]);
            }])
            ->get();

        $featuredGalleries = Gallery::where('is_active', true)
            ->where('is_featured', true)
            ->with(['images' => function($query) {
                $query->orderBy('order');
            }, 'category'])
            ->get();

        return view('gallery', compact('categories', 'featuredGalleries'));
    }

    /**
     * Display the brands page.
     */
    public function brands()
    {
        $brands = Brand::orderBy('name')->get();
        return view('brands', compact('brands'));
    }

    /**
     * Display the people care page.
     */
    public function peopleCare()
    {
        return view('people-care');
    }
}
