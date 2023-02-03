<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use File;
use DB;
date_default_timezone_set('Asia/Manila');

class ProfileController extends Controller
{
     
    public function update(Request $request){
        // Validation Rules
        $request->validate([
            'edit-name' => ['required', Rule::unique('users','name')->ignore($request->input("edit-id"))],
            'edit-email' => ['required', Rule::unique('users','email')->ignore($request->input("edit-id"))],
            'edit-age' => 'required',
            'edit-contact_no' => 'required',
            'edit-gender' => 'required',
            'edit-address' => 'required',
            'edit-birthday' => 'required',
            'edit-personal_email' => 'required',
            'edit-profile_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],[
            'edit-name.required' => 'The name field is required.',
            'edit-name.unique' => 'The name has already been taken.',
            'edit-email.required' => 'The username field is required.',
            'edit-email.unique' => 'The username has already been taken.',
            'edit-age' => 'The age field is required.',
            'edit-contact_no' => 'The contact field is required.',
            'edit-gender.required' => 'The gender field is required.',
            'edit-address' => 'The address field is required.',
            'edit-birthday' => 'The birthday field is required.',
            'edit-personal_email' => 'The email field is required.',
            'edit-profile_picture.max' => 'The photo must not be greater than 2048 kilobytes.'
        ]);

        // Update Data in DB (Personnel Table)
        $data = User::find($request->input("edit-id"));
        $data->branch_id = $request->input("edit-branch_id");
        $data->user_no = $request->input("edit-user_no");
        $data->name = $request->input("edit-name");
        $data->age = $request->input("edit-age");
        $data->contact_no = $request->input("edit-contact_no");
        $data->gender = $request->input("edit-gender");
        $data->address = $request->input("edit-address");
        $data->birthday = $request->input("edit-birthday");
        $data->date_started = $request->input("edit-date_started");
        $data->date_ended = null;
        $data->personal_email = $request->input("edit-personal_email");
        $data->user_type = $request->input("edit-user_type");
        $data->status = $request->input("edit-status");
        $data->email = $request->input("edit-email");
        $data->password = $request->input("edit-password");
        $data->password_decrypted = $request->input("edit-password_decrypted");

        $pp = User::where('id',$request->input("edit-id"))->value('profile_path');
        $str = ltrim($pp, 'public/');

        // If image is selected, store in DB (Personnel Table)
        if($request->hasFile('edit-profile_picture')){
            $prev_path = public_path("/storage/".$str);  // prev image path
            if(File::exists($prev_path)) {
                File::delete($prev_path);
            }
            $edit_profile_name = $request->file('edit-profile_picture')->getClientOriginalName();
            $edit_profile_path = $request->file('edit-profile_picture')->store('public/Profile_Images');
            $data->profile_name = $edit_profile_name;
            $data->profile_path = $edit_profile_path;
        }

        // If image is reset to default, profile picture will be null
        if($request->input("edit-new_img") == '2'){
            $prev_path = public_path("/storage/".$str);  // prev image path
            if(File::exists($prev_path)) {
                File::delete($prev_path);
            }
            $data->profile_name = null;
            $data->profile_path = null;
        }

        // Save to DB (Personnel Table)
        $data->save();

        // Return 
        return json_encode(
            ['success'=>true]
        );
        
    }

    public function update_password(Request $request){
        // Validation Rules
        $request->validate([
            'current_password' => 'required',
        ]);

        // Check current password if correct
        $pass = User::where('id', $request->id)->value('password_decrypted');
        if($request->current_password != $pass){
            return response()->json(1);
        }

        if($request->new_password == $pass){
            return response()->json(2);
        }
        // Validation Rules
        $request->validate([
            'new_password' => 'required|min:8',
            'retype_password' => 'required|required_with:new_password|same:new_password',
        ],[
            'retype_password.same' => 'The retype password does not match.'
        ]);

        if($request->new_password == $request->retype_password){
            // Update Password in DB (Users Table)
            DB::table('users')->where('id', $request->id)->update([
                'password' => bcrypt($request->new_password),
                'password_decrypted' => $request->new_password,
                'updated_at' => now()
            ]);

            // Return
            return json_encode(
                ['success'=>true]
            );
        }
    }
}
