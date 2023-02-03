<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Ingredients;
use App\Models\Inventory;
use App\Models\InventoryLogs;
use App\Models\Invoice;
use App\Models\Menu;
use App\Models\Payment;
use App\Models\Sales;
use App\Models\Transaction;
use App\Models\User;
date_default_timezone_set('Asia/Manila');

class StaffController extends Controller
{
    protected $auth;

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {
        $branch_id = $request->user()->branch_id;
        $branch_select = Branch::where('id',$request->user()->branch_id)->first();
        $branch = Branch::where('status','Active')->get();
        $category = Category::orderBy('created_at','desc')->get();
        $menu = Menu::where([['branch_id',$request->user()->branch_id],['status','Active']])->orderBy('menu_name','asc')->get();
        return view('staff.cashier',compact('menu','branch','category','branch_select','branch_id'));
    }
}
