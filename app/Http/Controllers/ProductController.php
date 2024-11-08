<?php

namespace App\Http\Controllers;

use App\Models\Master_Product_Prop_Test;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * ลบข้อมูลทั้งหมดในตาราง Master_Product_Prop_Test
     *
     * @return JsonResponse
     */
    public function truncateTable(): JsonResponse
    {
        try {
            Master_Product_Prop_Test::truncate();
            return response()->json(['success' => true, 'message' => 'ลบข้อมูลทั้งหมดสำเร็จ']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()]);
        }
    }
}
