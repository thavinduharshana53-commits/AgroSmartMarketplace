<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SystemActivityService;
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

    public function updateStatus(Request $request,User $user, SystemActivityService $activityService) {

        // Admin accounts cannot be modified from this page.
        abort_if(
            $user->role === 'admin',
            403,
            'Administrator accounts cannot be modified.'
        );

        // Prevent the logged-in admin from changing their own account.
        abort_if(
            (int) $user->id === (int) $request->user()->id,
            403,
            'You cannot change your own account status.'
        );

        $validated = $request->validate([
            'account_status' => ['required','in:active,blocked',],
        ]);

        $newStatus = $validated['account_status'];
        $currentStatus = strtolower($user->account_status);

        // Do not create duplicate activity records.
        if ($currentStatus === $newStatus) {
            return back()->with('error',"This account is already {$newStatus}.");
        }

        $user->update([
            'account_status' => $newStatus,
        ]);

        if ($newStatus === 'blocked') {
            $action = 'User Blocked';

            $description =
                "Blocked {$user->role} account '{$user->name}' " .
                "(User ID: {$user->id}, Email: {$user->email}).";

            $message = "{$user->name}'s account was blocked successfully.";
        } else {
            $action = 'User Activated';

            $description =
                "Activated {$user->role} account '{$user->name}' " .
                "(User ID: {$user->id}, Email: {$user->email}).";

            $message = "{$user->name}'s account was activated successfully.";
        }

        $activityService->log(
            request: $request,
            action: $action,
            module: 'User Management',
            description: $description
        );

        return back()->with('success', $message);
    }
}