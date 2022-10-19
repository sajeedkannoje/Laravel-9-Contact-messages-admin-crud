<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }
 
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])){
            $user = auth()->guard('admin')->user();
            if($user->is_admin == 1){
                return redirect()->route('adminDashboard')->with('success','You are Logged in sucessfully.');
            }
        }else {
            return back()->with('error','Whoops! invalid email and password.');
        }
    }
 
    public function adminLogout(Request $request)
    {
        auth()->guard('admin')->logout();
        session()->flush();
        session()->put('success', 'You are logout sucessfully');
        return redirect(route('adminLogin'));
    }
    public function getUsers()
    {
        $users = User::where('id','<>',auth()->guard('admin')->id())->paginate(5);
        return view('admin.users.index',compact('users'));
    }
    public function getUser(User $user)
    {
       return view('admin.users.edit',compact('user'));
    }
    public function updateUser(Request $request, User $user)
    {   
        $request->validate([
            'name'=>'required|string',
            'is_admin' => 'required|numeric'
        ]);
        if(!auth()->guard('admin')->user()){
            return  redirect()->back()->with('success','Authentication Error');
        }
        if($user->id == auth()->guard('admin')->id()){
            return  redirect()->back()->with('success','cannot update the role of Auth user');
        }
        $user->is_admin= $request->is_admin;
        $user->name= $request->name;

        if($user->isDirty()){
            $user->save();
           return  redirect()->back()->with('success', 'user update successfully');   
        }
        return  redirect()->back()->with('success','nothing to update');
        
    }
    public function getContactFormInfo()
    {
       $contacts = ContactInformation::orderBy('created_at','desc')->paginate(10);
       return view('admin.contact-information.index',compact('contacts'));
    }
    public function getContact(ContactInformation $contact)
    {
        // mark as read
        if($contact->is_read == 0){
            $contact->is_read = 1;
            $contact->save();
        }
       return view('admin.contact-information.view',compact('contact')); 
    }
}
