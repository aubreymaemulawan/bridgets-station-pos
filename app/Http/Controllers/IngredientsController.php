<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Ingredients;
use Illuminate\Validation\Rule;

class IngredientsController extends Controller
{
    public function list(Request $request){
        return json_encode(Ingredients::with(['menu','inventory'])->where('menu_id',$request->menu_id)->get());
    }

    public function items(Request $request){
        return json_encode(Ingredients::with(['menu.branch','inventory'])->find($request->id));
    }

    public function create(Request $request){
        // Validation Rules
        $request->validate([
            'branch_id' => 'required',
            'menu_id' => 'required',
            'inventory_id' => ['required', Rule::unique('ingredients','inventory_id')->where('menu_id',$request->menu_id)],
            'quantity' => 'required',
        ],[
            'branch_id.required' => 'The branch field is required.',
            'menu_id.required' => 'The menu field is required.',
            'inventory_id.required' => 'The product inventory field is required.',
            'inventory_id.unique' => 'The product has already been taken.',
            'quantity.required' => 'The quantity field is required.',
        ]);

        // Create Data in DB (Bus Table)
        $data = new Ingredients();
        $data->menu_id = $request->menu_id;
        $data->inventory_id = $request->inventory_id;
        $data->quantity = $request->quantity;

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
            'branch_id' => 'required',
            'menu_id' => 'required',
            'inventory_id' => ['required', Rule::unique('ingredients','inventory_id')->where('menu_id',$request->menu_id)->ignore($request->id)],
            'quantity' => 'required',
        ],[
            'branch_id.required' => 'The branch field is required.',
            'menu_id.required' => 'The menu field is required.',
            'inventory_id.required' => 'The product inventory field is required.',
            'inventory_id.unique' => 'The product has already been taken.',
            'quantity.required' => 'The quantity field is required.',
        ]);
   
        // Update Data in DB (Category Table)
        $data = Ingredients::find($request->id);
        $data->menu_id = $request->menu_id;
        $data->inventory_id = $request->inventory_id;
        $data->quantity = $request->quantity;

        // Save to DB (Bus Table)
        $data->save();

        // Return 
        return json_encode(
            ['success'=>true]
        );
    }
}
