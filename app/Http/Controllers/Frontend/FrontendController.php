<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master_Product_Prop;
use App\Models\Master_Product_Prop_Test;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index()
    {
        $latestDate = Master_Product_Prop_Test::max('Create_Date');
        $formattedDate = Carbon::parse($latestDate)
            ->subDay()
            ->addYears(543)
            ->format('d/m/Y');

        return view('frontend.home.index', compact('formattedDate'));
    }

    /** function search */
    public function searchCarLicense(Request $request)
    {
        $car_license = $request->input('car_license');
        $result = Master_Product_Prop_Test::where('CustID', $car_license)->get();

        if ($result->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'ไม่พบข้อมูลทะเบียนรถที่ค้นหา'
            ]);
        }
    }

}
