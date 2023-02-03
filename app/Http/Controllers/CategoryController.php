<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Category;
use DB;
date_default_timezone_set('Asia/Manila');

class CategoryController extends Controller
{
    public function list(Request $request){
        return json_encode(Category::all());
    }

    public function items(Request $request){
        return json_encode(Category::find($request->id));
    }

    public function create(Request $request){
        // Validation Rules
        $request->validate([
            'category_name' => 'required|unique:category',
        ]);

        // Create Data in DB (Bus Table)
        $data = new Category();
        $data->category_name = $request->category_name;

        // Save to DB (Bus Table)
        $data->save();

        // Return
        return json_encode( 
            ['success'=>true]
        );
    } 

    public function update(Request $request){
        // Validation Rules
        $request->validate([
            'category_name' => ['required', Rule::unique('category','category_name')->ignore($request->id)],
        ]);
   
        // Update Data in DB (Category Table)
        $data = Category::find($request->id);
        $data->category_name = $request->category_name;

        // Save to DB (Bus Table)
        $data->save();

        // Return 
        return json_encode(
            ['success'=>true]
        );
    }
}
 