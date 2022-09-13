<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    //
    protected function index()
    {
        $banners = Banner::orderBy('id','DESC')->paginate(10);
        return view('admin.master.banner.banner', \compact('banners'));
    }

    protected function create(Request $request)
    {
        return response()->json(['status' => 1,'message' => $request->all()]);
        $this->validate($request,[
            'name' => 'required',
            'description' => 'string',
            'pic' => 'required',

        ],[
            'name.required' => 'Course name is required',
            'description.required' => 'Description is required',
            'pic.required' => 'Picture required',
        ]);

        $document = $request->pic;
        if (isset($document) && !empty($document)) {
            $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
            $document->move(public_path('/files/banner/'), $new_name);
            $file = 'files/banner/' . $new_name;
        }

        Banner::create([
            'name' => $request->name,
            'description' => $request->description,
            'course_id' => $request->course_list,
            'banner_image' => $file
        ]);

        return response()->json(['status' => 1,'message' => 'Banner created successfully']);
    }

    protected function active(Request $request) {
        $banner = Banner::find($request->catId);
        $banner->is_activate = $request->active;
        $banner->save();
        if($request->active == 0){
            return response()->json(['status'=>1,'message' => 'Banner visibility changed from show to hide']);
        }else{
            return response()->json(['status'=>1,'message' => 'Banner visibility changed from hide to show']);
        }
    }

    protected function editBanner($id) {
       $main_id = \Crypt::decrypt($id);

       $banner = Banner::find($main_id);

       return view('admin.master.banner.edit',\compact('banner'));

    }

    protected function edit(Request $request) {
        $banner_id = \Crypt::decrypt($request->id);
        $document = $request->pic;
        $banner = Banner::where('id',$banner_id)->first();

        if ($document->getClientOriginalName() == 'blob') {
            $banner->name = $request->name;
            $banner->course_id = $request->course_list;
            $banner->description = $request->description;
            $banner->save();

        } else {

            if (isset($document) && !empty($document)) {
                $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
                // $new_name = '/images/'.$image.'_'.date('d-m-Y-H-i-s');
                $document->move(public_path('/files/banner/'), $new_name);
                $file = 'files/banner/' . $new_name;
            }
            $banner->name = $request->name;
            $banner->course_id = $request->course_list;
            $banner->banner_image = $file;
            $banner->description = $request->description;
            $banner->save();

        }

        return response()->json(['status'=>1, 'message' => 'Banner details updated successfully']);
    }
}
