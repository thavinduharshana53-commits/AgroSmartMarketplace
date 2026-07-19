<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManageController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'role' => ['nullable', 'in:buyer,farmer'],
            'status' => ['nullable', 'in:active,blocked'],
        ]);

        $search = trim($validated['search'] ?? '');
        $role = $validated['role'] ?? '';
        $status = $validated['status'] ?? '';

        $users = User::query()
            // Admin accounts are not displayed here.
            ->whereIn('role', ['buyer', 'farmer'])

            ->when(
                $search !== '',
                function ($query) use ($search) {
                    $query->where(function ($userQuery) use ($search) {
                        $userQuery
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('district', 'like', "%{$search}%")
                            ->orWhere('city', 'like', "%{$search}%");
                    });
                }
            )

            ->when(
                $role !== '',
                fn ($query) => $query->where('role', $role)
            )

            ->when(
                $status !== '',
                fn ($query) => $query->where('account_status', $status)
            )

            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.userManage',
            compact(
                'users',
                'search',
                'role',
                'status'
            )
        );
    }

    public function updateStatus(Request $request, User $user)
    {
        // Admin accounts cannot be blocked from this page.
        abort_if(
            $user->role === 'admin',
            403,
            'Administrator accounts cannot be modified.'
        );

        $validated = $request->validate(['account_status' => ['required', 'in:active,blocked',],]);

        $user->update(['account_status' => $validated['account_status'],]);

        $message = $validated['account_status'] === 'blocked'
            ? "{$user->name}'s account was blocked successfully."
            : "{$user->name}'s account was activated successfully.";

        return back()->with('success', $message);
    }
}