<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        dd($request);
    }

    public function fileUpload(Request $request)
    {
        $_IMAGE = $request->file('file');
        $filename = time().$_IMAGE->getClientOriginalName();
        $uploadPath = 'public/images/item_images/';
        $_IMAGE->move($uploadPath,$filename);

        echo json_encode($filename);
    }

    public function removeUpload(Request $request)
    {   
       
        try{

            $image = str_replace('"', '', $request->file);
            $directory = public_path() .  '/images/item_images/' . $image;
            @unlink(public_path() .  '/images/item_images/' . $image );

        }
        catch(Exception $e) {

            //echo 'Message: ' .$e->getMessage();

        }
        finally{

            $message = "success";

        }

        return json_encode($image); 
        
    }

}
