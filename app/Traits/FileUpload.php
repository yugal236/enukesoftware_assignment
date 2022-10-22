<?php
namespace App\Traits;
 
trait FileUpload
{

    public function upload_file($file)
    {
        $filename = substr(str_replace(" ", "", microtime()),2).'.'.$file->getClientOriginalExtension();
        $destinationPath = storage_path('app/public/files');
        $file->move($destinationPath, $filename);
        return $filename;
    }
   

} 
?>