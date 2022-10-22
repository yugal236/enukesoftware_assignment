<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\Traits\FileUpload;

class UploadApiController extends Controller {

    use FileUpload;

    public function __construct() {
        $this->middleware('auth');
    }

    public function upload_userfile(Request $request) {
        $validator = Validator::make($request->all(), [
                    'uploaded_file' => 'required|max:500'
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                        'status' => "Error",
                        'message' => 'Validation failed!',
                        'errors' => $validator->getMessageBag()->toArray()
                            ), 422);
        }
        try {
			$id = Auth::id();
                $uploaded_file = $this->upload_file($request->file('uploaded_file'));
				DB::table('upload_file')->insert(["user_id"=>$id,"uploaded_file"=>$uploaded_file]);
				 return response()->json([
                'status' => true,
                'message' => 'File Uploaded Successfully',
                'file' => $uploaded_file
            ], 200);
			
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
