<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Storage;

class UploadsController extends Controller
{
    //
    public function tempUpload(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                // ตรวจสอบไฟล์
                $validated = $request->validate([
                    'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120'
                ]);
                $fileName = uniqid() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('temp', $fileName, 'public');

                return response()->json([
                    'success' => true,
                    'path' => $path,
                    'name' => $fileName
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'ไม่พบไฟล์ที่อัพโหลด'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'เกิดข้อผิดพลาดในการอัพโหลด: ' . $e->getMessage()
            ], 500);
        }
    }

    public function removeTemp(Request $request)
    {
        try {
            if ($request->has('filename')) {
                $path = 'temp/' . $request->filename;
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
                return response()->json(['success' => true]);
            }
            return response()->json(['success' => false], 400);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }
}
