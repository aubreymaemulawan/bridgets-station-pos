@extends('layouts.app')
@section('title','Inventory')

@section('modal')
    <!-- Add & Edit Modal -->
    <div id="main-modal" role="dialog" aria-labelledby="main-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex h-screen justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="modal-title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="Dismiss('form')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="px-6 lg:px-8">
                    <form class="space-y-6">
                        @csrf
                        <!-- Hidden ID -->
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                        <!-- Branch Select -->
                        <div>
                            <label for="branch_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
                            <select name="branch_id" id="branch_id" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
                                <option value="" disabled selected hidden>Please choose...</option>
                                @foreach($branch as $br)
                                    <option value="{{$br->id}}">{{$br->branch_name}}</option>
                                @endforeach
                            </select>
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_branch_id"></span>
                            </div>
                        </div>
                        <!-- Product Name Input -->
                        <div>
                            <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                            <input type="text" name="product_name" id="product_name" placeholder="Ex. Cups" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_product_name"></span>
                            </div>
                        </div>
                        <!-- Price Input -->
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="text" name="price" id="price" placeholder="Ex. ₱ 100.00" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_price"></span>
                            </div>
                        </div>
                        <div class="grid grid-rows-1 grid-cols-2 gap-4 pb-4">
                            <!-- Quantity Input -->
                            <div>
                                <label for="quantity" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 10" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_quantity"></span>
                                </div>
                            </div>
                            <!-- Measurement Selection -->
                            <div>
                                <label for="measurement" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Measurement</label>
                                <select name="measurement" id="measurement" placeholder="Ex. 10" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                    <option value="" disabled selected hidden>Please choose...</option>
                                    <option value="Kilo">Kilogram</option>
                                </select>
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_measurement"></span>
                                </div>
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="pb-5">
                            <button onclick="Save()" id="modal-submit" type="button" class=" text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 dark:focus:ring-emerald-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Create
                            </button>
                            <button onclick="Dismiss('form')" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Add & Edit Modal -->

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

    <!-- Error Modal -->
    <div id="error-modal" role="dialog" aria-labelledby="error-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex h-screen justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="p-6 text-center">
                <svg aria-hidden="true" class="text-red-500 fill-current mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path d="M175 175C184.4 165.7 199.6 165.7 208.1 175L255.1 222.1L303 175C312.4 165.7 327.6 165.7 336.1 175C346.3 184.4 346.3 199.6 336.1 208.1L289.9 255.1L336.1 303C346.3 312.4 346.3 327.6 336.1 336.1C327.6 346.3 312.4 346.3 303 336.1L255.1 289.9L208.1 336.1C199.6 346.3 184.4 346.3 175 336.1C165.7 327.6 165.7 312.4 175 303L222.1 255.1L175 208.1C165.7 199.6 165.7 184.4 175 175V175zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"/></svg>
                    <h3 id="error-label" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Oops! Branch table is empty.</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- / Error Modal -->

    <!-- Confirmation Modal -->
    <!-- <div id="confirm-modal" role="dialog" aria-labelledby="confirm-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex h-screen justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <input type="hidden" class="form-control" id="delete_id" name="delete_id">
                <button onclick="Dismiss('confirm')" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class=" mx-auto mb-4 text-red-400 w-14 h-14 dark:text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this item?<br> This cannot be undone.</h3>
                    <button onclick="DeleteConfirm()"type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, delete
                    </button>
                    <button onclick="Dismiss('confirm')" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        No, cancel
                    </button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- / Confirmation Modal -->
@endsection

@section('admin_content')
    <main>
        <div class="pt-6 px-4 bg-gray-900">
            <div class="w-full grid grid-cols-1 xl:grid-cols-1 2xl:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 mb-4 ">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold  mb-2">Inventory</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of product inventory.</span>
                        </div>
                        <div>
                            @if(count($branch) == 0)
                                <button onclick="Error()" class="btn bg-emerald-500 hover:bg-emerald-400 text-white font-bold py-2 px-4 rounded-full">
                                    Add New
                                </button>
                            @else
                                <button onclick="Add()" class="btn focus:ring-4 focus:outline-none focus:ring-emerald-300 bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-full">
                                    Add New
                                </button>
                            @endif
                        
                        </div>
                    </div>
                    <div class="flex flex-col mt-8">
                        <div class="overflow-x-auto rounded-lg">
                            <div class="align-middle inline-block min-w-full">
                                <div class="shadow overflow-hidden sm:rounded-lg">
                                    <table id="dataTable" class="hover:table-auto min-w-full divide-y divide-gray-200">
                                        <thead class="focus:outline-none bg-gray-50">
                                            <tr>
                                                <th></th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Branch
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Product Name
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Price
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Quantity
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Remaining
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Date Added
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach($inventory as $inv)
                                                @if($inv->branch->status == 'Active')
                                                @if($inv->remaining != 0)
                                                <tr>
                                                    <td></td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal ">
                                                        <span class="font-semibold">{{$inv->branch->branch_name}}</span>
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$inv->product_name}}
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$inv->price}}
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$inv->quantity}} {{$inv->measurement}}
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$inv->remaining}} {{$inv->measurement}}
                                                    </td>
                                                    <?php
                                                        $date = new DateTime($inv->created_at);
                                                        $result = $date->format('F j, Y h:m a');
                                                    ?>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$result}}
                                                    </td>
                                                    <td>
                                                    <button onclick="Edit({{$inv->id}})" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                        <svg class="text-blue-600 fill-current hover:text-blue-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                    </button>
                                                   
                                                    </td>
                                                </tr>
                                                @endif
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        // Sidebar
        $('[id^="sidebar-"]').removeClass('text-white')
        $('#sidebar-inventory').addClass('text-white')
        $('#main-modal').hide();

        // DataTable
        $('#dataTable').DataTable();
        
        // Onclick Dismiss Modal
        function Dismiss(type){
            if(type == 'form'){
                $('#main-modal').hide();
            }else if(type == 'confirm'){
                $('#confirm-modal').hide();
            }
            
        }

        // Onclick Error Modal
        function Error(){
            $('#error-modal').fadeIn().delay(1000).fadeOut();
        }

        // Onclick Add Function
        function Add(){
            document.getElementById("modal-title").innerHTML= "Create Product Information";
            document.getElementById("modal-submit").innerHTML= "Create";
            // Clear Input Fields
            $('#id').val('-1'),
            $('#branch_id').val(''),
            $('#product_name').val(''),
            $('#measurement').val(''),
            $('#quantity').val(''),
            $('#price').val(''),
            // Clear Error Messages
            $("#main-modal .errorMsg_branch_id").html('');
            $("#main-modal .errorMsg_product_name").html('');
            $("#main-modal .errorMsg_measurement").html('');
            $("#main-modal .errorMsg_quantity").html('');
            $("#main-modal .errorMsg_price").html('');
            // Show Modal
            $('#main-modal').show();
        }

        // Onclick Edit Function
        function Edit(id) {
            document.getElementById("modal-title").innerHTML= "Edit Product Information";
            document.getElementById("modal-submit").innerHTML= "Save";
            // Show Values in Modal
            Controller.Post('/api/inventory/items', { 'id': id }).done(function(result) {
                // Clear Error Messages
                $("#main-modal .errorMsg_branch_id").html('');
                $("#main-modal .errorMsg_product_name").html('');
                $("#main-modal .errorMsg_measurement").html('');
                $("#main-modal .errorMsg_quantity").html('');
                $("#main-modal .errorMsg_price").html('');
                // Show ID values in Input Fields
                $('#id').val(result.id),
                $('#branch_id').val(result.branch_id),
                $('#product_name').val(result.product_name),
                $('#measurement').val(result.measurement),
                $('#quantity').val(result.quantity),
                $('#price').val(result.price),
                // Show Modal
                $('#main-modal').show();
            });
        }

        // Onclick Save Function
        function Save() {
            // Get Values from input fields
            var data = {
                id: $('#id').val(),
                user_id: $('#user_id').val(),
                branch_id: $('#branch_id').val(),
                product_name: $('#product_name').val(),
                quantity: $('#quantity').val(),
                measurement: $('#measurement').val(),
                price: $('#price').val(),
            }
            // Add Data to Database
            if(data.id == -1) {
                Controller.Post('/api/inventory/create', data)
                // If success, return message
                .done(function(result) {
                    $('#main-modal').hide();
                    document.getElementById("success-label").innerHTML= "Successfully added to the database.";
                    $('#success-modal').fadeIn().delay(5000).fadeOut();
                    window.location.reload();
                })
                //If fail, show errors
                .fail(function (error) {
                    const error1 = error.responseJSON.errors;
                    let error_branch_id = "";
                    let error_product_name = "";
                    let error_measurement = "";
                    let error_quantity = "";
                    let error_price = "";
                    for (const listKey in error1){
                        if(listKey == "branch_id"){
                            error_branch_id = ""+error1[listKey]+"";
                        }else if(listKey == "product_name"){
                            error_product_name = ""+error1[listKey]+"";
                        }else if(listKey == "measurement"){
                            error_measurement = ""+error1[listKey]+"";
                        }else if(listKey == "quantity"){
                            error_quantity = ""+error1[listKey]+"";
                        }else if(listKey == "price"){
                            error_price = ""+error1[listKey]+"";
                        }
                    }
                    let msg_branch_id = "<text>"+error_branch_id+"</text>";
                    let msg_product_name = "<text>"+error_product_name+"</text>";
                    let msg_measurement = "<text>"+error_measurement+"</text>";
                    let msg_quantity = "<text>"+error_quantity+"</text>";
                    let msg_price = "<text>"+error_price+"</text>";
                    $("#main-modal .errorMsg_branch_id").html(msg_branch_id).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_product_name").html(msg_product_name).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_measurement").html(msg_measurement).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_quantity").html(msg_quantity).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_price").html(msg_price).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal button").attr('disabled',false);
                })
            }
            // // Update Data to Database
            else if(data.id > 0) {
                Controller.Post('/api/inventory/update', data)
                // If success, return message
                .done(function(result) {
                    $('#main-modal').hide();
                    document.getElementById("success-label").innerHTML= "Successfully updated to the database.";
                    $('#success-modal').fadeIn().delay(5000).fadeOut();
                    window.location.reload();
                })
                //If fail, show errors
                .fail(function (error) {
                    const error1 = error.responseJSON.errors;
                    let error_branch_id = "";
                    let error_product_name = "";
                    let error_measurement = "";
                    let error_quantity = "";
                    let error_price = "";
                    for (const listKey in error1){
                        if(listKey == "branch_id"){
                            error_branch_id = ""+error1[listKey]+"";
                        }else if(listKey == "product_name"){
                            error_product_name = ""+error1[listKey]+"";
                        }else if(listKey == "measurement"){
                            error_measurement = ""+error1[listKey]+"";
                        }else if(listKey == "quantity"){
                            error_quantity = ""+error1[listKey]+"";
                        }else if(listKey == "price"){
                            error_price = ""+error1[listKey]+"";
                        }
                    }
                    let msg_branch_id = "<text>"+error_branch_id+"</text>";
                    let msg_product_name = "<text>"+error_product_name+"</text>";
                    let msg_measurement = "<text>"+error_measurement+"</text>";
                    let msg_quantity = "<text>"+error_quantity+"</text>";
                    let msg_price = "<text>"+error_price+"</text>";
                    $("#main-modal .errorMsg_branch_id").html(msg_branch_id).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_product_name").html(msg_product_name).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_measurement").html(msg_measurement).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_quantity").html(msg_quantity).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_price").html(msg_price).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal button").attr('disabled',false);
                })  
            }
        }

        // // Onclick Delete Function
        // function Delete(id) {
        //     $('#delete_id').val(id);
        //     $('#confirm-modal').show();
        // }

        // function DeleteConfirm() {
        //     var id = $('#delete_id').val();
        //     $('#confirm-modal').hide();
        //     Controller.Post('/api/inventory/delete', { 'id': id }).done(function(result) {
        //         document.getElementById("success-label").innerHTML= "Successfully deleted to the database.";
        //         $('#success-modal').fadeIn().delay(5000).fadeOut();
        //         window.location.reload();
        //     })
        // }

    </script>
@endsection