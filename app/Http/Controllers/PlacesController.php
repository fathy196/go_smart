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
        $city = City::find($cityid);
        if (!$city) {
            return " 404";
        }
        return $city;
    }
}
