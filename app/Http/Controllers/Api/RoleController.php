<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Models\Role;
use App\Enums\CommonStatus;
use Exception;

class RoleController extends Controller
{
    public function store(StoreRoleRequest $request)
    {
        try {
            $role = Role::create([
                'name'        => $request->name,
                'description' => $request->description,
                'status'      => CommonStatus::ACTIVE,
            ]);

            return response()->json([
                'status'  => config('messages.STATUS_SUCCESS'),
                'message' => config('messages.ROLE_CREATED'),
                'role_id' => $role->id,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status'  => config('messages.STATUS_ERROR'),
                'message' => config('messages.SOMETHING_WENT_WRONG'),
            ], 500);
        }
    }
}
