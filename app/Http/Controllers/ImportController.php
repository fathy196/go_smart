<?php

namespace App\Http\Controllers;

use App\Imports\CityImport;
use App\Imports\HotelImport;
use App\Imports\LandmarkImport;
use App\Imports\RestaurantImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
        public function ImportCity()
        {
                return Excel::import(new CityImport, request()->file('excelFile'), null, \Maatwebsite\Excel\Excel::XLSX);
        }
        public function ImportHotel()
        {
                // dd($request->all());
                return Excel::import(new HotelImport, request()->file('excelFile'), null, \Maatwebsite\Excel\Excel::XLSX);
        }
        public function ImportLandmark()
        {
                return Excel::import(new LandmarkImport, request()->file('excelFile'), null, \Maatwebsite\Excel\Excel::XLSX);
        }
        public function ImportResturant()
        {
                return Excel::import(new RestaurantImport, request()->file('excelFile'), null, \Maatwebsite\Excel\Excel::XLSX);
        }
}
