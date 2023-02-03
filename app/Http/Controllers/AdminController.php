<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
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
use DB;
date_default_timezone_set('Asia/Manila');

class AdminController extends Controller
{
    protected $auth;

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {
        $ongoing_trip = array();
        $percent_rev = 0;
        $percent_item = 0;
        $percent_cust = 0;
        $user = User::all();
        $old_total = Invoice::sum('total');
        $old_items = Invoice::sum('items');
        $old_custs = Invoice::count();
        $revenue = Invoice::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->sum('total');
        $dishes = Invoice::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->sum('items');
        $cust = Invoice::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', date('m'))->get();
        $customers = count($cust);
        $sales = Sales::select('menu_id', DB::raw('count(*) as total'))->groupBy('menu_id')->get();
        $inventory = Inventory::where('remaining','!=',0)->orderBy('created_at','desc')->get();
        $invoice = Invoice::orderBy('created_at','desc')->get();


        $dt = Invoice::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', 1)->pluck('created_at')->toArray();
        $val = Invoice::whereYear('created_at', '=', date('Y'))->whereMonth('created_at', '=', 1)->pluck('total')->toArray();

        return view('admin.dashboard',compact('old_total','user','revenue','dishes','customers','sales','inventory','invoice','ongoing_trip','dt','val'));
    }
}
