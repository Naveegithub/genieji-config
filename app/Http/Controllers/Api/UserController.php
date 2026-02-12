<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\Users;
use App\Enums\CommonStatus;
use Illuminate\Support\Facades\DB;
use Exception;

class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = Users::create([
                'name'   => $request->name,
                'email'  => $request->email,
                'mobile' => $request->mobile,
                'status' => CommonStatus::ACTIVE,
            ]);

            // attach role
            // $user->roles()->attach($request->role_id);

            DB::commit();

            return response()->json([
                 'status'  => config('messages.STATUS_SUCCESS'),
                 'message' => config('messages.USER_CREATED'),
            //     'user_id' => $user->id,
             ]);

        } catch (Exception $e) {
            DB::rollBack();

            // 🔥 TEMPORARY: log real error
            logger()->error($e->getMessage());

            return response()->json([
                'status'  => config('messages.STATUS_ERROR'),
                'message' => config('messages.SOMETHING_WENT_WRONG'),
            ], 500);
        }
    }
} 

