<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SysActivity;
use Illuminate\Http\Request;

class SystemActivityController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable','string','max:100',],

            'module' => ['nullable','in:User Management,Product Management',],

            'action' => ['nullable','string','max:100',],

            'date' => ['nullable','date',],
        ]);

        $search = trim($validated['search'] ?? '');
        $module = $validated['module'] ?? '';
        $action = trim($validated['action'] ?? '');
        $date = $validated['date'] ?? '';

        $activities = SysActivity::with('user')
            ->when(
                $search !== '',
                function ($query) use ($search) {
                    $query->where(
                        function ($activityQuery) use ($search) {
                            $activityQuery
                                ->where(
                                    'action',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'description',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhere(
                                    'ip_address',
                                    'like',
                                    "%{$search}%"
                                )
                                ->orWhereHas(
                                    'user',
                                    function ($userQuery) use ($search) {
                                        $userQuery
                                            ->where(
                                                'name',
                                                'like',
                                                "%{$search}%"
                                            )
                                            ->orWhere(
                                                'email',
                                                'like',
                                                "%{$search}%"
                                            );
                                    }
                                );
                        }
                    );
                }
            )
            ->when(
                $module !== '',
                fn ($query) =>
                    $query->where('module', $module)
            )
            ->when(
                $action !== '',
                fn ($query) =>
                    $query->where('action', $action)
            )
            ->when(
                $date !== '',
                fn ($query) =>
                    $query->whereDate('created_at', $date)
            )
            ->latest('activity_id')
            ->paginate(12)
            ->withQueryString();

        $modules = SysActivity::query()
            ->select('module')
            ->distinct()
            ->orderBy('module')
            ->pluck('module');

        $actions = SysActivity::query()
            ->select('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        return view(
            'admin.systemActivity',
            compact(
                'activities',
                'modules',
                'actions',
                'search',
                'module',
                'action',
                'date'
            )
        );
    }
}