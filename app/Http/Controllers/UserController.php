<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use File;
date_default_timezone_set('Asia/Manila');

class UserController extends Controller
{
    public function list(Request $request){
        return json_encode(User::with(['company'])->get());
    }

    public function items(Request $request){
        return json_encode(User::with(['branch'])->find($request->id));
    }

    public function create(Request $request){
        // Validation Rules
        $request->validate([
            'branch_id' => 'required',
            'user_no' => 'required|unique:users',
            'name' => 'required|unique:users',
            'age' => 'required',
            'contact_no' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'birthday' => 'required',
            'date_started' => 'required',
            'personal_email' => 'required',
            'user_type' => 'required',
            'profile_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],[
            'branch_id.required' => 'The branch field is required.',
            'user_no.required' => 'The user number field is required.',
            'user_no.unique' => 'The user number has already been taken.',
            'contact_no.required' => 'The contact field is required.',
            'date_started.required' => 'The date started field is required.',
            'personal_email.required' => 'The email field is required.',
            'user_type.required' => 'The user type field is required.',
            'profile_picture.max' => 'The photo must not be greater than 2048 kilobytes.'
        ]);

        $req = 0;

        if($request->branch_id == 0){
            $req = null;
        }else{
            $req = $request->branch_id;
        }
        // Create Data in DB (Personnel Table)
        $data = new User();
        $data->branch_id = $req;
        $data->user_no = $request->user_no;
        $data->name = $request->name;
        $data->age = $request->age;
        $data->contact_no = $request->contact_no;
        $data->gender = $request->gender;
        $data->address = $request->address;
        $data->birthday = $request->birthday;
        $data->date_started = $request->date_started;
        $data->date_ended = null;
        $data->personal_email = $request->personal_email;
        $data->user_type = $request->user_type;
        $data->status = 'Active';
        $data->email = $request->user_no;
        $data->password = bcrypt($request->user_no);
        $data->password_decrypted = $request->user_no;

        // If image is selected, store in DB (Personnel Table)
        if($request->hasFile('profile_picture')){
            $profile_name = $request->file('profile_picture')->getClientOriginalName();
            $profile_path = $request->file('profile_picture')->store('public/Profile_Images');
            $data->profile_name = $profile_name;
            $data->profile_path = $profile_path;
        }

        // Save to DB (Personnel Table)
        $data->save();

        // Return
        return json_encode(
            ['success'=>true]
        );
    } 
 
    public function update(Request $request){
        // Validation Rules
        $request->validate([
            'edit-branch_id' => 'required',
            'edit-user_no' => ['required', Rule::unique('users','user_no')->ignore($request->input("edit-id"))],
            'edit-name' => ['required', Rule::unique('users','name')->ignore($request->input("edit-id"))],
            'edit-age' => 'required',
            'edit-contact_no' => 'required',
            'edit-gender' => 'required',
            'edit-address' => 'required',
            'edit-birthday' => 'required',
            'edit-date_started' => 'required',
            'edit-personal_email' => 'required',
            'edit-user_type' => 'required',
            'edit-profile_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],[
            'edit-branch_id.required' => 'The branch field is required.',
            'edit-user_no.required' => 'The user number field is required.',
            'edit-user_no.unique' => 'The user number has already been taken.',
            'edit-name.required' => 'The name field is required.',
            'edit-name.unique' => 'The name has already been taken.',
            'edit-age' => 'The age field is required.',
            'edit-contact_no.required' => 'The contact field is required.',
            'edit-gender.required' => 'The gender field is required.',
            'edit-address.required' => 'The address field is required.',
            'edit-birthday.required' => 'The birthday field is required.',
            'edit-date_started.required' => 'The date started field is required.',
            'edit-personal_email.required' => 'The email field is required.',
            'edit-user_type.required' => 'The user type field is required.',
            'edit-profile_picture.max' => 'The photo must not be greater than 2048 kilobytes.'
        ]);

        $req = 0;

        if($request->input("edit-branch_id") == 0){
            $req = null;
        }else{
            $req = $request->input("edit-branch_id");
        }
        $user_profile = User::where('id',$request->input("edit-id"))->first();

        // Update Data in DB (Personnel Table)
        $data = User::find($request->input("edit-id"));
        $data->branch_id = $req;
        $data->user_no = $request->input("edit-user_no");
        $data->name = $request->input("edit-name");
        $data->age = $request->input("edit-age");
        $data->contact_no = $request->input("edit-contact_no");
        $data->gender = $request->input("edit-gender");
        $data->address = $request->input("edit-address");
        $data->birthday = $request->input("edit-birthday");
        $data->date_started = $request->input("edit-date_started");
        $data->date_ended = $request->input("edit-date_ended");
        $data->personal_email = $request->input("edit-personal_email");
        $data->user_type = $request->input("edit-user_type");
        $data->status = $request->input("edit-status");
        $data->email = $request->input("edit-user_no");
        $data->password = $user_profile->password;
        $data->password_decrypted = $user_profile->password_decrypted;

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

    public function delete(Request $request){
        $data = User::find($request->id);
        $data->delete();
        return json_encode( 
            ['success'=>true]
        );
    }
}
