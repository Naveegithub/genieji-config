<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Prospect;
use Illuminate\Http\Request;

class ProspectWizardController extends Controller
{
    /* =======================
       STEP 1 – PERSONAL
    ======================= */

    public function step1()
    {
        return view('dashboard.prospect.step1');
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'mobile' => 'required|digits:10',

            'state'        => 'nullable|string|max:100',
            'city'         => 'nullable|string|max:100',
            'community'    => 'nullable|string|max:100',
            'flat_no'      => 'nullable|string|max:50',
            'floor'        => 'nullable|string|max:50',
            'block_street' => 'nullable|string|max:255',
        ]);

        $prospect = $this->prospect();

        if (!$prospect) {
            $prospect = Prospect::create([
                'name'    => $request->name,
                'mobile'  => $request->mobile,
                'user_id' => session('user_id'),
            ]);
        } else {
            $prospect->update([
                'name'   => $request->name,
                'mobile' => $request->mobile,
            ]);
        }

        session(['prospect_id' => $prospect->id]);

        $prospect->address()->updateOrCreate(
            ['prospect_id' => $prospect->id],
            [
                'state'        => $request->state,
                'city'         => $request->city,
                'community'    => $request->community,
                'flat_no'      => $request->flat_no,
                'floor'        => $request->floor,
                'block_street' => $request->block_street,
            ]
        );

        return redirect('/dashboard/prospect/step-2');
    }

    /* =======================
       STEP 2 – HOUSEHOLD
    ======================= */

  protected function prospect()
    {
        if (!session()->has('prospect_id')) {
            return null;
        }

        return Prospect::with([
            'address',
            'household',
            'preferencesLifestyle',
            'budget',
            'remark',
        ])->find(session('prospect_id'));
    }

    /**
     * STEP 2 – HOUSEHOLD
     */
    public function step2()
    {
        $prospect = $this->prospect();

        if (!$prospect) {
            return redirect()->route('prospect.step1');
        }

        return view('dashboard.prospect.step2', compact('prospect'));
    }

    /**
     * STORE STEP 2
     */
    public function storeStep2(Request $request)
    {
        $prospect = $this->prospect();

        if (!$prospect) {
            return redirect()->route('prospect.step1');
        }

        $validated = $request->validate([
            'household_size' => 'required|integer|min:1',
            'male'           => 'nullable|integer|min:0',
            'female'         => 'nullable|integer|min:0',
            'infants'        => 'nullable|integer|min:0',
            'children'       => 'nullable|integer|min:0',
            'adults'         => 'nullable|integer|min:0',
            'seniors'        => 'nullable|integer|min:0',
        ]);

        $prospect->household()->updateOrCreate(
            ['prospect_id' => $prospect->id],
            $validated
        );

        return redirect()->route('prospect.step3');
    }

    /* =======================
       STEP 3 – PREFERENCES
    ======================= */


/**
 * STEP 3 – SHOW PAGE
 */
public function step3()
{
    $prospect = $this->prospect();

    if (!$prospect) {
        return redirect()->route('prospect.step1');
    }

    return view('dashboard.prospect.step3', compact('prospect'));
}

/**
 * STEP 3 – STORE DATA
 */
public function storeStep3(Request $request)
{
    $request->validate([
        'dietary_preference' => 'nullable|string',
    ]);

    $prospect = $this->prospect();

    if (!$prospect) {
        return redirect()->route('prospect.step1');
    }

    $prospect->preferencesLifestyle()->updateOrCreate(
        ['prospect_id' => $prospect->id],
        [
            'dietary_preference' => $request->dietary_preference,
            'health_conscious'   => $request->boolean('health_conscious'),
            'fitness'            => $request->boolean('fitness'),
            'kids_nutrition'     => $request->boolean('kids_nutrition'),
            'elderly_care'       => $request->boolean('elderly_care'),
            'weight_management'  => $request->boolean('weight_management'),
            'no_onion_garlic'    => $request->boolean('no_onion_garlic'),
            'fasting'            => $request->boolean('fasting'),
            'satvik'             => $request->boolean('satvik'),
             // ✅ FIXED
            'value_sensitivity'  => $request->value_sensitivity,

            // ✅ FIXED – store cuisines as JSON
            'cuisines'           => $request->filled('cuisine_id')
                                    ? json_encode($request->cuisine_id)
                                    : null,
        ]
    );

    return redirect()->route('prospect.step4');
}

    /* =======================
       STEP 4 – BUDGET
    ======================= */

 public function step4()
{
    $prospect = $this->prospect();

    if (!$prospect) {
        return redirect()->route('prospect.step1');
    }

    return view('dashboard.prospect.step4', compact('prospect'));
}

public function storeStep4(Request $request)
{
    $request->validate([
        'monthly_budget'     => 'required|numeric|min:0',
        'purchase_frequency' => 'required|string',
        'preferred_days'     => 'nullable|array',
    ]);

    $prospect = $this->prospect();

    if (!$prospect) {
        return redirect()->route('prospect.step1');
    }

    $prospect->budget()->updateOrCreate(
        ['prospect_id' => $prospect->id],
        [
            'monthly_budget'     => $request->monthly_budget,
            'purchase_frequency' => $request->purchase_frequency,
            'preferred_days'     => $request->preferred_days
                ? json_encode($request->preferred_days)
                : null,
        ]
    );

    return redirect()->route('prospect.step5');
}

    /* =======================
       STEP 5 – REMARKS
    ======================= */
public function step5()
{
    $prospect = $this->prospect();

    if (!$prospect) {
        return redirect()->route('prospect.step1');
    }

    return view('dashboard.prospect.step5', compact('prospect'));
}

public function storeStep5(Request $request)
{
    $request->validate([
        'remarks' => 'nullable|string|max:1000',
    ]);

    $prospect = $this->prospect();

    if (!$prospect) {
        return redirect()->route('prospect.step1');
    }

    $prospect->remark()->updateOrCreate(
        ['prospect_id' => $prospect->id],
        ['remarks' => $request->remarks]
    );

    // Wizard completed
    session()->forget('prospect_id');

    return redirect()->route('dashboard');
}




}
