<?php

namespace App\Services;

use App\Models\SysActivity;
use Illuminate\Http\Request;

class SystemActivityService
{
    public function log(Request $request,string $action,string $module,string $description)
    :SysActivity {
        return SysActivity::create([
            'user_id' => $request->user()?->id,
            'action' => $action,
            'module' => $module,
            'description' => $description,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }
}