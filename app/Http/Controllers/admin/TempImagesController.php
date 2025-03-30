<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TempImage;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;

class TempImagesController extends Controller
{
    public function create(Request $request)
    {
        $image = $request->image;

        if (!empty($image)) {
            $ext = $image->getClientOriginalExtension();
            $temp_name = Carbon::now()->format('YmdHis') . '_' . rand(0, 999);
            $new_file_name = $temp_name . '.' . $ext;

            $temp_image = new TempImage();
            $temp_image->name = $new_file_name;
            $temp_image->save();

            $image->move(public_path() . '/uploads/temp_images/', $new_file_name);

            return response()->json([
                'status' => true,
                'image_id' => $temp_image->id,
                'newFileName' => $new_file_name,
                'imagePath' => asset('uploads/temp_images/' . $new_file_name),
                'msg' => 'Image uploaded successfully.',
            ]);
        }
    }

    public function delete(Request $request)
    {
        $temp_img_id = $request->temp_img_id;

        if (!empty($temp_img_id)) {
            $temp_image = TempImage::find($temp_img_id);

            // Delete temporary image file from 'temp_images/' folder of local storage
            $is_deleted = File::delete(public_path() . '/uploads/temp_images/' . $temp_image->name);

            // Delete record from database
            $temp_image->delete();

            if ($is_deleted == true) {
                return response()->json([
                    'status' => true,
                    'msg' => 'Image deleted successfully.',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => 'Unable to delete the image.',
                ]);
            }
        }
    }
}
