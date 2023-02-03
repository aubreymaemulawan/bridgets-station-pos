<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Inventory;
use DB;
date_default_timezone_set('Asia/Manila');

class InventoryController extends Controller
{
    public function list(Request $request){
        return json_encode(Inventory::with(['branch'])->where([['remaining','!=',0],['branch_id',$request->branch_id]])->get());
    }

    public function items(Request $request){
        return json_encode(Inventory::with(['branch'])->find($request->id));
    }

    public function create(Request $request){
        // Validation Rules
        $request->validate([
            'branch_id' => 'required',
            'product_name' => ['required', 
            Rule::unique('inventory','product_name')->where(
                function ($query) use ($request) {
                    return $query->where(
                        [
                            ["branch_id", "=", $request->branch_id],
                            ['remaining','!=',0]
                        ]
                    );
                }
            )],
            'measurement' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        // Create Data in DB (Bus Table)
        $data = new Inventory();
        $data->branch_id = $request->branch_id;
        $data->product_name = $request->product_name;
        $data->measurement = $request->measurement;
        $data->quantity = $request->quantity;
        $data->remaining = $request->quantity;
        $data->price = $request->price;

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
            'product_name' => ['required', 
            Rule::unique('inventory','product_name')->where(
                function ($query) use ($request) {
                    return $query->where(
                        [
                            ["branch_id", "=", $request->branch_id],
                            ['remaining','!=',0]
                        ]
                    );
                }
            )->ignore($request->id)],
            'measurement' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);
   
        $inv = Inventory::where('id',$request->id)->first();
        // Update Data in DB (Inventory Table)
        $data = Inventory::find($request->id);
        $data->branch_id = $request->branch_id;
        $data->product_name = $request->product_name;
        $data->measurement = $request->measurement;
        $data->quantity = $request->quantity;
        $data->price = $request->price;
        if($inv->quantity == $request->quantity){
        }else{
            $data->remaining = $request->quantity;
        }
        

        // Save to DB (Bus Table)
        $data->save();

        // Return 
        return json_encode(
            ['success'=>true]
        );
    }
    
    public function delete(Request $request){
        $data = Inventory::find($request->id);
        $data->delete();
        return json_encode( 
            ['success'=>true]
        );
        
    }
}
