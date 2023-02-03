@extends('layouts.app')
@section('title','Manage Users')

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
                        
                        <!-- Profile Picture -->
                        <div class="grid grid-flow-col-dense grid-row-2 justify-start">
                            <div>
                                <img id="uploadedAvatar" class="w-24 h-24 rounded" src="{{ asset('storage/default.jpg') }}" alt="Default avatar">
                            </div>
                            <div class="pl-5 pt-2 ">
                                <label class="bg-emerald-400 hover:bg-emerald-700 text-white text-sm font-normal py-2 px-4 rounded mr-2">
                                    Upload new photo
                                    <input type="file" id="profile_picture" name="profile_picture" class="account-file-input" hidden accept="image/png, image/jpeg"/>
                                </label>
                                <label type="button" class="mt-3 account-image-reset bg-gray-400 hover:bg-gray-700 text-white text-sm font-normal py-2 px-4 rounded">
                                    Reset
                                </label>
                                <div class="block pt-3 mb-2 text-sm font-normal text-gray-900 dark:text-white" >
                                    Allowed JPG, GIF or PNG. Max size of 2048K
                                </div>
                                <!-- Erro Message -->
                                <div class="text-sm">
                                    <span class="errorMsg_profile_picture"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Email & Password -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Email Select -->
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                <input disabled type="text" name="email" id="email" class="bg-emerald-50 border border-emerald-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                            <!-- Password Selection -->
                            <div>
                                <label for="password" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input disabled type="text" name="password" id="password" class="bg-emerald-50 border border-emerald-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                        </div>

                        <hr>

                        <!-- User No Input -->
                        <div>
                            <label for="user_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User No.</label>
                            <input type="text" name="user_no" id="user_no" placeholder="Ex. user123" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_user_no"></span>
                            </div>
                        </div>

                        <!-- User Type & Branch -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- User Type Select -->
                            <div>
                                <label for="user_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Type</label>
                                <select name="user_type" id="user_type" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
                                    <option value="" disabled selected hidden>Please choose...</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Staff">Staff</option>
                                </select>
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_user_type"></span>
                                </div>
                            </div>
                            <!-- Branch Selection -->
                            <div>
                                <label for="branch_id" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
                                <select disabled name="branch_id" id="branch_id" placeholder="Ex. 10" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                    <option value="" disabled selected hidden>Please choose...</option>                                                                    
                                </select>
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_branch_id"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Name Input -->
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name, First Name MI.</label>
                            <input type="text" name="name" id="name" placeholder="Ex. Dela Cruz, Juan B." class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_name"></span>
                            </div>
                        </div>

                        <!-- Personal Email Input -->
                        <div>
                            <label for="personal_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                            <input type="email" name="personal_email" id="personal_email" placeholder="Ex. personal@email.com" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_personal_email"></span>
                            </div>
                        </div>

                        <!-- Age & Contact -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Age Input -->
                            <div>
                                <label for="age" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                                <input type="number" name="age" id="age" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 21" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_age"></span>
                                </div>
                            </div>
                            <!-- Contact No. Selection -->
                            <div>
                                <label for="contact_no" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                                <input type="number" name="contact_no" id="contact_no" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 09123456789" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_contact_no"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Birthday & Gender -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Gender -->
                            <div>
                                <label for="gender" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                                <select name="gender" id="gender" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
                                    <option value="" disabled selected hidden>Please choose...</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>                                
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_gender"></span>
                                </div>
                            </div>
                            <!-- Birthday -->
                            <div>
                                <label for="birthday" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthdate</label>
                                <input type="date" name="birthday" id="birthday" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 09123456789" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_birthday"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Address Input -->
                        <div>
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" name="address" id="address" placeholder="Ex. Phase 2 Macanhan Carmen CDO City" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_address"></span>
                            </div>
                        </div>

                        <!-- Date Started Input -->
                        <div class="pb-4">
                            <label for="date_started" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Started</label>
                            <input type="date" name="date_started" id="date_started" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 21" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_date_started"></span>
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

                        <!-- Profile Picture -->
                        <div class="grid grid-flow-col-dense grid-row-2 justify-start">
                            <div>
                                <img id="edit-uploadedAvatar" class="w-24 h-24 rounded" src="{{ asset('storage/default.jpg') }}" alt="Default avatar">
                            </div>
                            <div class="pl-5 pt-2 ">
                                <label class="bg-emerald-400 hover:bg-emerald-700 text-white text-sm font-normal py-2 px-4 rounded mr-2">
                                    Upload new photo
                                    <input type="file" id="edit-profile_picture" name="edit-profile_picture" class="edit-account-file-input" hidden accept="image/png, image/jpeg"/>
                                </label>
                                <label type="button" class="mt-3 edit-account-image-reset bg-gray-400 hover:bg-gray-700 text-white text-sm font-normal py-2 px-4 rounded">
                                    Reset
                                </label>
                                <div class="block pt-3 mb-2 text-sm font-normal text-gray-900 dark:text-white" >
                                    Allowed JPG, GIF or PNG. Max size of 2048K
                                </div>
                                <!-- Erro Message -->
                                <div class="text-sm">
                                    <span class="errorMsg_profile_picture"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Email & Password -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Email Select -->
                            <div>
                                <label for="edit-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                <input disabled type="text" name="edit-email" id="edit-email" class="bg-emerald-50 border border-emerald-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_email"></span>
                                </div>
                            </div>
                            <!-- Password Selection -->
                            <div>
                                <label for="edit-password" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input disabled type="text" name="edit-password" id="edit-password" class="bg-emerald-50 border border-emerald-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_password"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- User No Input -->
                        <div>
                            <label for="edit-user_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User No.</label>
                            <input type="text" name="edit-user_no" id="edit-user_no" placeholder="Ex. user123" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_user_no"></span>
                            </div>
                        </div>

                        <!-- User Type & Branch -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- User Type Select -->
                            <div>
                                <label for="edit-user_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Type</label>
                                <select name="edit-user_type" id="edit-user_type" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
                                    <option value="" disabled selected hidden>Please choose...</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Staff">Staff</option>
                                </select>
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_user_type"></span>
                                </div>
                            </div>
                            <!-- Branch Selection -->
                            <div>
                                <label for="edit-branch_id" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
                                <select name="edit-branch_id" id="edit-branch_id" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
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
                        </div>

                        <!-- Name Input -->
                        <div>
                            <label for="edit-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name, First Name MI.</label>
                            <input type="text" name="edit-name" id="edit-name" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_name"></span>
                            </div>
                        </div>

                        <!-- Personal Email Input -->
                        <div>
                            <label for="edit-personal_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                            <input type="email" name="edit-personal_email" id="edit-personal_email" placeholder="Ex. personal@email.com" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_personal_email"></span>
                            </div>
                        </div>

                        <!-- Age & Contact -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Age Input -->
                            <div>
                                <label for="edit-age" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                                <input type="number" name="edit-age" id="edit-age" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 21" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_age"></span>
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
                        </div>

                        <!-- Birthday & Gender -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Gender -->
                            <div>
                                <label for="edit-gender" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                                <select name="edit-gender" id="edit-gender" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
                                    <option value="" disabled selected hidden>Please choose...</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>                                
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_gender"></span>
                                </div>
                            </div>
                            <!-- Birthday -->
                            <div>
                                <label for="edit-birthday" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthdate</label>
                                <input type="date" name="edit-birthday" id="edit-birthday" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 09123456789" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_birthday"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Address Input -->
                        <div>
                            <label for="edit-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" name="edit-address" id="edit-address" placeholder="Ex. Phase 2 Macanhan Carmen CDO City" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_address"></span>
                            </div>
                        </div>

                        <!-- Date Started & Date Ended -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Date Started Input -->
                            <div>
                                <label for="edit-date_started" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Started</label>
                                <input type="date" name="edit-date_started" id="edit-date_started" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 21" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_date_started"></span>
                                </div>
                            </div>
                            <!-- Date Ended Selection -->
                            <div>
                                <label for="edit-date_ended" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Ended</label>
                                <input type="date" name="edit-date_ended" id="edit-date_ended" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 09123456789" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_date_ended"></span>
                                </div>
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
                        
                        <!-- Profile Picture -->
                        <div class="grid grid-flow-col-dense  justify-center">
                            <div>
                                <img id="view-uploadedAvatar" class="w-24 h-24 rounded" src="{{ asset('storage/default.jpg') }}" alt="Default avatar">
                            </div>
                        </div>
                        
                        <!-- Email & Password -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Email Select -->
                            <div>
                                <label for="view-view-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                <input disabled type="text" name="view-email" id="view-email" class="bg-emerald-50 border border-emerald-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                            <!-- Password Selection -->
                            <div>
                                <label for="view-password" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input disabled type="text" name="view-password" id="view-password" class="bg-emerald-50 border border-emerald-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                        </div>

                        <hr>

                        <!-- User No Input -->
                        <div>
                            <label for="view-user_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User No.</label>
                            <input disabled type="text" name="view-user_no" id="view-user_no" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_user_no"></span>
                            </div>
                        </div>

                        <!-- User Type & Branch -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- User Type Select -->
                            <div>
                                <label for="view-user_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Type</label>
                                <input disabled type="text" name="view-user_type" id="view-user_type" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                            <!-- Branch Selection -->
                            <div>
                                <label for="view-branch_id" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
                                <input disabled type="text" name="view-branch_id" id="view-branch_id" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                        </div>

                        <!-- Name Input -->
                        <div>
                            <label for="view-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name, First Name MI.</label>
                            <input disabled type="text" name="view-name" id="view-name" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                        </div>

                        <!-- Personal Email Input -->
                        <div>
                            <label for="view-personal_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                            <input disabled type="text" name="view-personal_email" id="view-personal_email" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                        </div>

                        <!-- Age & Contact -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Age Input -->
                            <div>
                                <label for="view-age" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                                <input disabled type="text" name="view-age" id="view-age" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                            <!-- Contact No. Selection -->
                            <div>
                                <label for="view-contact_no" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                                <input disabled type="text" name="view-contact_no" id="view-contact_no" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                        </div>

                        <!-- Birthday & Gender -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Gender -->
                            <div>
                                <label for="view-gender" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                                <input disabled type="text" name="view-gender" id="view-gender" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                            <!-- Birthday -->
                            <div>
                                <label for="view-birthday" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthdate</label>
                                <input disabled type="text" name="view-birthday" id="view-birthday" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                        </div>

                        <!-- Address Input -->
                        <div>
                            <label for="view-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input disabled type="text" name="view-address" id="view-address" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                        </div>

                        <!-- Date Started & Date Ended -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Date Started Input -->
                            <div>
                                <label for="view-date_started" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Started</label>
                                <input disabled type="text" name="view-date_started" id="view-date_started" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                            <!-- Date Ended Selection -->
                            <div>
                                <label for="view-date_ended" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Ended</label>
                                <input disabled type="text" name="view-date_started" id="view-date_started" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                        </div>

                        <!-- Status Input -->
                        <div class="pb-4">
                            <label for="view-status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <input disabled type="text" name="view-status" id="view-status" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                        </div>

                        <!-- Buttons -->
                        <div class="pb-5" id="view-modal-footer" >
                            <button id="view-modal-submit" type="submit" class=" text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 dark:focus:ring-emerald-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Create
                            </button>
                            <button onclick="Dismiss('form-view')" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Cancel
                            </button>
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
                            <h3 class="text-xl font-bold  mb-2">User Profiles</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of user profiles.</span>
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
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th></th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    User No.
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Role
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Name
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Branch Name
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Date Started
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
                                            @foreach($user as $us)
                                                @if($us->id != Auth::user()->id)
                                                    @if($us->branch == null || $us->branch->status == 'Active')
                                                    <tr>
                                                        <td>
                                                            @if($us->profile_path==null)
                                                            <img class="w-10 h-10 h-8 mr-4 rounded-full ring-2 ring-emerald-300 dark:ring-emerald-500" src="{{ asset('storage/default.jpg') }}" alt="user-profile">
                                                            @else
                                                            <?php
                                                                $str = $us->profile_path;
                                                                $str = ltrim($str, 'public/');
                                                            ?>
                                                            <img class="w-10 h-10 h-8 mr-4 rounded-full ring-2 ring-emerald-300 dark:ring-emerald-500" src="{{ asset('../storage/'.$str) }}" alt="user-profile">
                                                            @endif
                                                        </td>
                                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                            {{$us->user_no}}
                                                        </td>
                                                        <td class="p-4 whitespace-nowrap text-sm font-normal ">
                                                            <span class="font-semibold">{{$us->user_type}}</span>
                                                        </td>
                                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                            {{$us->name}}
                                                        </td>
                                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                            @if($us->branch_id == null)
                                                            All Station
                                                            @else
                                                            {{$us->branch->branch_name}}
                                                            @endif
                                                            
                                                        </td>
                                                        <?php
                                                            $date = new DateTime($us->date_started);
                                                            $result = $date->format('F j, Y');
                                                        ?>
                                                        <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                            {{$result}}
                                                        </td>
                                                        <td class="p-4 whitespace-nowrap">
                                                            @if($us->status == 'Active')
                                                                <span class="bg-green-400 text-xs font-normal text-white font-bold py-1 px-3 rounded-full">
                                                                {{$us->status}}
                                                                </span>
                                                            @else
                                                                <span class="bg-red-400 text-xs font-normal text-white font-bold py-1 px-3 rounded-full">
                                                                {{$us->status}}
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                        @if($us->profile_path==null)
                                                        <button onclick="View({{$us->id}},document.getElementById('view-uploadedAvatar').src='{{ asset('storage/default.jpg') }}')" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                            <svg class="text-green-600 fill-current hover:text-green-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>
                                                        </button>
                                                        @else
                                                        <button onclick="View({{$us->id}},document.getElementById('view-uploadedAvatar').src='{{ asset('../storage/'.$str) }}')" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                            <svg class="text-green-600 fill-current hover:text-green-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>
                                                        </button>
                                                        @endif
                                                        @if($us->profile_path==null)
                                                        <button onclick="Edit({{$us->id}},document.getElementById('edit-uploadedAvatar').src='{{ asset('storage/default.jpg') }}')" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                            <svg class="text-blue-600 fill-current hover:text-blue-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                        </button>
                                                        @else
                                                        <button onclick="Edit({{$us->id}},document.getElementById('edit-uploadedAvatar').src='{{ asset('../storage/'.$str) }}')" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                            <svg class="text-blue-600 fill-current hover:text-blue-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                                <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                        </button>
                                                        @endif
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
        $('#sidebar-manageUser').addClass('text-white')
        
        // DataTable
        $('#dataTable').DataTable();

        // Submit Form
        $(document).ready(function (e) {
            // User Type Selection
            $('#user_type').on('change', function () {
                var dropdown = $('select[name="branch_id"]');
                var user_type = this.value;
                $('#branch_id').html('');
                if(user_type == 'Admin'){
                    dropdown.prop('disabled', false);
                    $('#branch_id').html('<option value="0">All Stations</option>');
                }else{
                    dropdown.prop('disabled', false);
                    $('#branch_id').html('<option value="" disabled selected hidden>Please choose...</option> ');
                    $.each(@json($branch), function (key, value) {
                        $('#branch_id').append('<option value="'+value.id+'">'+value.branch_name+'</option>');
                    });
                }
                
            });
            // User Type Selection
            $('#edit-user_type').on('change', function () {
                var dropdown = $('select[name="edit-branch_id"]');
                var user_type = this.value;
                $('#edit-branch_id').html('');
                if(user_type == 'Admin'){
                    dropdown.prop('disabled', false);
                    $('#edit-branch_id').html('<option value="0">All Stations</option>');
                }else{
                    dropdown.prop('disabled', false);
                    $('#edit-branch_id').html('<option value="" disabled selected hidden>Please choose...</option> ');
                    $.each(@json($branch), function (key, value) {
                        $('#edit-branch_id').append('<option value="'+value.id+'">'+value.branch_name+'</option>');
                    });
                }
                
            });
            // Add Data to Database
            $(document).on('submit','#adding', function(e) {
                e.preventDefault();
                let addformData = new FormData($('#adding')[0]);
                $.ajax({
                    type:'POST',
                    url: "{{ url('/api/user/create') }}",
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
                        let error_branch_id = "";
                        let error_user_no = "";
                        let error_name = "";
                        let error_age = "";
                        let error_contact_no = "";
                        let error_gender = "";
                        let error_address = "";
                        let error_birthday = "";
                        let error_date_started = "";
                        let error_personal_email = "";
                        let error_user_type = "";
                        let error_profile_picture = "";
                        for (const listKey in error1){
                            if(listKey == "branch_id"){
                                error_branch_id = ""+error1[listKey]+"";
                            }else if(listKey == "user_no"){
                                error_user_no = ""+error1[listKey]+"";
                            }else if(listKey == "name"){
                                error_name = ""+error1[listKey]+"";
                            }else if(listKey == "age"){
                                error_age = ""+error1[listKey]+"";
                            }else if(listKey == "contact_no"){
                                error_contact_no = ""+error1[listKey]+"";
                            }else if(listKey == "gender"){
                                error_gender = ""+error1[listKey]+"";
                            }else if(listKey == "address"){
                                error_address = ""+error1[listKey]+"";
                            }else if(listKey == "birthday"){
                                error_birthday = ""+error1[listKey]+"";
                            }else if(listKey == "date_started"){
                                error_date_started = ""+error1[listKey]+"";
                            }else if(listKey == "personal_email"){
                                error_personal_email = ""+error1[listKey]+"";   
                            }else if(listKey == "user_type"){
                                error_user_type = ""+error1[listKey]+"";
                            }else if(listKey == "profile_picture"){
                                error_profile_picture = ""+error1[listKey]+"";
                            }
                        }
                        let msg_branch_id = "<text>"+error_branch_id+"</text>";
                        let msg_user_no = "<text>"+error_user_no+"</text>";
                        let msg_name = "<text>"+error_name+"</text>";
                        let msg_age = "<text>"+error_age+"</text>";
                        let msg_contact_no = "<text>"+error_contact_no+"</text>";
                        let msg_gender = "<text>"+error_gender+"</text>";
                        let msg_address = "<text>"+error_address+"</text>";
                        let msg_birthday = "<text>"+error_birthday+"</text>";
                        let msg_date_started = "<text>"+error_date_started+"</text>";
                        let msg_personal_email = "<text>"+error_personal_email+"</text>";
                        let msg_user_type = "<text>"+error_user_type+"</text>";
                        let msg_profile_picture = "<text>"+error_profile_picture+"</text>";
                        $("#add-modal .errorMsg_branch_id").html(msg_branch_id).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_user_no").html(msg_user_no).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_name").html(msg_name).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_age").html(msg_age).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_contact_no").html(msg_contact_no).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_gender").html(msg_gender).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_address").html(msg_address).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_birthday").html(msg_birthday).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_date_started").html(msg_date_started).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_personal_email").html(msg_personal_email).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_user_type").html(msg_user_type).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_profile_picture").html(msg_profile_picture).addClass('text-red-500').fadeIn(1000);
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
                    url: "{{ url('/api/user/update') }}",
                    data: editformData,
                    cache: false,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    // If success, return message
                    success: (data) => {
                        $('#edit-modal').hide();
                        document.getElementById("success-label").innerHTML= "Successfully added to the database.";
                        $('#success-modal').fadeIn().delay(5000).fadeOut();
                        window.location.reload();
                    },
                    // If fail, show errors
                    error: function(data) {
                        const error1 = data.responseJSON.errors;
                        let error_branch_id = "";
                        let error_user_no = "";
                        let error_name = "";
                        let error_age = "";
                        let error_contact_no = "";
                        let error_gender = "";
                        let error_address = "";
                        let error_birthday = "";
                        let error_date_started = "";
                        let error_date_ended = "";
                        let error_personal_email = "";
                        let error_user_type = "";
                        let error_status = "";
                        let error_profile_picture = "";
                        for (const listKey in error1){
                            if(listKey == "edit-branch_id"){
                                error_branch_id = ""+error1[listKey]+"";
                            }else if(listKey == "edit-user_no"){
                                error_user_no = ""+error1[listKey]+"";
                            }else if(listKey == "edit-name"){
                                error_name = ""+error1[listKey]+"";
                            }else if(listKey == "edit-age"){
                                error_age = ""+error1[listKey]+"";
                            }else if(listKey == "edit-contact_no"){
                                error_contact_no = ""+error1[listKey]+"";
                            }else if(listKey == "edit-gender"){
                                error_gender = ""+error1[listKey]+"";
                            }else if(listKey == "edit-address"){
                                error_address = ""+error1[listKey]+"";
                            }else if(listKey == "edit-birthday"){
                                error_birthday = ""+error1[listKey]+"";
                            }else if(listKey == "edit-date_started"){
                                error_date_started = ""+error1[listKey]+"";
                            }else if(listKey == "edit-date_ended"){
                                error_date_ended = ""+error1[listKey]+"";
                            }else if(listKey == "edit-personal_email"){
                                error_personal_email = ""+error1[listKey]+"";   
                            }else if(listKey == "edit-user_type"){
                                error_user_type = ""+error1[listKey]+"";
                            }else if(listKey == "edit-status"){
                                error_status = ""+error1[listKey]+"";
                            }else if(listKey == "edit-profile_picture"){
                                error_profile_picture = ""+error1[listKey]+"";
                            }
                        }
                        let msg_branch_id = "<text>"+error_branch_id+"</text>";
                        let msg_user_no = "<text>"+error_user_no+"</text>";
                        let msg_name = "<text>"+error_name+"</text>";
                        let msg_age = "<text>"+error_age+"</text>";
                        let msg_contact_no = "<text>"+error_contact_no+"</text>";
                        let msg_gender = "<text>"+error_gender+"</text>";
                        let msg_address = "<text>"+error_address+"</text>";
                        let msg_birthday = "<text>"+error_birthday+"</text>";
                        let msg_date_started = "<text>"+error_date_started+"</text>";
                        let msg_date_ended = "<text>"+error_date_ended+"</text>";
                        let msg_personal_email = "<text>"+error_personal_email+"</text>";
                        let msg_user_type = "<text>"+error_user_type+"</text>";
                        let msg_status = "<text>"+error_status+"</text>";
                        let msg_profile_picture = "<text>"+error_profile_picture+"</text>";
                        $("#edit-modal .errorMsg_branch_id").html(msg_branch_id).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_user_no").html(msg_user_no).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_name").html(msg_name).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_age").html(msg_age).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_contact_no").html(msg_contact_no).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_gender").html(msg_gender).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_address").html(msg_address).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_birthday").html(msg_birthday).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_date_started").html(msg_date_started).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_date_ended").html(msg_date_ended).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_personal_email").html(msg_personal_email).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_user_type").html(msg_user_type).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_status").html(msg_status).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_profile_picture").html(msg_profile_picture).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal button").attr('disabled',false);
                    }
                });
            });
        })

        // Onclick Error Modal
        function Error(){
            $('#error-modal').fadeIn().delay(1000).fadeOut();
        }

        // Onclick Dismiss Modal
        function Dismiss(type){
            if(type == 'form-add'){
                $('#add-modal').hide();
            }else if(type == 'confirm'){
                $('#confirm-modal').hide();
            }else if(type == 'form-edit'){
                $('#edit-modal').hide();
            }else if(type == 'form-view'){
                $('#view-modal').hide();
            }
        }

        // Onclick Add Function
        function Add(){
            $('#view-modal').hide();
            document.getElementById("add-modal-title").innerHTML= "Create User Information";
            document.getElementById("uploadedAvatar").src = "{{ asset('storage/default.jpg') }}";
            document.getElementById("add-modal-submit").innerHTML= "Create";
            // Clear Input Fields
            $('#id').val('-1'),
            $('#user_no').val(''),
            $('#branch_id').val(''),
            $('#name').val(''),
            $('#age').val(''),
            $('#contact_no').val(''),
            $('#gender').val(''),
            $('#address').val(''),
            $('#birthday').val(''),
            $('#date_started').val(''),
            $('#personal_email').val(''),
            $('#user_type').val(''),
            $('#email').val(''),
            $('#password').val(''),
            $('#profile_picture').val(''),
            // Clear Error Messages
            $("#add-modal .errorMsg_branch_id").html('');
            $("#add-modal .errorMsg_user_no").html('');
            $("#add-modal .errorMsg_name").html('');
            $("#add-modal .errorMsg_age").html('');
            $("#add-modal .errorMsg_contact_no").html('');
            $("#add-modal .errorMsg_gender").html('');
            $("#add-modal .errorMsg_address").html('');
            $("#add-modal .errorMsg_birthday").html('');
            $("#add-modal .errorMsg_date_started").html('');
            $("#add-modal .errorMsg_personal_email").html('');
            $("#add-modal .errorMsg_user_type").html('');
            $("#add-modal .errorMsg_email").html('');
            $("#add-modal .errorMsg_password").html('');
            $("#add-modal .errorMsg_profile_picture").html('');
            // Show Modal
            $('#add-modal').show();
            // User No == Email (add)
            $('#user_no').keyup(function (){
                $('#email').val($(this).val());
            });
            // User No == Password (add)
            $('#user_no').keyup(function (){
                $('#password').val($(this).val());
            });
        }

        // Onclick Edit Function
        function Edit(id) {
            $('#view-modal').hide();
            document.getElementById("edit-modal-title").innerHTML= "Edit User Information";
            document.getElementById("edit-modal-submit").innerHTML= "Save";
            // Show Values in Modal
            Controller.Post('/api/user/items', { 'id': id }).done(function(result) {
                // Clear Error Messages
                $("#edit-modal .errorMsg_branch_id").html('');
                $("#edit-modal .errorMsg_user_no").html('');
                $("#edit-modal .errorMsg_name").html('');
                $("#edit-modal .errorMsg_age").html('');
                $("#edit-modal .errorMsg_contact_no").html('');
                $("#edit-modal .errorMsg_gender").html('');
                $("#edit-modal .errorMsg_address").html('');
                $("#edit-modal .errorMsg_birthday").html('');
                $("#edit-modal .errorMsg_date_started").html('');
                $("#edit-modal .errorMsg_date_ended").html('');
                $("#edit-modal .errorMsg_personal_email").html('');
                $("#edit-modal .errorMsg_user_type").html('');
                $("#edit-modal .errorMsg_status").html('');
                $("#edit-modal .errorMsg_email").html('');
                $("#edit-modal .errorMsg_password").html('');
                $("#edit-modal .errorMsg_profile_picture").html('');
                // Show ID values in Input Fields
                var res = 0;
                if(result.branch_id == null){
                    res = 0;
                    $('#edit-branch_id').html('<option value="0">All Stations</option>');

                }else{
                    res = result.branch_id;
                }
                $('#edit-id').val(result.id),
                $('#edit-user_no').val(result.user_no),
                $('#edit-branch_id').val(res),
                $('#edit-name').val(result.name),
                $('#edit-age').val(result.age),
                $('#edit-contact_no').val(result.contact_no),
                $('#edit-gender').val(result.gender),
                $('#edit-address').val(result.address),
                $('#edit-birthday').val(result.birthday),
                $('#edit-date_started').val(result.date_started),
                $('#edit-date_ended').val(result.date_ended),
                $('#edit-personal_email').val(result.personal_email),
                $('#edit-user_type').val(result.user_type),
                $('#edit-status').val(result.status),
                $('#edit-email').val(result.email),
                $('#edit-password').val(result.password_decrypted),
                $('#edit-profile_picture').val(result.profile_picture),
                // Show Modal
                $('#edit-modal').show();
            });
        }

        // Onclick View Function
        function View(id) {
            $('#view-modal-footer').html('');
            document.getElementById("view-modal-title").innerHTML= "View User Information";
            // Show Values in Modal
            Controller.Post('/api/user/items', { 'id': id }).done(function(result) {
                if(result.profile_path==null){
                    var edit1 = "document.getElementById('edit-uploadedAvatar').src='{{ asset('storage/default.jpg') }}'"
                    $('#view-modal-footer').append('<button type="button" onclick="Edit('+result.id+','+edit1+')" class=" text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Edit</button>');  
                }else{
                    var str = result.profile_path;
                    var str1 = str.replace('public/','')
                    var str2 = "document.getElementById('edit-uploadedAvatar').src='{{ asset('../storage/rep') }}'"
                    var edit2 = str2.replace('rep',''+str1+'')
                    $('#view-modal-footer').append('<button type="button" onclick="Edit('+result.id+','+edit2+')" class=" text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Edit</button>');  
                }
                var res = 0;
                if(result.branch_id == null){
                    res = 'All Stations';
                }else{
                    res = result.branch.branch_name;
                }
                // Show ID values in Input Fields
                $('#view-id').val(result.id),
                $('#view-user_no').val(result.user_no),
                $('#view-branch_id').val(res),
                $('#view-name').val(result.name),
                $('#view-age').val(result.age),
                $('#view-contact_no').val(result.contact_no),
                $('#view-gender').val(result.gender),
                $('#view-address').val(result.address),
                $('#view-birthday').val(result.birthday),
                $('#view-date_started').val(result.date_started),
                $('#view-date_ended').val(result.date_ended),
                $('#view-personal_email').val(result.personal_email),
                $('#view-user_type').val(result.user_type),
                $('#view-status').val(result.status),
                $('#view-email').val(result.email),
                $('#view-password').val(result.password_decrypted),
                $('#view-profile_picture').val(result.profile_picture),
                // Show Modal
                $('#view-modal').show();
            });
        }

    </script>
@endsection