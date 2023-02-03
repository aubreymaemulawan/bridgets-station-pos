@extends('layouts.app')
@section('title','My Profile')

@section('modal')
    <!-- Editing Modal -->
    <div id="edit-modal" role="dialog" aria-labelledby="edit-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="edit-modal-title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="Dismiss('form')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="px-6 lg:px-8">
                    <form class="space-y-6" enctype="multipart/form-data" id="editing">
                        @csrf
                        <!-- Hidden ID -->
                        <input type="hidden" id="edit-id" name="edit-id" value="{{Auth::user()->id}}">
                        <input type="hidden" id="edit-user_no" name="edit-user_no" value="{{Auth::user()->user_no}}">
                        <input type="hidden" id="edit-date_started" name="edit-date_started" value="{{Auth::user()->date_started}}">
                        <input type="hidden" id="edit-user_type" name="edit-user_type" value="{{Auth::user()->user_type}}">
                        <input type="hidden" id="edit-status" name="edit-status" value="{{Auth::user()->status}}">
                        <input type="hidden" id="edit-password_decrypted" name="edit-password_decrypted" value="{{Auth::user()->password_decrypted}}">
                        <input type="hidden" id="edit-password" name="edit-password" value="{{Auth::user()->password}}">
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
                        
                        <!-- Email Select -->
                        <div>
                            <label for="edit-email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input value="{{Auth::user()->email}}" type="text" name="edit-email" id="edit-email" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_email"></span>
                            </div>
                        </div>

                        <hr>

                        <!-- Name Input -->
                        <div>
                            <label for="edit-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name, First Name MI.</label>
                            <input value="{{Auth::user()->name}}" type="text" name="edit-name" id="edit-name" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_name"></span>
                            </div>
                        </div>

                        <!-- Personal Email Input -->
                        <div>
                            <label for="edit-personal_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Address</label>
                            <input value="{{Auth::user()->personal_email}}" type="email" name="edit-personal_email" id="edit-personal_email" placeholder="Ex. personal@email.com" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
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
                                <input value="{{Auth::user()->age}}" type="number" name="edit-age" id="edit-age" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 21" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_age"></span>
                                </div>
                            </div>
                            <!-- Contact No. Selection -->
                            <div>
                                <label for="edit-contact_no" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact Number</label>
                                <input value="{{Auth::user()->contact_no}}" type="number" name="edit-contact_no" id="edit-contact_no" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 09123456789" >
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
                                <select value="{{Auth::user()->gender}}" name="edit-gender" id="edit-gender" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
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
                                <input value="{{Auth::user()->birthday}}" type="date" name="edit-birthday" id="edit-birthday" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 09123456789" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_birthday"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Address Input -->
                        <div class="pb-4">
                            <label for="edit-address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input value="{{Auth::user()->address}}" type="text" name="edit-address" id="edit-address" placeholder="Ex. Phase 2 Macanhan Carmen CDO City" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_address"></span>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="pb-5">
                            <button id="edit-modal-submit" type="submit" class=" text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 dark:focus:ring-emerald-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
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
    <!-- / Editing Modal -->

    <!-- Password Modal -->
    <div id="main-modal" role="dialog" aria-labelledby="main-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex h-screen justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="modal-title" class="pr-5 text-xl font-semibold text-gray-900 dark:text-white"></h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="Dismiss('pass-form')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="px-6 lg:px-8">
                    <form class="space-y-6" id="updating" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden ID -->
                        <input type="hidden" id="id" name="id" value="{{Auth::user()->id}}">
                        <!-- Current Password Select -->
                        <div>
                            <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
                            <input type="text" name="current_password" id="current_password" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_current_password"></span>
                            </div>
                        </div>
                        <!-- New Password Input -->
                        <div>
                            <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                            <input type="text" name="new_password" id="new_password" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_new_password"></span>
                            </div>
                        </div>
                        <!-- Re-type Password Input -->
                        <div class="pb-4">
                            <label for="retype_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Re-type Password</label>
                            <input type="text" name="retype_password" id="retype_password" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_retype_password"></span>
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="pb-5">
                            <button id="modal-submit" type="submit" class=" text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 dark:focus:ring-emerald-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Create
                            </button>
                            <button onclick="Dismiss('pass-form')" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Password Modal -->

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
        <div class="container mx-auto my-5 p-5 h-screen">
            <div class="md:flex no-wrap md:-mx-2 ">
                <!-- Left Side -->
                <div class="w-full md:w-3/12 md:mx-2">
                    <!-- Profile Card -->
                    <div class="bg-white p-3 border-t-4 border-green-500">
                        <div class="image overflow-hidden">
                            @if(Auth::user()->profile_path=="")
                                <img class="h-auto max-w-full rounded-lg mx-auto" src="{{ asset('dist/images/default.jpg') }}" alt="user-profile">
                            @else
                                <?php
                                    $str = Auth::user()->profile_path;
                                    $str = ltrim($str, 'public/');
                                ?>
                                <img class="h-auto max-w-full rounded-lg mx-auto" src="{{ asset('../storage/'.$str) }}" alt="user-profile">
                            @endif
                        </div>
                        <h1 class="text-gray-900 font-bold text-xl leading-8 my-1 pt-3">{{Auth::user()->name}}</h1>
                        <h3 class="text-gray-600 font-lg text-semibold leading-6 pb-2">Admin, Bridget's Station</h3>
                    </div>
                    <!-- End of profile card -->
                    <div class="my-4"></div>
                </div>
                <!-- Right Side -->
                <div class="w-full md:w-9/12 mx-2 h-64">
                    <!-- Profile tab -->
                    <div class="bg-white p-3 shadow-sm rounded-sm">
                        <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 pb-4 pl-2 pt-4">
                            <span clas="text-green-500">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </span>
                            <span class="tracking-wide">About</span>
                        </div>
                        <div class="p-4 mb-4 text-sm text-gray-700 bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-gray-400" role="alert">
                        <?php
                            if(Auth::user()->updated_at){
                                $date2 = new DateTime(Auth::user()->updated_at);
                                $result2 = $date2->format('F j, Y h:m a');
                            }else{
                                $date2 = new DateTime(Auth::user()->created_at);
                                $result2 = $date2->format('F j, Y h:m a');
                            }
                        ?>
                        <span class="font-medium">Account Last Updated:</span> 
                        {{$result2}}
                        </div>
                        <div class="text-gray-700 pb-4">
                            <div class="grid md:grid-cols-2 text-sm ">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Name</div>
                                    <div class="px-4 py-2">{{Auth::user()->name}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">User No.</div>
                                    <div class="px-4 py-2">{{Auth::user()->user_no}}</div>
                                </div>
                                
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Contact No.</div>
                                    <div class="px-4 py-2">{{Auth::user()->contact_no}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Gender</div>
                                    <div class="px-4 py-2">{{Auth::user()->gender}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Birthday</div>
                                    <?php
                                        $date = new DateTime(Auth::user()->birthday);
                                        $result = $date->format('F j, Y');
                                    ?>
                                    <div class="px-4 py-2">{{$result}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Age</div>
                                    <div class="px-4 py-2">{{Auth::user()->age}} yrs old</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Username</div>
                                    <div class="px-4 py-2">{{Auth::user()->email}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Date Started</div>
                                    <?php
                                        $date1 = new DateTime(Auth::user()->date_started);
                                        $result1 = $date1->format('F j, Y');
                                    ?>
                                    <div class="px-4 py-2">{{$result1}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Address</div>
                                    <div class="px-4 py-2">{{Auth::user()->address}}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Email</div>
                                    <div class="px-4 py-2">
                                        <a class="text-blue-800" href="mailto:jane@example.com">{{Auth::user()->personal_email}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-2 grid grid-cols-2">
                        @if(Auth::user()->profile_path==null)
                        <button onclick="Edit(document.getElementById('edit-uploadedAvatar').src='{{ asset('storage/default.jpg') }}')" class="mr-1 bg-emerald-100 text-black-800 text-sm font-semibold rounded-lg hover:bg-emerald-300 focus:outline-none focus:shadow-outline focus:bg-emerald-100 hover:shadow-xs p-3 my-4">
                            Edit Information
                        </button>
                        @else
                        <?php
                            $str = Auth::user()->profile_path;
                            $str = ltrim($str, 'public/');
                        ?>
                        <button onclick="Edit(document.getElementById('edit-uploadedAvatar').src='{{ asset('../storage/'.$str) }}')" class="mr-1 bg-emerald-100 text-black-800 text-sm font-semibold rounded-lg hover:bg-emerald-300 focus:outline-none focus:shadow-outline focus:bg-emerald-100 hover:shadow-xs p-3 my-4">
                            Edit Information
                        </button>
                        @endif
                        <button onclick="Password()" class="mr-1 bg-emerald-100 text-black-800 text-sm font-semibold rounded-lg hover:bg-emerald-300 focus:outline-none focus:shadow-outline focus:bg-emerald-100 hover:shadow-xs p-3 my-4">
                            Change Password
                        </button>
                        </div>
                    </div>
                    <!-- End of profile tab -->
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        // Sidebar
        $('[id^="sidebar-"]').removeClass('text-white')
        $('#sidebar-profile').addClass('text-white')

        // Submit Form
        $(document).ready(function (e) {            
            // Update/Edit Data
            $(document).on('submit','#editing', function(e) {
                e.preventDefault();
                let editformData = new FormData($('#editing')[0]);
                $.ajax({
                    type:'POST',
                    url: "{{ url('/api/profile/update') }}",
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
                        let error_name = "";
                        let error_age = "";
                        let error_contact_no = "";
                        let error_gender = "";
                        let error_address = "";
                        let error_birthday = "";
                        let error_personal_email = "";
                        let error_profile_picture = "";
                        let error_email = "";
                        for (const listKey in error1){
                            if(listKey == "edit-name"){
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
                            }else if(listKey == "edit-personal_email"){
                                error_personal_email = ""+error1[listKey]+"";   
                            }else if(listKey == "edit-profile_picture"){
                                error_profile_picture = ""+error1[listKey]+"";
                            }else if(listKey == "edit-email"){
                                error_email = ""+error1[listKey]+"";
                            }
                        }
                        let msg_name = "<text>"+error_name+"</text>";
                        let msg_age = "<text>"+error_age+"</text>";
                        let msg_contact_no = "<text>"+error_contact_no+"</text>";
                        let msg_gender = "<text>"+error_gender+"</text>";
                        let msg_address = "<text>"+error_address+"</text>";
                        let msg_birthday = "<text>"+error_birthday+"</text>";
                        let msg_personal_email = "<text>"+error_personal_email+"</text>";
                        let msg_profile_picture = "<text>"+error_profile_picture+"</text>";
                        let msg_email = "<text>"+error_email+"</text>";
                        $("#edit-modal .errorMsg_name").html(msg_name).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_age").html(msg_age).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_contact_no").html(msg_contact_no).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_gender").html(msg_gender).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_address").html(msg_address).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_birthday").html(msg_birthday).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_personal_email").html(msg_personal_email).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_profile_picture").html(msg_profile_picture).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_email").html(msg_email).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal button").attr('disabled',false);
                    }
                });
            });

            // Update/Edit Data
            $(document).on('submit','#updating', function(e) {
                $("#main-modal .errorMsg_current_password").html('');
                $("#main-modal .errorMsg_new_password").html('');
                $("#main-modal .errorMsg_retype_password").html('');
                e.preventDefault();
                let editformData = new FormData($('#updating')[0]);
                $.ajax({
                    type:'POST',
                    url: "{{ url('/api/profile/update_password') }}",
                    data: editformData,
                    cache: false,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    // If success, return message
                    success: (data) => {
                        if(data == 1){
                            let msg_current_password = "<text>The password is incorrect.</text>";
                            $("#main-modal .errorMsg_current_password").html(msg_current_password).addClass('text-red-500').fadeIn(1000);
                            $("#main-modal button").attr('disabled',false);
                        }else if(data == 2){
                            let msg_new_password = "<text>Please choose a new password.</text>";
                            $("#main-modal .errorMsg_new_password").html(msg_new_password).addClass('text-red-500').fadeIn(1000);
                            $("#main-modal button").attr('disabled',false);
                        }else{
                            $('#main-modal').hide();
                            document.getElementById("success-label").innerHTML= "Password Successfully updated.";
                            $('#success-modal').fadeIn().delay(5000).fadeOut();
                            window.location.reload();
                        }
                        
                    },
                    // If fail, show errors
                    error: function(data) {
                        const error2 = data.responseJSON.errors;
                        let error_current_password = "";
                        let error_new_password = "";
                        let error_retype_password = "";
                        for (const listKey in error2){
                            if(listKey == "current_password"){
                                error_current_password = ""+error2[listKey]+"";
                            }else if(listKey == "new_password"){
                                error_new_password = ""+error2[listKey]+"";
                            }else if(listKey == "retype_password"){
                                error_retype_password = ""+error2[listKey]+"";
                            }
                        }
                        let msg_current_password = "<text>"+error_current_password+"</text>";
                        let msg_new_password = "<text>"+error_new_password+"</text>";
                        let msg_retype_password = "<text>"+error_retype_password+"</text>";
                        $("#main-modal .errorMsg_current_password").html(msg_current_password).addClass('text-red-500').fadeIn(1000);
                        $("#main-modal .errorMsg_new_password").html(msg_new_password).addClass('text-red-500').fadeIn(1000);
                        $("#main-modal .errorMsg_retype_password").html(msg_retype_password).addClass('text-red-500').fadeIn(1000);
                        $("#main-modal button").attr('disabled',false);
                    }
                });
            });
        })

        // Onclick Dismiss Modal
        function Dismiss(type){
            if(type == 'form'){
                $('#edit-modal').hide();
            }else if(type == 'pass-form'){
                $('#main-modal').hide();
            }
            
        }

        // Onclick Edit Function
        function Edit(id) {
            document.getElementById("edit-modal-title").innerHTML= "Edit My Information";
            document.getElementById("edit-modal-submit").innerHTML= "Save"; 
            // Clear Error Messages
            $("#edit-modal .errorMsg_name").html('');
            $("#edit-modal .errorMsg_age").html('');
            $("#edit-modal .errorMsg_contact_no").html('');
            $("#edit-modal .errorMsg_gender").html('');
            $("#edit-modal .errorMsg_address").html('');
            $("#edit-modal .errorMsg_birthday").html('');
            $("#edit-modal .errorMsg_personal_email").html('');
            $("#edit-modal .errorMsg_email").html('');
            $("#edit-modal .errorMsg_profile_picture").html('');   
            // Show ID values in Input Fields
            $('#edit-id').val('{{Auth::user()->id}}'),
            $('#edit-user_no').val('{{Auth::user()->user_no}}'),
            $('#edit-branch_id').val('{{Auth::user()->branch_id}}'),
            $('#edit-name').val('{{Auth::user()->name}}'),
            $('#edit-age').val('{{Auth::user()->age}}'),
            $('#edit-contact_no').val('{{Auth::user()->contact_no}}'),
            $('#edit-gender').val('{{Auth::user()->gender}}'),
            $('#edit-address').val('{{Auth::user()->address}}'),
            $('#edit-birthday').val('{{Auth::user()->birthday}}'),
            $('#edit-date_started').val('{{Auth::user()->date_started}}'),
            $('#edit-date_ended').val('{{Auth::user()->date_ended}}'),
            $('#edit-personal_email').val('{{Auth::user()->personal_email}}'),
            $('#edit-user_type').val('{{Auth::user()->user_type}}'),
            $('#edit-status').val('{{Auth::user()->status}}'),
            $('#edit-email').val('{{Auth::user()->email}}'),
            $('#edit-password').val('{{Auth::user()->password}}'),
            $('#edit-password_decrypted').val('{{Auth::user()->password_decrypted}}'),
            // Show Modal
            $('#edit-modal').show();
        }

        // Onclick Password Function
        function Password(id) {
            document.getElementById("modal-title").innerHTML= "Update My Password";
            document.getElementById("modal-submit").innerHTML= "Save"; 
            $("#main-modal .errorMsg_current_password").html('');
            $("#main-modal .errorMsg_new_password").html('');
            $("#main-modal .errorMsg_retype_password").html('');
            $('#current_password').val('');
            $('#new_password').val('');
            $('#retype_password').val('');
            $('#main-modal').show();
        }
    </script>
@endsection