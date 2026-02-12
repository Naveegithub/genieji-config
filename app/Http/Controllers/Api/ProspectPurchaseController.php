<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProspectPurchaseRequest;
use App\Models\ProspectPurchase;
use App\Models\ProspectPurchaseDay;
use App\Enums\CommonStatus;
use Illuminate\Support\Facades\DB;
use Exception;

class ProspectPurchaseController extends Controller
{
    public function store(StoreProspectPurchaseRequest $request)
    {
        try {
            DB::beginTransaction();

            // Inactivate old purchase
            ProspectPurchase::where('prospect_id', $request->prospect_id)
                ->where('status', CommonStatus::ACTIVE)
                ->update(['status' => CommonStatus::INACTIVE]);

            // Create purchase
            $purchase = ProspectPurchase::create([
                'prospect_id' => $request->prospect_id,
                'monthly_budget' => $request->monthly_budget,
                'purchase_frequency' => $request->purchase_frequency,
                'status' => CommonStatus::ACTIVE,
            ]);

            // Insert pivot days
            foreach ($request->purchase_days as $day) {
                ProspectPurchaseDay::create([
                    'prospect_purchase_id' => $purchase->id,
                    'day' => $day,
                ]);
            }

            DB::commit();

            return response()->json([
                'status'  => config('messages.STATUS_SUCCESS'),
                'message' => config('messages.PROSPECT_PURCHASE_SAVED'),
                'data' => [
                    'purchase_id' => $purchase->id
                ]
            ]);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => config('messages.STATUS_ERROR'),
                'message' => config('messages.SOMETHING_WENT_WRONG'),
            ], 500);
        }
    }
}
