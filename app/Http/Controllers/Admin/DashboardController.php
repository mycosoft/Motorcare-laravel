<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\Office;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        validate_permission('dashboard.read');

        // Get basic counts
        $stats = [
            'roles' => Role::count(),
            'permissions' => Permission::count(),
            'teams' => Team::count(),
            'brands' => Brand::count(),
            'galleries' => Gallery::count(),
            'gallery_categories' => GalleryCategory::count(),
            'offices' => Office::count(),
            'contacts' => Contact::count(),
            'unread_contacts' => Contact::unread()->count(),
        ];

        // Recent activities
        $recentContacts = Contact::with([])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();



        // Featured galleries
        $featuredGalleries = Gallery::with(['category', 'images'])
            ->where('is_featured', true)
            ->where('is_active', true)
            ->limit(6)
            ->get();

        return view('admin.dashboard.index', compact(
            'stats',
            'recentContacts',
            'featuredGalleries'
        ));
    }
}
