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
                        <!-- Description Input -->
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea cols="5" type="text" name="description" id="description" placeholder="Ex. Payment for Employees" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </textarea>
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_description"></span>
                            </div>
                        </div>
                        <!-- Details Input -->
                        <div>
                            <label for="details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expenses Details</label>
                            <textarea cols="5" type="text" name="details" id="details" placeholder="Ex. Cashier 1 payment is ₱ 500.00" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </textarea>
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_details"></span>
                            </div>
                        </div>
                        <!-- Amount Input -->
                        <div>
                            <label for="amount" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                            <input type="number" name="amount" id="amount" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. ₱ 100.00" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_amount"></span>
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

    <!-- Viewing Modal -->
    <div id="view-modal" role="dialog" aria-labelledby="main-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="view-modal-title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="Dismiss('form-view')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="px-6 lg:px-8">
                    <form class="space-y-6" id="viewing">
                        @csrf
                        <!-- Hidden ID -->
                        <input type="hidden" id="view-id" name="view-id">
                        
                        <!-- Branch Select -->
                        <div>
                            <label for="view-branch_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
                            <input disabled type="text" name="view-branch_id" id="view-branch_id" class="bg-emerald-50 border border-emerald-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                        </div>

                        <!-- Description Input -->
                        <div>
                            <label for="view-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea disabled rows="5" type="text" name="view-description" id="view-description" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </textarea>
                        </div>


                        <!-- Details Input -->
                        <div>
                            <label for="view-details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Details</label>
                            <textarea disabled rows="5" type="text" name="view-details" id="view-details" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </textarea>
                        </div>

                        <!-- Amount Input -->
                        <div>
                            <label for="view-amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                            <input disabled type="text" name="view-amount" id="view-amount" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                        </div>

                        <!-- Buttons -->
                        <div class="pb-5" id="view-modal-footer" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Viewing Modal -->

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
@endsection

@section('admin_content')
    <main>
        <div class="pt-6 px-4 bg-gray-900">
            <div class="w-full grid grid-cols-1 xl:grid-cols-1 2xl:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 mb-4 ">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold  mb-2">Expenses</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of expenses.</span>
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
                                                    Description
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Details
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Amount
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
                                            @foreach($expenses as $exp)
                                                @if($exp->branch->status == 'Active')
                                                <tr >
                                                    <td></td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal ">
                                                        <span class="font-semibold">{{$exp->branch->branch_name}}</span>
                                                    </td>
                                                    <td class="p-4  text-sm font-normal text-gray-500">
                                                        {{$exp->description}}
                                                    </td>
                                                    <td class="p-4  text-sm font-normal text-gray-500">
                                                        {{$exp->details}}
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        ₱ {{$exp->amount}}
                                                    </td>
                                                    <?php
                                                        $date = new DateTime($exp->created_at);
                                                        $result = $date->format('F j, Y h:m a');
                                                    ?>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$result}}
                                                    </td>
                                                    <td>
                                                    <button onclick="View({{$exp->id}})" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                        <svg class="text-green-600 fill-current hover:text-green-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                        <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>
                                                    </button>
                                                    <button onclick="Edit({{$exp->id}})" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                        <svg class="text-blue-600 fill-current hover:text-blue-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                    </button>
                                                   
                                                    </td>
                                                </tr>
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
        $('#sidebar-expenses').addClass('text-white')
        $('#main-modal').hide();

        // DataTable
        $('#dataTable').DataTable();
        
        // Onclick Dismiss Modal
        function Dismiss(type){
            if(type == 'form'){
                $('#main-modal').hide();
            }else if(type == 'form-view'){
                $('#view-modal').hide();
            }
            
        }

        // Onclick Error Modal
        function Error(){
            $('#error-modal').fadeIn().delay(1000).fadeOut();
        }

        // Onclick Add Function
        function Add(){
            document.getElementById("modal-title").innerHTML= "Create Expenses Information";
            document.getElementById("modal-submit").innerHTML= "Create";
            // Clear Input Fields
            $('#id').val('-1'),
            $('#branch_id').val(''),
            $('#description').val(''),
            $('#details').val(''),
            $('#amount').val(''),
            // Clear Error Messages
            $("#main-modal .errorMsg_branch_id").html('');
            $("#main-modal .errorMsg_description").html('');
            $("#main-modal .errorMsg_details").html('');
            $("#main-modal .errorMsg_amount").html('');
            // Show Modal
            $('#main-modal').show();
        }

        // Onclick Edit Function
        function Edit(id) {
            document.getElementById("modal-title").innerHTML= "Edit Expenses Information";
            document.getElementById("modal-submit").innerHTML= "Save";
            // Show Values in Modal
            Controller.Post('/api/expenses/items', { 'id': id }).done(function(result) {
                // Clear Error Messages
                $("#main-modal .errorMsg_branch_id").html('');
                $("#main-modal .errorMsg_description").html('');
                $("#main-modal .errorMsg_details").html('');
                $("#main-modal .errorMsg_amount").html('');
                // Show ID values in Input Fields
                $('#id').val(result.id),
                $('#branch_id').val(result.branch_id),
                $('#description').val(result.description),
                $('#details').val(result.details),
                $('#amount').val(result.amount),
                // Show Modal
                $('#main-modal').show();
            });
        }

        // Onclick Save Function
        function Save() {
            // Get Values from input fields
            var data = {
                id: $('#id').val(),
                branch_id: $('#branch_id').val(),
                description: $('#description').val(),
                details: $('#details').val(),
                amount: $('#amount').val(),
            }
            // Add Data to Database
            if(data.id == -1) {
                Controller.Post('/api/expenses/create', data)
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
                    let error_description = "";
                    let error_details = "";
                    let error_amount = "";
                    for (const listKey in error1){
                        if(listKey == "branch_id"){
                            error_branch_id = ""+error1[listKey]+"";
                        }else if(listKey == "description"){
                            error_description = ""+error1[listKey]+"";
                        }else if(listKey == "details"){
                            error_details = ""+error1[listKey]+"";
                        }else if(listKey == "amount"){
                            error_amount = ""+error1[listKey]+"";
                        }
                    }
                    let msg_branch_id = "<text>"+error_branch_id+"</text>";
                    let msg_description = "<text>"+error_description+"</text>";
                    let msg_details = "<text>"+error_details+"</text>";
                    let msg_amount = "<text>"+error_amount+"</text>";
                    $("#main-modal .errorMsg_branch_id").html(msg_branch_id).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_description").html(msg_description).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_details").html(msg_details).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_amount").html(msg_amount).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal button").attr('disabled',false);
                })
            }
            // // Update Data to Database
            else if(data.id > 0) {
                Controller.Post('/api/expenses/update', data)
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
                    let error_description = "";
                    let error_details = "";
                    let error_amount = "";
                    for (const listKey in error1){
                        if(listKey == "branch_id"){
                            error_branch_id = ""+error1[listKey]+"";
                        }else if(listKey == "description"){
                            error_description = ""+error1[listKey]+"";
                        }else if(listKey == "details"){
                            error_details = ""+error1[listKey]+"";
                        }else if(listKey == "amount"){
                            error_amount = ""+error1[listKey]+"";
                        }
                    }
                    let msg_branch_id = "<text>"+error_branch_id+"</text>";
                    let msg_description = "<text>"+error_description+"</text>";
                    let msg_details = "<text>"+error_details+"</text>";
                    let msg_amount = "<text>"+error_amount+"</text>";
                    $("#main-modal .errorMsg_branch_id").html(msg_branch_id).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_description").html(msg_description).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_details").html(msg_details).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal .errorMsg_amount").html(msg_amount).addClass('text-red-500').fadeIn(1000);
                    $("#main-modal button").attr('disabled',false);
                }) 
            }
        }

        // Onclick View Function
        function View(id) {
            $('#view-modal-footer').html('');
            document.getElementById("view-modal-title").innerHTML= "View Expenses Information";
            // Show Values in Modal
            Controller.Post('/api/expenses/items', { 'id': id }).done(function(result) {
                $('#view-modal-footer').append('<button type="button" onclick="Edit('+result.id+')" class=" text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Edit</button>');  
                // Show ID values in Input Fields
                $('#view-id').val(result.id),
                $('#view-branch_id').val(result.branch.branch_name),
                $('#view-description').val(result.description),
                $('#view-details').val(result.details),
                $('#view-amount').val('₱ '+result.amount),
                // Show Modal
                $('#view-modal').show();
            });
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