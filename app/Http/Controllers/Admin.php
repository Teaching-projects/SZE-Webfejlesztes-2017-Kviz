<?php


namespace App\Http\Controllers;


use App\Persistence\Model\User;
use Mail;

class Admin extends Controller
{
    public function admin(){
        return view('admin')->with(['inactive_user' => User::where('is_active',false)->get()]);
    }

    public function acceptanceUser($id){
        $user = User::find($id);
        $user->is_active = true;
        $user->save();
        Mail::send(['text' => 'emails.acceptanceuser'],['user' => $user], function ($message) use ($user) {
            $message->to($user->email, $user->name);
        });
        return redirect('/admin')->with('message', 'A felhasználó elfogadva.');
    }

    public function rejectionUser($id){
        $user = User::find($id);
        $user->delete();
        Mail::send(['text' => 'emails.rejectionuser'],['user' => $user], function ($message) use ($user) {
            $message->to($user->email, $user->name);
        });
        return redirect('/admin')->with('message', 'A felhasználó elutasítva, a fiók törlésre került.');
    }
}