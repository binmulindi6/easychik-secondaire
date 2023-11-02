<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\Storage;

class FileUpload{

    private $target_dir;
    private $max_file_size = "2048";
    private $allowed_file_types;

    public function __construct($target_dir, $allowed_file_types) {
        $this->target_dir = $target_dir;
        $this->allowed_file_types = $allowed_file_types;
    }

    public function uploadFile($file) {
        // Check if the file is empty
        if (empty($file)) {
            throw new Exception("File is empty");
        }

        // Check if the file size is too large
        if (($file->getSize() / 1024) > $this->max_file_size) {
            throw new Exception("File size is too large");
        }

        // Check if the file type is allowed
        $file_type = $file->getClientOriginalExtension();
        if (!in_array($file_type, $this->allowed_file_types)) {
            throw new Exception("File type is not allowed");
        }

        // Create a unique file name
        $file_name = uniqid() . "." . $file_type;

        // Move the file to the target directory
        // dd($file->getLinkTarget());
        if (!Storage::disk('public')->put($this->target_dir.$file_name,file_get_contents($file->getPathName()))) {
            throw new Exception("File could not be uploaded");
        }
        // if (!move_uploaded_file($file->getPathName(), $this->target_dir . $file_name)) {
        //     throw new Exception("File could not be uploaded");
        // }

        // Return the file name
        return $file_name;
    }


}