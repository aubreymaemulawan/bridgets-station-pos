<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\Invoice;
use App\Models\Inventory;
use App\Models\Ingredients;

use App\Models\Sales;
use Illuminate\Http\Request;
use File;
use DB; 
date_default_timezone_set('Asia/Manila');

class MenuController extends Controller
{
    public function list(Request $request){
        return json_encode(Menu::with(['branch','category'])->get());
    }

    public function list2(Request $request){
        return json_encode(Menu::with(['branch','category'])->where([['status','Active'],['branch_id',$request->branch_id]])->get());
    }

    public function items(Request $request){
        return json_encode(Menu::with(['branch','category'])->find($request->id));
    }

    public function create(Request $request){
        // Validation Rules
        $request->validate([
            'branch_id' => 'required',
            'cat_id' => 'required',
            'menu_code' => 'required|unique:menu',
            'menu_name' => ['required', Rule::unique('menu','menu_name')->where('branch_id',$request->branch_id)],
            'price' => 'required',
            'servings' => 'required',
            'menu_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],[
            'branch_id.required' => 'The branch field is required.',
            'cat_id.required' => 'The category field is required.',
            'menu_picture.max' => 'The photo must not be greater than 2048 kilobytes.'
        ]);

        // Create Data in DB (Personnel Table)
        $data = new Menu();
        $data->branch_id = $request->branch_id;
        $data->category_id = $request->cat_id;
        $data->menu_code = $request->menu_code;
        $data->menu_name = $request->menu_name;
        $data->price = $request->price;
        $data->servings = $request->servings;
        $data->status = 'Active';

        // If image is selected, store in DB (Personnel Table)
        if($request->hasFile('menu_picture')){
            $menu_name = $request->file('menu_picture')->getClientOriginalName();
            $menu_path = $request->file('menu_picture')->store('public/Menu_Images');
            $data->photo_name = $menu_name;
            $data->photo_path = $menu_path;
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
            'edit-cat_id' => 'required',
            'edit-menu_code' => ['required', Rule::unique('menu','menu_code')->ignore($request->input("edit-id"))],
            'edit-menu_name' => ['required', Rule::unique('menu','menu_name')->where('branch_id',$request->input("edit-branch_id"))->ignore($request->input("edit-id"))],
            'edit-price' => 'required',
            'edit-servings' => 'required',
            'edit-status' => 'required',
            'edit-photo_picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ],[
            'edit-branch_id.required' => 'The branch field is required.',
            'edit-cat_id.required' => 'The category field is required.',
            'edit-menu_code.required' => 'The menu code field is required.',
            'edit-menu_code.unique' => 'The menu code has already been taken.',
            'edit-menu_name.required' => 'The menu name field is required.',
            'edit-menu_name.unique' => 'The menu name has already been taken.',
            'edit-price.required' => 'The contact field is required.',
            'edit-servings.required' => 'The servings field is required.',
            'edit-status.required' => 'The status field is required.',
            'edit-photo_picture.max' => 'The photo must not be greater than 2048 kilobytes.'
        ]);


        // Update Data in DB (Personnel Table)
        $data = Menu::find($request->input("edit-id"));
        $data->branch_id = $request->input("edit-branch_id");
        $data->category_id = $request->input("edit-cat_id");
        $data->menu_code = $request->input("edit-menu_code");
        $data->menu_name = $request->input("edit-menu_name");
        $data->price = $request->input("edit-price");
        $data->servings = $request->input("edit-servings");
        $data->status = $request->input("edit-status");

        $pp = Menu::where('id',$request->input("edit-id"))->value('photo_path');
        $str = ltrim($pp, 'public/');

        // If image is selected, store in DB (Personnel Table)
        if($request->hasFile('edit-photo_picture')){
            $prev_path = public_path("/storage/".$str);  // prev image path
            if(File::exists($prev_path)) {
                File::delete($prev_path);
            }
            $edit_photo_name = $request->file('edit-photo_picture')->getClientOriginalName();
            $edit_photo_path = $request->file('edit-photo_picture')->store('public/Images');
            $data->photo_name = $edit_photo_name;
            $data->photo_path = $edit_photo_path;
        }

        // If image is reset to default, profile picture will be null
        if($request->input("edit-new_img") == '2'){
            $prev_path = public_path("/storage/".$str);  // prev image path
            if(File::exists($prev_path)) {
                File::delete($prev_path);
            }
            $data->photo_name = null;
            $data->photo_path = null;
        }

        // Save to DB (Personnel Table)
        $data->save();

        // Return 
        return json_encode(
            ['success'=>true]
        );
        
    }

    public function find_items(Request $request){
        $data = Menu::where([['branch_id',$request->branch_id],['status','Active'],['category_id',$request->category_id]])->orderBy('menu_name','asc')->get();
        return json_encode($data);
            
    }
    
    public function find_all(Request $request){
        $data = Menu::where([['branch_id',$request->branch_id],['status','Active']])->orderBy('menu_name','asc')->get();
        return json_encode($data);
            
    }

    public function save_order(Request $request){
        $data = new Sales();
        $data->invoice_id = $request->invoice_id;
        $data->menu_id = $request->menu_id;
        $data->quantity = $request->quantity;
        $data->price = $request->price;
        $data->sub_total = $request->subtotal;
        $subtract = 0;
        $subtract1 = 0;

        $menu = Menu::where('id',$request->menu_id)->first();
        $inventory = Inventory::where('remaining','!=',0)->get();
        $ingredients = Ingredients::where('menu_id',$request->menu_id)->get();
        $subtract1 = floatval($menu->servings)-$request->quantity;
        DB::table('menu')->where('id',$request->menu_id )->update([
            'servings' => $subtract1
        ]);
        foreach($inventory as $inv){
            foreach($ingredients as $ing){
                if($inv->id == $ing->inventory_id){
                    if($inv->remaining <= 0){

                    }else{
                        $subtract = floatval($inv->remaining) - (floatval($ing->quantity)*$request->quantity);
                        DB::table('inventory')->where('id',$ing->inventory_id )->update([
                            'remaining' => $subtract
                        ]);
                    }
                }
            }

             
        }


        // Save to DB (Personnel Table)
        $data->save();
        return json_encode($data);
    }

    public function invoice(Request $request){
        // Validation Rules
        $request->validate([
            'amount_tendered' => 'required',
            'discount' => 'min:0|max:100',
            'items' => 'required|not_in:0',
        ],[
            'amount_tendered.required' => 'The payment field is required.',
            'discount.required' => 'The category field is required.',
            'items.required' => 'Please select an item.',
            'items.not_in' => 'Please select an item.',
        ]); 

        mt_srand((double)microtime()*10000);
        $charid = md5(uniqid(rand(), true));
        $c = unpack("C*",$charid);
        $c = implode("",$c);

        $discount = ($request->discount)*0.01;
        $data = new Invoice();
        $data->payment_type = 'Cash';
        $data->branch_id = $request->branch_id;
        $data->user_id = $request->user_id;
        $data->receipt_no = strval(substr($c,0,20));
        $data->items = $request->items;
        $data->total = $request->total;
        $data->subtotal = $request->subtotal;
        $data->discount = ($request->subtotal)*$discount;
        $data->sales_tax = $request->sales_tax;
        $data->amount_tendered = $request->amount_tendered;
        $data->change = $request->change;
        $data->status = 'Success';
        $data->save();

        // Return
        return json_encode($data->id);

    }

    public function find_invoice(Request $request){
        $invoice = Invoice::where('id',$request->invoice_id)->first();
        $sales = Sales::with('invoice','menu')->where('invoice_id',$request->invoice_id)->get();
        return response()->json([$invoice,$sales]);
    }
    
    

}
