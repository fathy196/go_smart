<?php

namespace App\Http\Controllers;

use App\Models\All_hotel;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Landmark;
use App\Models\Restaurant;
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
        // Return the city with one landmark, one restaurant, and one hotel
        $landmark = $city->landmarks()->first();
        $restaurant = $city->restaurants()->first();
        $hotel = $city->hotels()->first();
        return ['city' => $city, 'landmark' => $landmark, 'restaurant' => $restaurant, 'hotel' => $hotel];
    }

    public function LandmarksAction()
    {
        $landmarks = Landmark::all();

        return $landmarks;
    }
    public function ShowOneLandmark($landmarkid)
    {
        $landmark = landmark::findOrFail($landmarkid);

        if (!$landmarkid) {
            return ['status' => 404];
        }
        return $landmark;
    }
    public function ResturantsAction()
    {
        $resturants = Restaurant::all();

        return $resturants;
    }
    public function ShowOneResturant($resturantid)
    {
        $resturant = Restaurant::findOrFail($resturantid);

        if (!$resturantid) {
            return ['status' => 404];
        }
        return $resturant;
    }
    public function HotelsAction()
    {
        $hotels = Hotel::all();

        return $hotels;
    }
    public function ShowOneHotel($hotelid)
    {
        $hotel = hotel::findOrFail($hotelid);

        if (!$hotelid) {
            return ['status' => 404];
        }
        return $hotel;
    }
    // public function AllHotelsAction()
    // {
    //     $hotels = All_hotel::all();

    //     return $hotels;
    // }//
}
