<?php

namespace App\Http\Controllers\Containt;

use App\Http\Controllers\Controller;
use App\Models\Containt\Notice;
use App\Models\Containt\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Response;

class NoticeBoardController extends Controller
{
    public function index()
    {
        $notices = Notice::all();
        $phones = Phone::all();
        return view('containt.notice.index', compact('notices', 'phones'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'description' => 'required',
            'notices_description' => 'required',
        ]);

        $notice = new Notice($data);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/notices', $name);
            $notice->file = $name;
        }

        $notice->save();

        return redirect()->route('school.notice')->with('success', 'Notice created');
    }

    public function delete($id)
    {
        $notices = Notice::find($id);
        $notices->delete();
        return redirect()->route('school.notice');

    }
    function getpdf($id){
        
        $notice = Notice::findOrFail($id);
        //  $filePath = 'uploads/notices/'.$notice->file;

        // if (Storage::exists($filePath)) {
        //     $fileContents = Storage::get($filePath);
        //     return $fileContents;
        // } else {
        //     abort(404, 'File not found.');
        // }
        // dd($notice->file);
        $filepath = public_path('uploads/notices/'.$notice->file);
        return Response::download($filepath);
    }

}
