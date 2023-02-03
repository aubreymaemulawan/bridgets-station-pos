@extends('layouts.app')
@section('title','Order')

@section('modal')
    <!-- Print Receipt Modal -->
    <div id="receipt-modal" role="dialog" aria-labelledby="receipt-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex  justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="receipt-title" class="text-xl font-semibold text-gray-900 dark:text-white pr-8"></h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="Dismiss('receipt-form')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Receipt -->
                <div id="receipt">
                    <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
                    <div id="main-content" class="h-50 w-50 bg-gray-50 relative overflow-y-auto">
                        <section class="p-1 bg-white">
                            <div class="max-w-5xl mx-auto bg-white">
                                <article class="overflow-hidden">
                                    <div class="bg-[white] rounded-b-md">
                                        <div class="p-9">
                                            <div class="space-y-6 text-slate-700">
                                                <img class="object-cover h-20" src="{{ asset('dist/images/logo_bridget_station.png') }}" />
                                                <p class="text-xl font-extrabold tracking-tight uppercase font-body">
                                                Bridget's Station
                                                </p>
                                            </div>
                                        </div>
                                        <div class="p-9">
                                            <div class="flex w-full">
                                                <div class="grid grid-cols-4 gap-12">
                                                    <!-- STORE LOCATION -->
                                                    <div class="text-sm font-light text-slate-500">
                                                        <p class="text-sm font-normal text-slate-700">Invoice Detail:</p>
                                                        <p>{{$branch_select->branch_name}}</p>
                                                        <p>{{$branch_select->location}}</p>
                                                        <p class="mt-2 text-sm font-normal text-slate-700">Cashier:</p>
                                                        <p>{{Auth::user()->name}}</p>
                                                    </div>
                                                    <!-- INVOICE NO. -->
                                                    <div class="text-sm font-light text-slate-500">
                                                        <p class="text-sm font-normal text-slate-700">Invoice Number:</p>
                                                        <p id="invoice_no-receipt"></p>
                                                        <p class="mt-2 text-sm font-normal text-slate-700">Date of Issue:</p>
                                                        <p id="date-receipt"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-9">
                                            <div class="flex flex-col mx-0 mt-2">
                                                <table class="min-w-full divide-y divide-slate-500">
                                                    <thead>
                                                        <!-- LABELS -->
                                                        <tr>
                                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-normal text-slate-700 sm:pl-6 md:pl-0">
                                                                Description
                                                            </th>
                                                            <th scope="col" class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell">
                                                                Quantity
                                                            </th>
                                                            <th scope="col" class="hidden py-3.5 px-3 text-right text-sm font-normal text-slate-700 sm:table-cell">
                                                                Price
                                                            </th>
                                                            <th scope="col" class="py-3.5 pl-3 pr-4 text-right text-sm font-normal text-slate-700 sm:pr-6 md:pr-0">
                                                                Amount
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="body-receipt">
                                                    </tbody>
                                                    <tfoot>
                                                        <!-- SUBTOTAL -->
                                                        <tr>
                                                            <th scope="row" colspan="3" class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                                                Subtotal
                                                            </th>
                                                            <th scope="row" class="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                                                                Subtotal
                                                            </th>
                                                            <td id="subtotal-receipt" class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                                                ₱ 0.00
                                                            </td>
                                                        </tr>
                                                        <!-- DISCOUNT -->
                                                        <tr>
                                                            <th scope="row" colspan="3" class="hidden pt-6 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                                                Discount
                                                            </th>
                                                            <th scope="row" class="pt-6 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                                                                Discount
                                                            </th>
                                                            <td id="discount-receipt" class="pt-6 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                                                ₱ 0.00
                                                            </td>
                                                        </tr>
                                                        <!-- SALES TAX -->
                                                        <tr>
                                                            <th scope="row" colspan="3" class="hidden pt-4 pl-6 pr-3 text-sm font-light text-right text-slate-500 sm:table-cell md:pl-0">
                                                                Tax (12%)
                                                            </th>
                                                            <th scope="row" class="pt-4 pl-4 pr-3 text-sm font-light text-left text-slate-500 sm:hidden">
                                                                Tax (12%)
                                                            </th>
                                                            <td id="sales_tax-receipt" class="pt-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">
                                                                ₱ 0.00
                                                            </td>
                                                        </tr>
                                                        <!-- TOTAL -->
                                                        <tr>
                                                            <th scope="row" colspan="3" class="hidden pt-4 pl-6 pr-3 text-sm font-normal text-right text-slate-700 sm:table-cell md:pl-0">
                                                                Total
                                                            </th>
                                                            <th scope="row" class="pt-4 pl-4 pr-3 text-sm font-normal text-left text-slate-700 sm:hidden">
                                                                Total
                                                            </th>
                                                            <td id="total-receipt" class="pt-4 pl-3 pr-4 text-sm font-normal text-right text-slate-700 sm:pr-6 md:pr-0">
                                                                ₱ 0.00
                                                            </td>
                                                        </tr>
                                                        <!-- AMOUNT TENDERED -->
                                                        <tr>
                                                            <th scope="row" colspan="3" class="hidden pt-4 pl-6 pr-3 text-sm font-normal text-right text-slate-700 sm:table-cell md:pl-0">
                                                                Amount Tendered
                                                            </th>
                                                            <th scope="row" class="pt-4 pl-4 pr-3 text-sm font-normal text-left text-slate-700 sm:hidden">
                                                                Amount Tendered
                                                            </th>
                                                            <td id="amount_tendered-receipt" class="pt-4 pl-3 pr-4 text-sm font-normal text-right text-slate-700 sm:pr-6 md:pr-0">
                                                                ₱ 0.00
                                                            </td>
                                                        </tr>
                                                        <!-- CHANGE -->
                                                        <tr>
                                                            <th scope="row" colspan="3" class="hidden pt-4 pl-6 pr-3 text-sm font-normal text-right text-slate-700 sm:table-cell md:pl-0">
                                                                Change
                                                            </th>
                                                            <th scope="row" class="pt-4 pl-4 pr-3 text-sm font-normal text-left text-slate-700 sm:hidden">
                                                                Change
                                                            </th>
                                                            <td id="change-receipt" class="pt-4 pl-3 pr-4 text-sm font-normal text-right text-slate-700 sm:pr-6 md:pr-0">
                                                                ₱ 0.00
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="mt-5 p-9">
                                            <div class="border-t pt-9 border-slate-200">
                                                <div class="text-sm font-light text-slate-700">
                                                    <p style="text-align:center">
                                                        "Your communiTEA Snacks Station!"<br>
                                                        NOT AN OFFICIAL BIR RECEIPT<br>
                                                        FOR INVENTORY PURPOSES ONLY<br>
                                                        THANK YOU SO MUCH!<br><br>
                                                        <span id="date1-receipt"></span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="pb-5 p-6">
                    <button onclick="OpenPrint()" type="button" class=" text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 dark:focus:ring-emerald-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Print
                    </button>
                    <button onclick="Dismiss('receipt-form')" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- / Print Receipt Modal -->

    <!-- Success Modal -->
    <div id="success-modal" role="dialog" aria-labelledby="success-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex h-screen justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="text-emerald-500 fill-current mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M243.8 339.8C232.9 350.7 215.1 350.7 204.2 339.8L140.2 275.8C129.3 264.9 129.3 247.1 140.2 236.2C151.1 225.3 168.9 225.3 179.8 236.2L224 280.4L332.2 172.2C343.1 161.3 360.9 161.3 371.8 172.2C382.7 183.1 382.7 200.9 371.8 211.8L243.8 339.8zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                    <h3 id="success-label" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Successfully saved to the database.</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- / Success Modal -->
@endsection

@section('admin_content')
    <div class="container mx-auto px-5 bg-slate-900 pt-5">
        <div class="flex lg:flex-row flex-col-reverse shadow-lg pb-8">
            <div class="w-full lg:w-3/5 min-h-screen shadow-lg ">
                <!-- Left -->
                <div class="flex flex-row justify-between items-center px-5 mt-5 mb-4 my-4">
                    
                    <input id="branch_id" name="branch_id" type="hidden" value="{{$branch_select->id}}">
                    <!-- Header -->
                    <div class="text-gray-200">
                        <div class="font-bold text-xl">Bridget's Station</div>
                            <span class="text-xs">Location: {{$branch_select->location}}</span>
                        </div>
                        <div class="flex items-center text-gray-200">
                            <div>
                                <button class="px-4 py-2 bg-gray-800 hover:bg-red-500 text-gray-200 font-semibold rounded">
                                Logout
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Categories -->
                    <div class="mt-5 flex flex-row px-5 text-gray-200">
                        <button id="categories" onclick="Category(0)" class="hover:bg-emerald-700 px-5 py-1 bg-emerald-400 rounded-2xl text-white text-sm mr-4">
                            All items
                        </button>
                        @foreach($category as $cat)
                        <button id="categories{{$cat->id}}" onclick="Category({{$cat}})" class="hover:bg-emerald-700 px-5 py-1 rounded-2xl text-sm font-semibold mr-4">
                            {{$cat->category_name}}
                        </button>
                        @endforeach
                    </div>

                    <!-- Menu -->
                    <div id="cat_menu"class="grid grid-cols-3 gap-4 px-5 mt-5 overflow-y-auto h-3/4">
                        @foreach($menu as $mn)
                        <a href="#" onclick="AddOrder({{$mn->id}})" class="px-3 py-3 flex flex-col border border-gray-200 rounded-md h-32 justify-between">
                            <div>
                                <div class="font-bold text-gray-200">{{$mn->menu_name}}</div>
                                <span class="font-light text-sm text-gray-200">{{$mn->servings}}</span>
                            </div>
                            <div class="flex flex-row justify-between items-center">
                                <span class="self-end font-bold text-lg text-yellow-500">₱ {{$mn->price}}</span>
                                @if($mn->photo_path==null)
                                    <img src="{{ asset('storage/default2.png') }}" class=" h-14 w-14 object-cover rounded-md" alt="">
                                @else
                                    <?php
                                        $str = $mn->photo_path;
                                        $str = ltrim($str, 'public/');
                                    ?>
                                    <img src="{{ asset('../storage/'.$str) }}" class=" h-14 w-14 object-cover rounded-md" alt="">
                                @endif
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                <!-- Right -->
                <div class="w-full lg:w-2/5 text-gray-200">

                    <!-- Header -->
                    <div class="flex flex-row items-center justify-between px-5 mt-5">
                        <div class="font-bold text-xl">Current Order
                            <div class="text-sm font-normal mt-1">Cashier: {{Auth::user()->name}}</div>
                        </div>
                        <button onclick="Clear()">
                            <div class="font-semibold">
                                <span class="hover:bg-red-700 px-4 py-2 rounded-md bg-red-500 text-gray-200">Clear All</span>
                            </div>
                        </button>
                    </div>
              
                    <!-- No Orders -->
                    <center class="mt-5" id="txt" >No Orders Yet!</center> 
                    <!-- Error Message -->
                    <div class="pt-1 text-sm">
                        <center><span id="errorMsg_menu_select"></span></center>
                    </div>

                        <!-- Ordered List -->
                        <div id="orders" class="px-5 py-4 mt-5 overflow-y-auto h-64 text-gray-200"></div> 

                        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">

                        <!-- Calculation -->
                        <div class="px-5 mt-5">
                            <div class="py-4 rounded-md shadow-lg">
                                <div class=" px-4 flex justify-between ">
                                    <span class="font-semibold text-sm">Subtotal</span>
                                    <span id="subtotal" class="font-bold">₱ 0.00 </span><input hidden id="subtotal-no" name="subtotal-no" type="number" value="0">
                                </div>
                                <div class=" px-4 flex justify-between ">
                                    <span class="font-semibold text-sm">Discount</span>
                                    <span id="discount" class="font-bold">- ₱ 0.00 </span><input hidden id="discount-no" name="discount-no" type="number" value="0">
                                </div>
                                <div class=" px-4 flex justify-between ">
                                    <span class="font-semibold text-sm">Sales Tax (12%)</span>
                                    <span id="sales_tax" class="font-bold">+ ₱ 0.00 </span><input hidden id="sales_tax-no" name="sales_tax-no" type="number" value="0">
                                </div>
                                <div class="border-t-2 mt-3 py-2 px-4 flex items-center justify-between">
                                    <span class="font-semibold text-2xl">Total</span>
                                    <span id="total" class="font-bold text-2xl">₱ 0.00 </span><input hidden id="total-no" name="total-no" type="number" value="0">
                                </div>
                                <div class=" py-2 px-4 flex items-center justify-between">
                                    <span class="font-semibold text-2xl">Change</span>
                                    <span id="change" class="font-bold text-2xl">₱ 0.00 </span><input hidden id="change-no" name="change-no" type="number" value="0">
                                </div>
                            </div>
                        </div>

                        <!-- Payment Type -->
                        <div class="px-5 mt-5">
                            <div class="rounded-md shadow-lg px-4 py-4">
                                <div class="flex flex-col pb-5">
                                    <span class="uppercase text-xs font-semibold mb-2">Discount</span>
                                    <input id="payment_discount" type="number" placeholder="%" class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                    <!-- Error Message -->
                                    <div class="pt-1 text-sm">
                                        <span id="errorMsg_discount_input"></span>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <span class="uppercase text-xs font-semibold mb-2">Cash Amount</span>
                                    <input id="payment_amount" type="number" placeholder="PHP" class="shadow appearance-none border rounded w-full py-2 px-3 bg-gray-200 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                                    <!-- Error Message -->
                                    <div class="pt-1 text-sm">
                                        <span id="errorMsg_cash_input"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payout -->
                        <div class="px-5 mt-5">
                            <a id="save" href="#" onclick="Save()">
                                <div class="hover:bg-emerald-700 px-4 py-4 rounded-md shadow-lg text-center bg-emerald-400 text-gray-200 font-semibold">
                                    <div class="flex flex-col">
                                        Payout
                                    </div>
                                </div>
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
   
@endsection

@section('scripts')
    <script>
        // Sidebar
        $('[id^="sidebar-"]').removeClass('text-white')
        $('#sidebar-order').addClass('text-white')

        $(document).ready(function (e) {
            $('#receipt').hide();
            $('#payment_discount').keyup(function (){
                if(!($(this).val())){
                    $('#discount').html("- ₱ 0.00");
                    $('#discount-no').val(0);
                    Total();
                }else{
                    var st = $('#subtotal-no').val();
                    var discount = 0;
                    var dis = parseInt($(this).val())*0.01;
                    discount = (st*dis);
                    $('#discount').html("- ₱ "+discount);
                    $('#discount-no').val($(this).val());
                    Total();
                }
            });
            $('#payment_amount').keyup(function (){
                ClearError();
                var total = $('#total-no').val();
                var change = $(this).val() - parseFloat(total);
                $('#payment_amount').val($(this).val());
                $('#change-no').val(change);
                $('#change').html("₱ "+change.toFixed(2));
            });
        });

        
        // Onclick Dismiss Modal
        function Dismiss(type){
            if(type == 'receipt-form'){
                $('#receipt-modal').hide();
                document.getElementById("success-label").innerHTML= "Successfully added to the database.";
                $('#success-modal').fadeIn().delay(5000).fadeOut();
                window.location.reload();
            }
        }

        function Clear(){
            $('#orders').html('');
            $('#txt').html('No Orders Yet!');
        }

        function Category(data1){
            $('[id^="categories"]').removeClass('bg-emerald-400 text-white');
            $('[id^="categories"]').addClass('font-semibold');
            if(data1 == 0){
                $('#categories').removeClass('font-semibold');
                $('#categories').addClass('bg-emerald-400 text-white');
                Controller.Post('/api/menu/find_all',{'branch_id':@json($branch_id)}).done(function(result) {
                    $('#cat_menu').html('');
                    $.each(result, function( index, data ) {
                        if(data.photo_path==null){
                            $('#cat_menu').append('<a href="#" onclick="AddOrder('+data.id+')" class="px-3 py-3 flex flex-col border border-gray-200 rounded-md h-32 justify-between"><div><div class="font-bold text-gray-200">'+data.menu_name+'</div><span class="font-light text-sm text-gray-200">'+data.servings+'</span></div><div class="flex flex-row justify-between items-center"><span class="self-end font-bold text-lg text-yellow-500">₱ '+data.price+'</span><img src="{{ asset('storage/default2.png') }}" class=" h-14 w-14 object-cover rounded-md" alt=""></div></a>');
                        }else{
                            var str = data.photo_path;
                            var res = str.replace("public/", "");
                            var str2 = "{{ asset('../storage/rep') }}"
                            var edit = str2.replace('rep',''+res+'')
                            $('#cat_menu').append('<a href="#" onclick="AddOrder('+data.id+')" class="px-3 py-3 flex flex-col border border-gray-200 rounded-md h-32 justify-between"><div><div class="font-bold text-gray-200">'+data.menu_name+'</div><span class="font-light text-sm text-gray-200">'+data.servings+'</span></div><div class="flex flex-row justify-between items-center"><span class="self-end font-bold text-lg text-yellow-500">₱ '+data.price+'</span><img src='+edit+' class=" h-14 w-14 object-cover rounded-md" alt=""></div></a>');

                        }
                    });
                });
            }else{
                $('#categories'+data1.id).removeClass('font-semibold');
                $('#categories'+data1.id).addClass('bg-emerald-400 text-white');
                Controller.Post('/api/menu/find_items', {"category_id":data1.id, 'branch_id':@json($branch_id)}).done(function(result) {
                    $('#cat_menu').html('');
                    $.each(result, function( index, data ) {
                        if(data.photo_path==null){
                            $('#cat_menu').append('<a href="#" onclick="AddOrder('+data.id+')" class="px-3 py-3 flex flex-col border border-gray-200 rounded-md h-32 justify-between"><div><div class="font-bold text-gray-200">'+data.menu_name+'</div><span class="font-light text-sm text-gray-200">'+data.servings+'</span></div><div class="flex flex-row justify-between items-center"><span class="self-end font-bold text-lg text-yellow-500">₱ '+data.price+'</span><img src="{{ asset('storage/default2.png') }}" class=" h-14 w-14 object-cover rounded-md" alt=""></div></a>');
                        }else{
                            var str = data.photo_path;
                            var res = str.replace("public/", "");
                            var str2 = "{{ asset('../storage/rep') }}"
                            var edit = str2.replace('rep',''+res+'')
                            $('#cat_menu').append('<a href="#" onclick="AddOrder('+data.id+')" class="px-3 py-3 flex flex-col border border-gray-200 rounded-md h-32 justify-between"><div><div class="font-bold text-gray-200">'+data.menu_name+'</div><span class="font-light text-sm text-gray-200">'+data.servings+'</span></div><div class="flex flex-row justify-between items-center"><span class="self-end font-bold text-lg text-yellow-500">₱ '+data.price+'</span><img src='+edit+' class=" h-14 w-14 object-cover rounded-md" alt=""></div></a>');

                        }
                    });
                });
            };
            
        };

        function AddOrder(id){
            $('#txt').html('');
            var st = $('#subtotal-no').val();
            var current_qty = $('#quantity'+id).val();
            var sales_tax = 0;
            var subtotal = 0;

            if(current_qty){
                Controller.Post('/api/menu/items', {"id":id}).done(function(data) {
                    Plus(data.id,data.servings, data.price);
                });
            }else{
                Controller.Post('/api/menu/items', {"id":id}).done(function(data) {
                    // Subtotal
                    subtotal = parseFloat(st)+data.price;
                    $('#subtotal-no').val(subtotal);
                    document.getElementById('subtotal').innerHTML = '₱  '+subtotal.toFixed(2);
                    // Sales Tax
                    sales_tax = (subtotal*0.12);
                    $('#sales_tax-no').val(sales_tax);
                    document.getElementById('sales_tax').innerHTML = '+ ₱  '+sales_tax.toFixed(2);
                    Total();
                    // Append A Data
                    if(data.photo_path==null){
                        $('#orders').append('<div id="selected_order'+data.id+'" class="flex flex-row justify-between items-center mb-4"> <div class="flex flex-row items-center w-2/5"> <img src="{{ asset('storage/default2.png') }}" class="w-10 h-10 object-cover rounded-md" alt=""><span class="ml-4 font-semibold text-sm">'+data.menu_name+'</span> </div> <div class="w-32 flex justify-between"> <button onclick="Minus('+data.id+','+data.servings+','+data.price+')" class="px-3 py-1 rounded-md bg-white text-black">-</button> <span id="value'+data.id+'" class="font-semibold mx-4">1</span> <input hidden id="quantity'+data.id+'" name="quantity'+data.id+'" value="1" type="number" > <button onclick="Plus('+data.id+','+data.servings+','+data.price+')" class="px-3 py-1 rounded-md bg-emerald-400 ">+</button> </div> <div class="font-semibold text-lg w-16 text-center"> ₱ '+data.price+' </div> </div>');
                    }else{
                        var str = data.photo_path;
                        var res = str.replace("public/", "");
                        var str2 = "{{ asset('../storage/rep') }}"
                        var edit = str2.replace('rep',''+res+'')
                        $('#orders').append('<div id="selected_order'+data.id+'" class="flex flex-row justify-between items-center mb-4"> <div class="flex flex-row items-center w-2/5"> <img src='+edit+' class="w-10 h-10 object-cover rounded-md" alt=""><span class="ml-4 font-semibold text-sm">'+data.menu_name+'</span> </div> <div class="w-32 flex justify-between"> <button onclick="Minus('+data.id+','+data.servings+','+data.price+')" class="px-3 py-1 rounded-md bg-white text-black">-</button> <span id="value'+data.id+'" class="font-semibold mx-4">1</span> <input hidden id="quantity'+data.id+'" name="quantity'+data.id+'" value="1" type="number" > <button onclick="Plus('+data.id+','+data.servings+','+data.price+')" class="px-3 py-1 rounded-md bg-emerald-400 ">+</button> </div> <div class="font-semibold text-lg w-16 text-center"> ₱ '+data.price+' </div> </div>');

                    }
                })
            }
        }

        function Plus(id, servings, price){
            var qty = $('#quantity'+id).val();
            var st = $('#subtotal-no').val();
            var t = $('#total-no').val();
            var sales_tax = 0;
            var subtotal = 0;
            if(qty == servings){
            }else{
                // Subtotal
                var subtotal = parseFloat(st)+price;
                $('#subtotal-no').val(subtotal);
                document.getElementById('subtotal').innerHTML = '₱  '+subtotal.toFixed(2);
                // Sales Tax
                var sales_tax = (subtotal*0.12);
                $('#sales_tax-no').val(sales_tax);
                document.getElementById('sales_tax').innerHTML = '+ ₱  '+sales_tax.toFixed(2);
                // Total
                Total();
                // Add 1
                var qty1 = parseInt(qty)+1;
                $('#quantity'+id).val(qty1);
                document.getElementById('value'+id).innerHTML = qty1;
                
            }
        }

        function Minus(id, servings, price){
            var qty = $('#quantity'+id).val();
            var st = $('#subtotal-no').val();
            var sales_tax = 0;
            var subtotal = 0;
            // Subtotal
            var subtotal = parseFloat(st)-price;
            $('#subtotal-no').val(subtotal);
            document.getElementById('subtotal').innerHTML = '₱  '+subtotal.toFixed(2);
            // Sales Tax
            sales_tax = (subtotal*0.12);
            $('#sales_tax-no').val(sales_tax);
            document.getElementById('sales_tax').innerHTML = '+ ₱  '+sales_tax.toFixed(2);
            Total();
            if(qty == 1){
                $('#selected_order'+id).remove();
            }else{
                var qty1 = parseInt(qty)-1;
                $('#quantity'+id).val(qty1);
                document.getElementById('value'+id).innerHTML = qty1;
            }
        }

        function Total(){
            ClearError()
            var subtotal = $('#subtotal-no').val();
            var sales_tax = $('#sales_tax-no').val();
            var discount = $('#discount-no').val();
            var payment_amount = $('#payment_amount').val();
            var total = 0;
            var change_update = 0;
            var dis = discount*0.01;
            var dis1 = (subtotal*dis);
            var dis2 = subtotal - dis1;
            total = parseFloat(dis2) + parseFloat(sales_tax);
            $('#total-no').val(total);
            document.getElementById('total').innerHTML = '₱  '+total.toFixed(2);

            // If discount empty
            if(!discount){
            }else{
                document.getElementById('discount').innerHTML = '- ₱  '+parseFloat(dis1).toFixed(2);
            }

            // If payment amount empty
            if(!payment_amount){
            }else{
                change_update = parseFloat(payment_amount) - total;
                $('#change-no').val(change_update);
                document.getElementById('change').innerHTML = '₱  '+change_update.toFixed(2);
            }
        }

        function Save(){
            ClearError();
            var it = 0;
            var items = 0;
            Controller.Post('/api/menu/list').done(function(res) {
                $.each(res, function( index, val1 ) {
                    it = $('#quantity'+val1.id).val();
                    if(it){
                       items += parseInt($('#quantity'+val1.id).val());
                    }
                })
                var data = {
                    branch_id: $('#branch_id').val(),
                    user_id: $('#user_id').val(),
                    total: $('#total-no').val(),
                    subtotal: $('#subtotal-no').val(),
                    sales_tax: $('#sales_tax-no').val(),
                    discount: $('#payment_discount').val(),
                    amount_tendered: $('#payment_amount').val(),
                    change: $('#change-no').val(),
                    items: items,
                }
                Controller.Post('/api/menu/invoice', data)
                    .done(function(result) {
                        $.each(res, function( index, val1 ) {
                            var current_qty = $('#quantity'+val1.id).val();
                            if(current_qty){
                                var sales_data = {
                                    invoice_id: result,
                                    menu_id: val1.id,
                                    quantity: $('#quantity'+val1.id).val(),
                                    price: val1.price,
                                    subtotal: parseFloat(val1.price) * parseInt($('#quantity'+val1.id).val()),
                                };
                                Controller.Post('/api/menu/save_order', sales_data).done(function(result) {})
                            }
            
                        })
                        UpdateInvoice(result);
                    }).fail(function (error) {
                        const error1 = error.responseJSON.errors;
                        let error_menu_select = "";
                        let error_cash_input = "";
                        let error_discount_input = "";
                        for (const listKey in error1){
                            if(listKey == "items"){
                                error_menu_select = ""+error1[listKey]+"";
                            }else if(listKey == "amount_tendered"){
                                error_cash_input = ""+error1[listKey]+"";
                            }else if(listKey == "discount"){
                                error_discount_input = ""+error1[listKey]+"";
                            }
                        }
                        let msg_menu_select = "<text>"+error_menu_select+"</text>";
                        let msg_cash_input = "<text>"+error_cash_input+"</text>";
                        let msg_discount_input = "<text>"+error_discount_input+"</text>";
                        $("#errorMsg_menu_select").html(msg_menu_select).addClass('text-red-500').fadeIn(1000);
                        $("#errorMsg_cash_input").html(msg_cash_input).addClass('text-red-500').fadeIn(1000);
                        $("#errorMsg_discount_input").html(msg_discount_input).addClass('text-red-500').fadeIn(1000);
                        $("#save").attr('disabled',false);
                    })
            })
        }

        function UpdateInvoice(invoice_id){
            $('#body-receipt').html('');
            $('#receipt').show();
            
            Controller.Post('/api/menu/find_invoice', {'invoice_id':invoice_id}).done(function([invoice,sales]) {
                $('#invoice_no-receipt').html(invoice.receipt_no);
                var date = moment(invoice.created_at).format('MMMM Do YYYY, h:mm a')
                $('#date-receipt').html(date);
                $('#date1-receipt').html(date);
                $('#subtotal-receipt').html("₱ "+invoice.subtotal);
                $('#sales_tax-receipt').html("+ ₱ "+invoice.sales_tax);
                $('#discount-receipt').html("- ₱ "+invoice.discount);
                $('#total-receipt').html("₱ "+invoice.total);
                $('#amount_tendered-receipt').html("₱ "+invoice.amount_tendered);
                $('#change-receipt').html("₱ "+invoice.change);
                $.each(sales, function(index, value) {
                    $('#body-receipt').append('<tr class="border-b border-slate-200"><td class="py-4 pl-4 pr-3 text-sm sm:pl-6 md:pl-0"><div class="font-medium text-slate-700">'+value.menu.menu_name+'</div><div class="mt-0.5 text-slate-500 sm:hidden">'+value.quantity+' quantity at ₱ '+value.price+'</div></td><td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">'+value.quantity+'</td><td class="hidden px-3 py-4 text-sm text-right text-slate-500 sm:table-cell">₱ '+value.price+'</td><td class="py-4 pl-3 pr-4 text-sm text-right text-slate-500 sm:pr-6 md:pr-0">₱ '+value.sub_total+'</td></tr>');
                })

                

                $('#receipt-modal').show();
                GeneratePDF();
            })
        }

        // Generate PDF
        function GeneratePDF(){
            // Date for filename
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            today = mm + '/' + dd + '/' + yyyy;
            
            // Document Resizing
            var HTML_Width = $("#receipt").width();
            var HTML_Height = $("#receipt").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;
            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
            // HTML2Canvas
            html2canvas($("#receipt")[0]).then(function (canvas) {
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                for (var i = 1; i <= totalPDFPages; i++) { 
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                }
                pdf.save("BridgetsStation-Invoice-"+today+".pdf");
                // Success Message
                // bootbox.alert({
                //     message: "Data Report has been successfully downloaded!",
                //     centerVertical: true,
                //     closeButton: false,
                //     size: 'medium'
                // }); 
            });
        }

        function ClearError(){
            // Clear Error Messages
            $("#errorMsg_menu_select").html('');
            $("#errorMsg_cash_input").html('');
            $("#errorMsg_discount_input").html('');
        }

        function OpenPrint(){
            var printContents = document.getElementById('receipt').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection