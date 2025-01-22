<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use DB;

class UserController extends Controller
{
    
    public function index(){
        $data['users'] = DB::table('users')
            ->join('user_types', 'user_types.id', 'users.user_type_id')
            ->select(
                'users.*',
                'user_types.name as user_type'
            )
            ->get();
        return view('admins.users.index', $data);
    }

    public function create(){
        return view('admins.users.create');
    }

    public function save(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if($request->hasFile('photo')){
            $user->photo = $request->file('photo')->store('assets/images', 'custom');
            
            // $file = $request->file('photo');
            // $name = auth()->user()->id.'_'.strtotime("now").'_'.rand(1, 9999).'.jpg';
            // $destinationPath = 'assets/images/'.$name;
            // $file->move('assets/images', $destinationPath);
            // $user->photo = $destinationPath;

        }
        if($user->save()){
            return redirect()->route('user.index')->with('success', 'User created successfull.');
        }else{
            return redirect()->route('user.index')->with('error', 'Cannot create user. Try again!');
        }
    }

    public function edit($id){
        $data['user'] = User::find($id);
        return view('admins.users.edit', $data);
    }

    public function update(Request $request){
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->active;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        if($request->hasFile('photo')){
            // $user->photo = $request->file('photo')->store('assets/images', 'custom');
            
            $file = $request->file('photo');
            $name = auth()->user()->id.'_'.strtotime("now").'_'.rand(1, 9999).'.jpg';
            $destinationPath = 'assets/images/'.$name;
            $file->move('assets/images', $destinationPath);
            $user->photo = $destinationPath;

        }
        if($user->save()){
            return redirect()->route('user.index')->with('success', 'User updated successfull.');
        }else{
            return redirect()->back()->with('error', 'Cannot update user. Try again!');
        }
    }

    public function delete($id){
        $user = User::find($id);
        $user->active = 0;
        if($user->save()){
            return redirect()->back()->with('success', 'User deleted successfull.');
        }else{
            return redirect()->route('user.index')->with('error', 'Cannot delete user. Try again!');
        }
    }

}
