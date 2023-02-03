<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use DB;
use File;

date_default_timezone_set('Asia/Manila');

class BranchController extends Controller
{
    public function list(Request $request){
        return json_encode(Branch::all());
    }

    public function items(Request $request){
        return json_encode(Branch::find($request->id));
    }

    public function create(Request $request){
        // Validation Rules
        $request->validate([
            'branch_name' => 'required|unique:branch',
            'location' => 'required|unique:branch',
            'email' => 'required',
            'contact_no' => 'required',
            'logo_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],[
            // 'branch_name.required' => 'The branch field is required.',
            'logo_picture.max' => 'The photo must not be greater than 2048 kilobytes.'
        ]);

        // Create Data in DB (Personnel Table)
        $data = new Branch();
        $data->branch_name = $request->branch_name;
        $data->location = $request->location;
        $data->email = $request->email;
        $data->contact_no = $request->contact_no;
        $data->status = "Active";

        // If image is selected, store in DB (Personnel Table)
        if($request->hasFile('logo_picture')){
            $logo_name = $request->file('logo_picture')->getClientOriginalName();
            $logo_path = $request->file('logo_picture')->store('public/Images');
            $data->logo_name = $logo_name;
            $data->logo_path = $logo_path;
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
            'edit-branch_name' => ['required', Rule::unique('branch','branch_name')->ignore($request->input("edit-id"))],
            'edit-location' => ['required', Rule::unique('branch','location')->ignore($request->input("edit-id"))],
            'edit-email' => 'required',
            'edit-contact_no' => 'required',
            'edit-status' => 'required',
            'edit-logo_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],[
            'edit-branch_name.required' => 'The branch name field is required.',
            'edit-branch_name.unique' => 'The branch name has already been taken.',
            'edit-location.required' => 'The location field is required.',
            'edit-location.unique' => 'The location has already been taken.',
            'edit-email.required' => 'The email field is required.',
            'edit-contact_no.required' => 'The contact field is required.',
            'edit-status.required' => 'The status field is required.',
            'edit-logo_picture.max' => 'The photo must not be greater than 2048 kilobytes.'
        ]);

        // Update Data in DB (Branch Table)
        $data = Branch::find($request->input("edit-id"));
        $data->branch_name = $request->input("edit-branch_name");
        $data->location = $request->input("edit-location");
        $data->email = $request->input("edit-email");
        $data->contact_no = $request->input("edit-contact_no");
        $data->status = $request->input("edit-status");

        $pp = Branch::where('id',$request->input("edit-id"))->value('logo_path');
        $str = ltrim($pp, 'public/');

        // If image is selected, store in DB (Personnel Table)
        if($request->hasFile('edit-logo_picture')){
            $prev_path = public_path("/storage/".$str);  // prev image path
            if(File::exists($prev_path)) {
                File::delete($prev_path);
            }
            $edit_logo_name = $request->file('edit-logo_picture')->getClientOriginalName();
            $edit_logo_path = $request->file('edit-logo_picture')->store('public/Images');
            $data->logo_name = $edit_logo_name;
            $data->logo_path = $edit_logo_path;
        }

        // If image is reset to default, profile picture will be null
        if($request->input("edit-new_img") == '2'){
            $prev_path = public_path("/storage/".$str);  // prev image path
            if(File::exists($prev_path)) {
                File::delete($prev_path);
            }
            $data->logo_name = null;
            $data->logo_path = null;
        }

        // Save to DB (Personnel Table)
        $data->save();

        // Return 
        return json_encode(
            ['success'=>true]
        );
        
    }

    public function delete(Request $request){
        $data = Branch::find($request->id);
        $data->delete();
        return json_encode( 
            ['success'=>true]
        );
    }
}
