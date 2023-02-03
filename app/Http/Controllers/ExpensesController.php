<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Expenses;
use DB;
date_default_timezone_set('Asia/Manila');

class ExpensesController extends Controller
{
    public function list(Request $request){
        return json_encode(Expenses::with(['branch'])->get());
    }

    public function items(Request $request){
        return json_encode(Expenses::with(['branch'])->find($request->id));
    }

    public function create(Request $request){
        // Validation Rules
        $request->validate([
            'branch_id' => 'required',
            'amount' => 'required', 
            'description' => 'required',
            'details' => 'required',
        ]);

        // Create Data in DB (Bus Table)
        $data = new Expenses();
        $data->branch_id = $request->branch_id;
        $data->amount = $request->amount;
        $data->description = $request->description;
        $data->details = $request->details;

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
            'amount' => 'required', 
            'description' => 'required',
            'details' => 'required',
        ]);
   
        // Update Data in DB (Inventory Table)
        $data = Expenses::find($request->id);
        $data->branch_id = $request->branch_id;
        $data->amount = $request->amount;
        $data->description = $request->description;
        $data->details = $request->details;

        // Save to DB (Bus Table)
        $data->save();

        // Return 
        return json_encode(
            ['success'=>true]
        );
    }
}
