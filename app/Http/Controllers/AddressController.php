<?php

namespace App\Http\Controllers;

use DB;

class AddressController extends Controller
{
    
    public function getNationality () {
        $nationalities = DB::table('nationality')->get();
        return view('pages/nationality', compact('nationalities'));
    }

    public function getCountries () {
        $countries = DB::table('countries')->get();
        return view('pages/country', compact('countries'));
    }

    public function getRegions () {
        $regions = DB::table('regions')->get();
        return view('pages/region', compact('regions'));
    }

    public function getDistricts () {
        $districts = DB::table('district')->get();
        return view('pages/district', compact('districts'));
    }

    public function getSubcounties () {
        $subcounties = DB::table('subcounty')
            ->select('subcounty.id', 'subcounty.name AS subcounty', 'district.name AS district')
            ->join('district', 'district.id', '=', 'subcounty.district_id')
            ->get();
        return view('pages/subcounty', compact('subcounties'));
    }

    public function getParishes () {
        $parishes = DB::table('parish')
            ->select('parish.id', 'parish.name AS parish', 'subcounty.name AS subcounty', 'district.name AS district')
            ->join('subcounty', 'subcounty.id', '=', 'parish.subcounty_id')
            ->join('district', 'district.id', '=', 'subcounty.district_id')
            ->get();
        return view('pages/parish', compact('parishes'));
    }

    public function getVillages () {
        $villages = DB::table('village')
            ->select('village.id', 'village.name AS village', 'parish.name AS parish', 'subcounty.name AS subcounty', 'district.name AS district')
            ->join('parish', 'village.parish_id', '=', 'parish.id')
            ->join('subcounty', 'subcounty.id', '=', 'parish.subcounty_id')
            ->join('district', 'district.id', '=', 'subcounty.district_id')
            ->get();
        return view('pages/village', compact('villages'));
    }
}
