@extends('layouts.app')
@section('title','Manage Branch')

@section('modal')
    <!-- Adding Modal -->
    <div id="add-modal" role="dialog" aria-labelledby="main-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="add-modal-title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="Dismiss('form-add')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="px-6 lg:px-8">
                    <form class="space-y-6" enctype="multipart/form-data" id="adding">
                        @csrf
                        <!-- Hidden ID -->
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                        
                        <!-- Logo Picture -->
                        <div class="grid grid-flow-col-dense grid-row-2 justify-start">
                            <div>
                                <img id="uploadedAvatar" class="w-24 h-24 rounded" src="{{ asset('storage/default2.png') }}" alt="Default avatar">
                            </div>
                            <div class="pl-5 pt-2 ">
                                <label class="bg-emerald-400 hover:bg-emerald-700 text-white text-sm font-normal py-2 px-4 rounded mr-2">
                                    Upload new photo
                                    <input type="file" id="logo_picture" name="logo_picture" class="account-file-input" hidden accept="image/png, image/jpeg"/>
                                </label>
                                <label type="button" class="mt-3 account-image-reset bg-gray-400 hover:bg-gray-700 text-white text-sm font-normal py-2 px-4 rounded">
                                    Reset
                                </label>
                                <div class="block pt-3 mb-2 text-sm font-normal text-gray-900 dark:text-white" >
                                    Allowed JPG, GIF or PNG. Max size of 2048K
                                </div>
                                <!-- Erro Message -->
                                <div class="text-sm">
                                    <span class="errorMsg_logo_picture"></span>
                                </div>
                            </div>
                        </div>
                        
                        <hr>

                        <!-- Branch Name Input -->
                        <div>
                            <label for="branch_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch Name</label>
                            <input type="text" name="branch_name" id="branch_name" placeholder="Ex. Station Iponan" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_branch_name"></span>
                            </div>
                        </div>

                        <!-- Location Input -->
                        <div>
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location Address</label>
                            <input type="text" name="location" id="location" placeholder="Ex. Iponan CDO City" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_location"></span>
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="Ex. branch@email.com" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_email"></span>
                            </div>
                        </div>

                        <!-- Contact No. Selection -->
                        <div class="pb-4">
                            <label for="contact_no" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                            <input type="number" name="contact_no" id="contact_no" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 09123456789" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_contact_no"></span>
                            </div>
                        </div>
                    
                        <!-- Buttons -->
                        <div class="pb-5">
                            <button id="add-modal-submit" type="submit" class=" text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 dark:focus:ring-emerald-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Create
                            </button>
                            <button onclick="Dismiss('form-add')" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Adding Modal -->

    <!-- Editing Modal -->
    <div id="edit-modal" role="dialog" aria-labelledby="main-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="edit-modal-title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="Dismiss('form-edit')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="px-6 lg:px-8">
                    <form class="space-y-6" enctype="multipart/form-data" id="editing">
                        @csrf
                        <!-- Hidden ID -->
                        <input type="hidden" id="edit-id" name="edit-id">
                        <input type="hidden" class="form-control" id="edit-new_img" name="edit-new_img">

                        <!-- Logo Picture -->
                        <div class="grid grid-flow-col-dense grid-row-2 justify-start">
                            <div>
                                <img id="edit-uploadedAvatar" class="w-24 h-24 rounded" src="{{ asset('storage/default2.png') }}" alt="Default avatar">
                            </div>
                            <div class="pl-5 pt-2 ">
                                <label class="bg-emerald-400 hover:bg-emerald-700 text-white text-sm font-normal py-2 px-4 rounded mr-2">
                                    Upload new photo
                                    <input type="file" id="edit-logo_picture" name="edit-logo_picture" class="edit-account-file-input" hidden accept="image/png, image/jpeg"/>
                                </label>
                                <label type="button" class="mt-3 edit-account-image-reset bg-gray-400 hover:bg-gray-700 text-white text-sm font-normal py-2 px-4 rounded">
                                    Reset
                                </label>
                                <div class="block pt-3 mb-2 text-sm font-normal text-gray-900 dark:text-white" >
                                    Allowed JPG, GIF or PNG. Max size of 2048K
                                </div>
                                <!-- Erro Message -->
                                <div class="text-sm">
                                    <span class="errorMsg_logo_picture"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Branch Name Input -->
                        <div>
                            <label for="edit-branch_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch Name</label>
                            <input type="text" name="edit-branch_name" id="edit-branch_name" placeholder="Ex. Station Iponan" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_branch_name"></span>
                            </div>
                        </div>

                        <!-- Location Input -->
                        <div>
                            <label for="edit-location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location Address</label>
                            <input type="text" name="edit-location" id="edit-location" placeholder="Ex. Iponan CDO City" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_location"></span>
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label for="edit-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                            <input type="email" name="edit-email" id="edit-email" placeholder="Ex. branch@email.com" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_email"></span>
                            </div>
                        </div>

                        <!-- Contact No. Selection -->
                        <div>
                            <label for="edit-contact_no" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                            <input type="number" name="edit-contact_no" id="edit-contact_no" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 09123456789" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_contact_no"></span>
                            </div>
                        </div>
                        
                        <!-- Status Input -->
                        <div class="pb-4">
                            <label for="edit-status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select name="edit-status" id="edit-status" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
                                <option value="" disabled selected hidden>Please choose...</option>
                                <option value="Active">Active</option>
                                <option value="Not Active">Not Active</option>
                            </select>
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_status"></span>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="pb-5">
                            <button id="edit-modal-submit" type="submit" class=" text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 dark:focus:ring-emerald-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Create
                            </button>
                            <button onclick="Dismiss('form-edit')" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Editing Modal -->

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
    <main>
        <div class="pt-6 px-4 bg-gray-900">
            <div class="w-full grid grid-cols-1 xl:grid-cols-1 2xl:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 mb-4 ">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold  mb-2">Manage Branch</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of branch stations.</span>
                        </div>
                        <div>
                            <button onclick="Add()" class="btn focus:ring-4 focus:outline-none focus:ring-emerald-300 bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-full">
                                Add New
                            </button>                        
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
                                                <th></th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Branch Name
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Location
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Email
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Contact No.
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach($branch as $br)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    @if($br->logo_path==null)
                                                    <img class="w-10 h-10 h-8 mr-4 rounded-full ring-2 ring-emerald-300 dark:ring-emerald-500" src="{{ asset('storage/default2.png') }}" alt="user-profile">
                                                    @else
                                                    <?php
                                                        $str = $br->logo_path;
                                                        $str = ltrim($str, 'public/');
                                                    ?>
                                                    <img class="w-10 h-10 h-8 mr-4 rounded-full ring-2 ring-emerald-300 dark:ring-emerald-500" src="{{ asset('../storage/'.$str) }}" alt="user-profile">
                                                    @endif
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal ">
                                                    <span class="font-semibold">{{$br->branch_name}}</span>
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                    {{$br->location}} 
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                    {{$br->email}} 
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                    {{$br->contact_no}} 
                                                </td>
                                                <td class="p-4 whitespace-nowrap">
                                                    @if($br->status == 'Active')
                                                        <span class="bg-green-400 text-xs font-normal text-white font-bold py-1 px-3 rounded-full">
                                                        {{$br->status}}
                                                        </span>
                                                    @else
                                                        <span class="bg-red-400 text-xs font-normal text-white font-bold py-1 px-3 rounded-full">
                                                        {{$br->status}}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($br->logo_path==null)
                                                    <button onclick="Edit({{$br->id}},document.getElementById('edit-uploadedAvatar').src='{{ asset('storage/default2.png') }}')" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                        <svg class="text-blue-600 fill-current hover:text-blue-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                    </button>
                                                    @else
                                                    <button onclick="Edit({{$br->id}},document.getElementById('edit-uploadedAvatar').src='{{ asset('../storage/'.$str) }}')" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                        <svg class="text-blue-600 fill-current hover:text-blue-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                    </button>
                                                    @endif
                                                </td>
                                            </tr>
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
        $('#sidebar-branch').addClass('text-white')
        
        // DataTable
        $('#dataTable').DataTable();

        // Submit Form
        $(document).ready(function (e) {
            // Add Data to Database
            $(document).on('submit','#adding', function(e) {
                e.preventDefault();
                let addformData = new FormData($('#adding')[0]);
                $.ajax({
                    type:'POST',
                    url: "{{ url('/api/branch/create') }}",
                    data: addformData,
                    cache: false,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    // If success, return message
                    success: (data) => {
                        $('#add-modal').hide();
                        document.getElementById("success-label").innerHTML= "Successfully added to the database.";
                        $('#success-modal').fadeIn().delay(5000).fadeOut();
                        window.location.reload();
                    },
                    // If fail, show errors
                    error: function(data) {
                        const error1 = data.responseJSON.errors;
                        let error_branch_name = "";
                        let error_location = "";
                        let error_email = "";
                        let error_contact_no = "";
                        let error_logo_picture = "";
                        for (const listKey in error1){
                            if(listKey == "branch_name"){
                                error_branch_name = ""+error1[listKey]+"";
                            }else if(listKey == "location"){
                                error_location = ""+error1[listKey]+"";
                            }else if(listKey == "email"){
                                error_email = ""+error1[listKey]+"";
                            }else if(listKey == "contact_no"){
                                error_contact_no = ""+error1[listKey]+"";
                            }else if(listKey == "logo_picture"){
                                error_logo_picture = ""+error1[listKey]+"";
                            }
                        }
                        let msg_branch_name = "<text>"+error_branch_name+"</text>";
                        let msg_location = "<text>"+error_location+"</text>";
                        let msg_email = "<text>"+error_email+"</text>";
                        let msg_contact_no = "<text>"+error_contact_no+"</text>";
                        let msg_logo_picture = "<text>"+error_logo_picture+"</text>";
                        $("#add-modal .errorMsg_branch_name").html(msg_branch_name).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_location").html(msg_location).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_email").html(msg_email).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_contact_no").html(msg_contact_no).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_logo_picture").html(msg_logo_picture).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal button").attr('disabled',false);
                    }
                });
            });
            // Update/Edit Data
            $(document).on('submit','#editing', function(e) {
                e.preventDefault();
                let editformData = new FormData($('#editing')[0]);
                $.ajax({
                    type:'POST',
                    url: "{{ url('/api/branch/update') }}",
                    data: editformData,
                    cache: false,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    // If success, return message
                    success: (data) => {
                        $('#edit-modal').hide();
                        document.getElementById("success-label").innerHTML= "Successfully updated to the database.";
                        $('#success-modal').fadeIn().delay(5000).fadeOut();
                        window.location.reload();
                    },
                    // If fail, show errors
                    error: function(data) {
                        const error1 = data.responseJSON.errors;
                        let error_branch_name = "";
                        let error_location = "";
                        let error_email = "";
                        let error_contact_no = "";
                        let error_logo_picture = "";
                        let error_status = "";
                        for (const listKey in error1){
                            if(listKey == "edit-branch_name"){
                                error_branch_name = ""+error1[listKey]+"";
                            }else if(listKey == "edit-location"){
                                error_location = ""+error1[listKey]+"";
                            }else if(listKey == "edit-email"){
                                error_email = ""+error1[listKey]+"";
                            }else if(listKey == "edit-contact_no"){
                                error_contact_no = ""+error1[listKey]+"";
                            }else if(listKey == "edit-logo_picture"){
                                error_logo_picture = ""+error1[listKey]+"";
                            }else if(listKey == "edit-status"){
                                error_status = ""+error1[listKey]+"";
                            }
                        }
                        let msg_branch_name = "<text>"+error_branch_name+"</text>";
                        let msg_location = "<text>"+error_location+"</text>";
                        let msg_email = "<text>"+error_email+"</text>";
                        let msg_contact_no = "<text>"+error_contact_no+"</text>";
                        let msg_logo_picture = "<text>"+error_logo_picture+"</text>";
                        let msg_status = "<text>"+error_status+"</text>";
                        $("#edit-modal .errorMsg_branch_name").html(msg_branch_name).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_location").html(msg_location).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_email").html(msg_email).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_contact_no").html(msg_contact_no).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_logo_picture").html(msg_logo_picture).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_status").html(msg_status).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal button").attr('disabled',false);
                    }
                });
            });
        })

        // Onclick Dismiss Modal
        function Dismiss(type){
            if(type == 'form-add'){
                $('#add-modal').hide();
            }else if(type == 'confirm'){
                $('#confirm-modal').hide();
            }else if(type == 'form-edit'){
                $('#edit-modal').hide();
            }
        }

        // Onclick Add Function
        function Add(){
            document.getElementById("add-modal-title").innerHTML= "Create Branch Information";
            document.getElementById("uploadedAvatar").src = "{{ asset('storage/default2.png') }}";
            document.getElementById("add-modal-submit").innerHTML= "Create";
            // Clear Input Fields
            $('#id').val('-1'),
            $('#branch_name').val(''),
            $('#location').val(''),
            $('#email').val(''),
            $('#contact_no').val(''),
            $('#logo_picture').val(''),
            // Clear Error Messages
            $("#add-modal .errorMsg_branch_name").html('');
            $("#add-modal .errorMsg_location").html('');
            $("#add-modal .errorMsg_email").html('');
            $("#add-modal .errorMsg_contact_no").html('');
            $("#add-modal .errorMsg_logo_picture").html('');
            // Show Modal
            $('#add-modal').show();
        }

        // Onclick Edit Function
        function Edit(id) {
            document.getElementById("edit-modal-title").innerHTML= "Edit Branch Information";
            document.getElementById("edit-modal-submit").innerHTML= "Save";
            // Show Values in Modal
            Controller.Post('/api/branch/items', { 'id': id }).done(function(result) {
                // Clear Error Messages
                $("#edit-modal .errorMsg_branch_name").html('');
                $("#edit-modal .errorMsg_location").html('');
                $("#edit-modal .errorMsg_email").html('');
                $("#edit-modal .errorMsg_contact_no").html('');
                $("#edit-modal .errorMsg_status").html('');
                $("#edit-modal .errorMsg_logo_picture").html('');
                // Show ID values in Input Fields
                $('#edit-id').val(result.id),
                $('#edit-branch_name').val(result.branch_name),
                $('#edit-location').val(result.location),
                $('#edit-email').val(result.email),
                $('#edit-contact_no').val(result.contact_no),
                $('#edit-status').val(result.status),
                $('#edit-logo_picture').val(result.logo_picture),
                // Show Modal
                $('#edit-modal').show();
            });
        }

    </script>
@endsection