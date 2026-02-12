<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProspectPreferenceRequest;
use App\Models\ProspectPreference;
use App\Enums\CommonStatus;
use Illuminate\Support\Facades\DB;
use Exception;

class ProspectPreferenceController extends Controller
{
    public function store(StoreProspectPreferenceRequest $request)
    {
        try {
            DB::beginTransaction();

            // 1️⃣ Inactivate previous preference
            ProspectPreference::where('prospect_id', $request->prospect_id)
                ->where('status', CommonStatus::ACTIVE)
                ->update(['status' => CommonStatus::INACTIVE]);

            // 2️⃣ Create new preference
            $preference = ProspectPreference::create([
                'prospect_id' => $request->prospect_id,
                'dietary_preference' => $request->dietary_preference,

                'is_health_conscious' => $request->is_health_conscious ?? 0,
                'is_fitness_gym_going' => $request->is_fitness_gym_going ?? 0,
                'is_kids_nutrition_focused' => $request->is_kids_nutrition_focused ?? 0,
                'is_elderly_care_focused' => $request->is_elderly_care_focused ?? 0,
                'is_weight_management' => $request->is_weight_management ?? 0,

                'pref_jain_food' => $request->pref_jain_food ?? 0,
                'pref_satvik_food' => $request->pref_satvik_food ?? 0,
                'pref_no_onion_no_garlic' => $request->pref_no_onion_no_garlic ?? 0,

                'value_sensitivity' => $request->value_sensitivity,
                'status' => CommonStatus::ACTIVE,
            ]);

            // 3️⃣ Pivot insert (multiple cuisines)
            $preference->cuisines()->sync($request->cuisine_ids);

            DB::commit();

            return response()->json([
                'status'  => config('messages.STATUS_SUCCESS'),
                'message' => config('messages.PROSPECT_PREFERENCE_SAVED'),
                'data' => [
                    'preference_id' => $preference->id,
                ]
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
