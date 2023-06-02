<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academic\Group;
use App\Models\Student\Student;
use App\Models\Academic\Section;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $section = Section::join('class_section_assigns','class_section_assigns.section_id','sections.id')
                ->select('class_section_assigns.*','sections.*')
                ->get();
        $group = Group::join('class_assign_groups','class_assign_groups.group_id','groups.id')
                ->select('class_assign_groups.*','groups.*')
                ->get();
        if ($request->class_id) {
            $student = Student::where(['class_id' => $request->class_id,'section_id' => $request->section_id,'is_active' => 1,'group_id' => $request->group_id])->orderBy('roll_number','asc')->get();
            return view('components.sms.send_sms',compact('section','student','group'));
        }
        return view('components.sms.send_sms',compact('section','group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        
        $title = $request->title;
        $details = $request->details;
        foreach ($request->sms as $item) {
            $to_mobile = Student::find($item)->parent_phone;
            
            $sms = $details;
            $this->send_sms($to_mobile, $sms);
        }
        return redirect()->route('backend.sendsms.index')->with('success','Sms Sended to Student Parients Mobile');
    }

        public function send_sms($mobile,$text) {
            $url = "https://bulksms.brotherit.net/services/send.php";
            $postData = array(
                'number' => $mobile,
                'message' => $text,
                'key' => '7634b92f100e24440afd1940174a918d9c792176',
                'devices' => '180|1',
                'type' => "sms",
                'prioritize' => 0
            );
            
            return $this->sendRequest($url, $postData)["messages"][0];
        }

public function sendRequest($url, $postData){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
    }
    curl_close($ch);
    if ($httpCode == 200) {
        $json = json_decode($response, true);
        if ($json == false) {
            if (empty($response)) {
                throw new Exception("Missing data in request. Please provide all the required information to send messages.");
            } else {
                throw new Exception($response);
            }
        } else {
            if ($json["success"]) {
                return $json["data"];
            } else {
                throw new Exception($json["error"]["message"]);
            }
        }
    } else {
        throw new Exception("HTTP Error Code : {$httpCode}");
    }
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
