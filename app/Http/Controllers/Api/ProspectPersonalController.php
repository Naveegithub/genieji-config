<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProspectPersonalRequest;
use App\Models\ProspectPersonal;
use App\Enums\CommonStatus;
use Illuminate\Support\Facades\DB;
use Exception;

class ProspectPersonalController extends Controller
{
    public function store(StoreProspectPersonalRequest $request)
    {
        try {
            DB::beginTransaction();

            $mobile = $request->mobile;

            // Versioning
            $latestVersion = ProspectPersonal::where('mobile', $mobile)->max('version');
            $newVersion = $latestVersion ? $latestVersion + 1 : 1;

            // Inactivate old active record
            ProspectPersonal::where('mobile', $mobile)
                ->where('status', CommonStatus::ACTIVE)
                ->update(['status' => CommonStatus::INACTIVE]);

            // Create New Record
            $prospect = ProspectPersonal::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'customer_id' => $request->customer_id,
                'community_id' => $request->community_id,
                'flat_no' => $request->flat_no,
                'floor' => $request->floor,
                'block_street' => $request->block_street,
                'gps_location' => $request->gps_location,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'remarks' => $request->remarks,
                'version' => $newVersion,
                'status' => CommonStatus::ACTIVE,
            ]);

            DB::commit();

            return response()->json([
                'status' => config('messages.STATUS_SUCCESS'),
                'message' => config('messages.PROSPECT_PERSONAL_SAVED'),
                'prospect_id' => $prospect->id,
                'version' => $newVersion,
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
