<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Jobs\ConvertVideoForResolution;
trait ImageTrait {

   
    public function verifyAndUpload($document, $document_type) {

        $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();

        if ($document_type == "image") {
            $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
            $document->move(public_path('/files/course/subject/lesson'), $new_name);
            $file = '/files/course/subject/lesson/' . $new_name;
            return $file;
        }

        return null;

    }

}