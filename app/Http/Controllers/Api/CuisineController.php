<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cuisine;
use App\Enums\CommonStatus;
use Illuminate\Http\Request;

class CuisineController extends Controller
{
    // GET – for UI dropdown
    public function index()
    {
        return response()->json([
            'status'  => config('messages.STATUS_SUCCESS'),
            'message' => config('messages.CUISINES_FETCHED'),
            'data'    => Cuisine::where('status', CommonStatus::ACTIVE)->get()
        ]);
    }

    // POST – admin / initial setup only
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150|unique:cuisines,name',
        ]);

        $cuisine = Cuisine::create([
            'name'   => $request->name,
            'status' => CommonStatus::ACTIVE,
        ]);

        return response()->json([
            'status'  => config('messages.STATUS_SUCCESS'),
            'message' => config('messages.CUISINE_CREATED'),
            'data'    => $cuisine
        ]);
    }
}
