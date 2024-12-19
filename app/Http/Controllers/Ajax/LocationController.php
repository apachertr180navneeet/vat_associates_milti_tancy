<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\{
    City,
    State,
    Pincode,
};

class LocationController extends Controller
{
    public function getCities($state)
    {
        $cities = City::where('state_id', $state)->get(['id', 'city_name']);
        return response()->json($cities);
    }

    public function getPincodes($city)
    {
        $pincodes = Pincode::where('city_id', $city)->get();
        return response()->json($pincodes);
    }

    // Method to get all states
    public function getStates()
    {
        $states = State::all(); // Fetch all states from your database
        return response()->json($states);
    }

    // Method to get cities by state
    public function getCitiesByState($stateName)
    {
        $state = State::where('state_name', $stateName)->first();
        if ($state) {
            $cities = City::where('state_id', $state->state_id)->get(); // Fetch cities by state ID
            return response()->json($cities);
        }
        return response()->json([], 404); // Return empty if state not found
    }

    // Method to get zip codes by city
    public function getZipcodesByCity($cityName)
    {
        $city = City::where('city_name', $cityName)->first();
        if ($city) {
            $zipcodes = Pincode::where('city_id', $city->id)->get(); // Fetch zip codes by city ID
            return response()->json($zipcodes);
        }
        return response()->json([], 404); // Return empty if city not found
    }
}
