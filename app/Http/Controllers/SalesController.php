<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Branch;
use App\Models\Invoice;
use App\Models\Inventory;
use App\Models\Expenses;

use DB;
date_default_timezone_set('Asia/Manila');

class SalesController extends Controller
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

    public function generate(Request $request){
        $start = date($request->start);
        $end = date($request->end);
        $data = array();
        $gross = 0;
        $discount = 0;
        $sales_tax = 0;
        $net_sales = 0;
        $branch_id = 0;
        $branch = Branch::where('status', 'Active')->orderBy('created_at','asc')->get();
        foreach($branch as $br){
            $branch_id = $br->id;
            $gross = Invoice::where('branch_id',$branch_id)->whereBetween('created_at', [$start, $end])->orderBy('created_at','asc')->sum('subtotal');
            $discount = Invoice::where('branch_id',$branch_id)->whereBetween('created_at', [$start, $end])->orderBy('created_at','asc')->sum('discount');
            $sales_tax = Invoice::where('branch_id',$branch_id)->whereBetween('created_at', [$start, $end])->orderBy('created_at','asc')->sum('sales_tax');
            $net_sales = floatval($gross) - floatval($discount);
            $gross_receipts1 = Inventory::where('branch_id',$branch_id)->whereBetween('created_at', [$start, $end])->orderBy('created_at','asc')->sum('price');
            $gross_receipts2 = Expenses::where('branch_id',$branch_id)->whereBetween('created_at', [$start, $end])->orderBy('created_at','asc')->sum('amount');
            $gross_receipts = floatval($net_sales) - (floatval($gross_receipts1) + floatval($gross_receipts2));

            $data[] = [
                'data' => [
                    'branch_id' => $branch_id,
                    'gross' => $gross,
                    'discount' => $discount,
                    'sales_tax' => $sales_tax,
                    'net_sales' => $net_sales,
                    'gross_receipts' => $gross_receipts,
                    'less_paid_outs' => 0,
                    'cash_to_account' => $gross_receipts,
                ]
            ];   
        }
        return response()->json($data);
        
    }

}
