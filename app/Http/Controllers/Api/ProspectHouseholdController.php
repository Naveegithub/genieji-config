<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProspectHouseholdRequest;
use App\Models\ProspectHousehold;
use App\Enums\CommonStatus;
use Illuminate\Support\Facades\DB;
use Exception;

class ProspectHouseholdController extends Controller
{
    public function store(StoreProspectHouseholdRequest $request)
    {
        try {
            DB::beginTransaction();

            // Inactivate previous household record for same prospect version
            ProspectHousehold::where('prospect_id', $request->prospect_id)
                ->where('status', CommonStatus::ACTIVE)
                ->update([
                    'status' => CommonStatus::INACTIVE
                ]);

            // Insert new household data
            $household = ProspectHousehold::create([
                'prospect_id'    => $request->prospect_id,
                'household_size' => $request->household_size,
                'male_count'     => $request->male_count,
                'female_count'   => $request->female_count,
                'infants'        => $request->infants,
                'children'       => $request->children,
                'adults'         => $request->adults,
                'seniors'        => $request->seniors,
                'auto_tags'      => $request->auto_tags,
                'status'         => CommonStatus::ACTIVE,
            ]);

            DB::commit();

            return response()->json([
                'status' => config('messages.STATUS_SUCCESS'),
                'message' => config('messages.PROSPECT_HOUSEHOLD_SAVED'),
                'data' => [
                    'household_id' => $household->id
                ]
            ]);

        } catch (Exception $e) {
            DB::rollBack();

            // 🔥 TEMPORARY: log real error
            logger()->error($e->getMessage());
            return response()->json([
                'status' => config('messages.STATUS_ERROR'),
                'message' => config('messages.SOMETHING_WENT_WRONG')
            ], 500);
        }
    }
}
