<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataTablesColumnsBuilder;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View | JsonResponse
    {
        validate_permission('contacts.read');

        $tableConfigs = (new DataTablesColumnsBuilder(Contact::class))
            ->setName('name', 'Name')
            ->setName('email', 'Email')
            ->setName('subject', 'Subject')
            ->setName('inquiry_type', 'Type')
            ->setName('is_read', 'Status')
            ->setName('created_at', 'Received At')
            ->withActions()
            ->removeColumns(['updated_at', 'read_at', 'phone', 'message'])
            ->make();

        if ($request->ajax()) {
            $query = Contact::query()->orderBy('created_at', 'desc');

            return DataTables::of($query)
                ->addColumn('actions', function ($contact) {
                    $viewBtn = '';
                    $deleteBtn = '';

                    if (auth()->user()->can('contacts.read')) {
                        $viewBtn = '<a href="' . route('admin.contacts.show', $contact->id) . '" class="btn btn-sm btn-info mr-1">View</a>';
                    }

                    if (auth()->user()->can('contacts.delete')) {
                        $deleteBtn = '<button type="button" class="btn btn-sm btn-danger delete-btn" data-destroy="' . route('admin.contacts.destroy', $contact->id) . '">Delete</button>';
                    }

                    return '<div class="btn-group">' . $viewBtn . $deleteBtn . '</div>';
                })
                ->editColumn('is_read', function ($contact) {
                    if ($contact->is_read) {
                        return '<span class="badge badge-success">Read</span>';
                    } else {
                        return '<span class="badge badge-warning">Unread</span>';
                    }
                })
                ->editColumn('inquiry_type', function ($contact) {
                    $types = [
                        'general' => 'General',
                        'sales' => 'Sales',
                        'service' => 'Service',
                        'parts' => 'Parts'
                    ];
                    return $types[$contact->inquiry_type] ?? ucfirst($contact->inquiry_type);
                })
                ->editColumn('created_at', function ($contact) {
                    return $contact->created_at->format('M d, Y H:i');
                })
                ->editColumn('subject', function ($contact) {
                    return '<span title="' . htmlspecialchars($contact->subject) . '">' .
                           \Str::limit($contact->subject, 30) . '</span>';
                })
                ->rawColumns(['actions', 'is_read', 'subject'])
                ->toJson();
        }

        return view('admin.contacts.index', compact('tableConfigs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact): View
    {
        validate_permission('contacts.read');

        // Mark as read when viewed
        if (!$contact->is_read) {
            $contact->markAsRead();
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        validate_permission('contacts.delete');

        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Contact message deleted successfully!');
    }

    /**
     * Mark contact as read/unread
     */
    public function toggleRead(Contact $contact): RedirectResponse
    {
        validate_permission('contacts.update');

        if ($contact->is_read) {
            $contact->update(['is_read' => false, 'read_at' => null]);
            $message = 'Contact marked as unread.';
        } else {
            $contact->markAsRead();
            $message = 'Contact marked as read.';
        }

        return redirect()
            ->route('admin.contacts.show', $contact)
            ->with('success', $message);
    }
}
