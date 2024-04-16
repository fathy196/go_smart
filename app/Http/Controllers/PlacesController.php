<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    public function CitiesAction()
    {
        $citys = City::all();

        return $citys;
    }
    public function ShowOneCity($cityid)
    {
        $city = City::findOrFail($cityid);

        if (!$city) {
            return ['status' => 404];
        }

        // Retrieve only one landmark associated with the city
        $landmark = $city->landmarks()->first();

        return ['city' => $city, 'landmark' => $landmark];
    }
}
