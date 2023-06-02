<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Containt\Gallery;

class GalleryController extends Controller
{
    public function index(){
        $gallerys=Gallery::all();
        return view('containt.Gallery.index',compact('gallerys'));
    }

    public function create(Request $request){

        $newName='gallery_'.time().'.'.$request->file('photo')->getClientOriginalExtension();
        $request->file('photo')->move('uploads/gallerys',$newName);

        $inputs=[
            'photo'=>$newName,
        ];
        Gallery::create($inputs);
        return redirect()->route('school.gallery');
    }


    public function delete($id){
        $gallery=Gallery::find($id);
        $gallery->delete();
        return redirect()->route('school.gallery');

     }
}
