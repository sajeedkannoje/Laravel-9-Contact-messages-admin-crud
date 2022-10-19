<?php

namespace App\Http\Controllers;

use App\Models\ContactInformation;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'firstname'=> 'required|string',
            'lastname'=>'required|string',
            'phone' => 'required',
            'email'=>'required|email',
            'message'=> 'required|string'
        ]);
        ContactInformation::create([
            'first_name'=>$request->firstname,
            'last_name'=>$request->lastname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message,
        ]);
        return response()->json(['status'=>true,'message'=>'thanks your!'],200);
    }
}
