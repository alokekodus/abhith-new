<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function getEnquiryDetails(Request $request){
        $details = Enquiry::all();
        return view('admin.enquiry.enquiry')->with('details',$details);
    }

    public function saveEnquiryDetails(Request $request){
        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $message = $request->message;

        $create = Enquiry::create([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'message' => $message,
            'date_of_enquiry' => date('Y-m-d'),
            'marked_as_contacted' => 0
        ]);
        if($create){
            return response()->json(['status' => 1, 'message' => 'Thank you for contacting us. Our customer support will contact you shortly.']);
        }else{
            return response()->json(['status' => 2 ,'message' => 'Something went wrong while enquiring']);
        }
    }


    public function markEnquiry(Request $request){
        $enquiry_id = $request->enquiry_id;
        $enquiry_status = $request->enquiry_status;

        Enquiry::where('id',$enquiry_id)->update([
            'marked_as_contacted' =>  $enquiry_status
        ]);

        return response()->json(['message' => 'Enquiry person contacted']);
    }
}