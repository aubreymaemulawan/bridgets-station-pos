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
use App\Models\Expenses;



class PageController extends Controller
{
    // Need Auth to go to routes
    public function __construct() {
        $this->middleware('auth');
    }

    // Admin Views
    public function order($branch_id){
        $branch_select = Branch::where('id',$branch_id)->first();
        $branch = Branch::where('status','Active')->get();
        $category = Category::orderBy('created_at','desc')->get();
        $menu = Menu::where([['servings','!=',0],['branch_id',$branch_id],['status','Active']])->orderBy('menu_name','asc')->get();
        return view('admin.order',compact('menu','branch','category','branch_select','branch_id'));
    }

    //
    public function branch(){
        $branch = Branch::orderBy('created_at','desc')->get();
        return view('admin.branch',compact('branch'));
    }

    // 
    public function inventory(){
        $branch = Branch::where('status','Active')->get();
        $inventory = Inventory::orderBy('created_at','desc')->get();
        return view('admin.inventory',compact('inventory','branch'));
    }

    public function sales_report(){
        $sales = Sales::all();
        $branch = Branch::where('status', 'Active')->orderBy('created_at','asc')->get();
        return view('admin.sales-report',compact('sales','branch'));
    }

    
    public function expenses(){
        $expenses = Expenses::orderBy('created_at','desc')->get();
        $branch = Branch::where('status', 'Active')->orderBy('created_at','desc')->get();
        return view('admin.expenses',compact('expenses','branch'));
    }

    // 
    public function manage_user(){
        $branch = Branch::where('status','Active')->get();
        $user = User::orderBy('created_at','desc')->get();
        return view('admin.manage-user',compact('user','branch'));
    }

    // 
    public function profile(){
        return view('admin.profile');
    }

    public function menu(){
        $category = Category::orderBy('created_at','desc')->get();
        $branch = Branch::where('status','Active')->orderBy('created_at','desc')->get();
        $menu = Menu::orderBy('created_at','desc')->get();
        $menu_active = Menu::where('status','Active')->orderBy('created_at','desc')->get();
        $ingredients = Ingredients::orderBy('created_at','desc')->get();
        $inventory = Inventory::orderBy('created_at','desc')->get();
        return view('admin.menu', compact('menu','ingredients','inventory','branch','category','menu_active'));
    }
}
