<?php

namespace App\Http\Repositories;
use Image;


class ImageRepository {

    public function create_image($requestPath, $path, $width, $height){
        $img = Image::make($requestPath)->resize($width, $height, function($constraint){
            $constraint->aspectRatio();
        });
        $img->save($path);
    } 



    public function process_image($request){
        $request->validate([
            'photo' =>  'required|mimes:jpeg,jpg,png'
        ]);
         $email = $request->user()->email; 
        $image = $request->photo;
        $imageFullName = $image->getClientOriginalName();
        $imageName = pathinfo($imageFullName, PATHINFO_FILENAME);
        $imageExt = $image->getClientOriginalExtension();
    
        $xs = $imageName.$email.'xs'.time().'.'.$imageExt;
        $sm = $imageName.$email.'sm'.time().'.'.$imageExt;
        $md = $imageName.$email.'md'.time().'.'.$imageExt;
        $lg = $imageName.$email.'lg'.time().'.'.$imageExt;
    
        $xsmall = public_path('storage/photos/'.$xs);
        $small = public_path('storage/photos/'.$sm);
        $medium = public_path('storage/photos/'.$md);
        $large = public_path('storage/photos/'.$lg);
        
        
        $this->create_image(
            $image->getRealPath(), $xsmall, 300, 150
        );
        $this->create_image(
            $image->getRealPath(), $small, 500, 315
        );
        $this->create_image(
            $image->getRealPath(), $medium, 768, 415
        );
        $this->create_image(
            $image->getRealPath(), $large, 1200, 700
        );
        
    
       return [
                'xsmall' => url('storage/photos/'.$xs),
                'small' => url('storage/photos/'.$sm),
                'medium' => url('storage/photos/'.$md),
               'large' =>  url('storage/photos/'.$lg),
            ];
    }
}