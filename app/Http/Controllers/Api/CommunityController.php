<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommunityRequest;
use App\Models\State;
use App\Models\City;
use App\Models\Community;
use App\Enums\CommonStatus;
use Illuminate\Support\Facades\DB;
use Exception;

class CommunityController extends Controller
{
    public function store(StoreCommunityRequest $request)
    {
        try {
            DB::beginTransaction();

            // 1️⃣ Check or Create State
            $state = State::firstOrCreate(
                ['name' => $request->state['name']],
                ['status' => CommonStatus::ACTIVE]
            );

            // 2️⃣ Check or Create City
            $city = City::firstOrCreate(
                [
                    'name' => $request->city['name'],
                    'state_id' => $state->id
                ],
                ['status' => CommonStatus::ACTIVE]
            );

            // 3️⃣ Check or Create Community
            $community = Community::firstOrCreate(
                [
                    'community_name' => $request->community['community_name'],
                    'city_id' => $city->id
                ],
                ['status' => CommonStatus::ACTIVE]
            );

            DB::commit();

            return response()->json([
                'status' => config('messages.STATUS_SUCCESS'),
                'message' => config('messages.COMMUNITY_CREATED'),
                'community_id' => $community->id
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            logger()->error($e->getMessage());

            return response()->json([
                'status' => config('messages.STATUS_ERROR'),
                'message' => config('messages.SOMETHING_WENT_WRONG')
            ], 500);
        }
    }
}
