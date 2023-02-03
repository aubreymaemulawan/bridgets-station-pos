@extends('layouts.app')
@section('title','Menu List')

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
                        
                        <!-- Menu Picture -->
                        <div class="grid grid-flow-col-dense grid-row-2 justify-start">
                            <div>
                                <img id="uploadedAvatar" class="w-24 h-24 rounded" src="{{ asset('storage/default2.png') }}" alt="Default avatar">
                            </div>
                            <div class="pl-5 pt-2 ">
                                <label class="bg-emerald-400 hover:bg-emerald-700 text-white text-sm font-normal py-2 px-4 rounded mr-2">
                                    Upload new photo
                                    <input type="file" id="menu_picture" name="menu_picture" class="account-file-input" hidden accept="image/png, image/jpeg"/>
                                </label>
                                <label type="button" class="mt-3 account-image-reset bg-gray-400 hover:bg-gray-700 text-white text-sm font-normal py-2 px-4 rounded">
                                    Reset
                                </label>
                                <div class="block pt-3 mb-2 text-sm font-normal text-gray-900 dark:text-white" >
                                    Allowed JPG, GIF or PNG. Max size of 2048K
                                </div>
                                <!-- Erro Message -->
                                <div class="text-sm">
                                    <span class="errorMsg_menu_picture"></span>
                                </div>
                            </div>
                        </div>
                        
                        <hr>

                        <!-- Branch & Category -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
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
                            <!-- Category Selection -->
                            <div>
                                <label for="cat_id" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select name="cat_id" id="cat_id" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
                                    <option value="" disabled selected hidden>Please choose...</option>
                                    @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                    @endforeach
                                </select>  
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_cat_id"></span>
                                </div>                          
                            </div>
                        </div>

                        <!-- Menu Code Input -->
                        <div>
                            <label for="menu_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menu Code</label>
                            <input type="text" name="menu_code" id="menu_code" placeholder="Ex. ABC123" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_menu_code"></span>
                            </div>
                        </div>

                        <!-- Menu Name Input -->
                        <div>
                            <label for="menu_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menu Name</label>
                            <input type="text" name="menu_name" id="menu_name" placeholder="Ex. Fried Chicken" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_menu_name"></span>
                            </div>
                        </div>

                        <!-- Price & Servings -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Price Select -->
                            <div>
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input type="number" name="price" id="price" placeholder="Ex. ₱ 100.00" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_price"></span>
                                </div>
                            </div>
                            <!-- Servings Selection -->
                            <div>
                                <label for="servings" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Servings</label>
                                <input type="number" name="servings" id="servings" placeholder="Ex. 50" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_servings"></span>
                                </div>
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

                        <!-- Photo Picture -->
                        <div class="grid grid-flow-col-dense grid-row-2 justify-start">
                            <div>
                                <img id="edit-uploadedAvatar" class="w-24 h-24 rounded" src="{{ asset('storage/default2.png') }}" alt="Default avatar">
                            </div>
                            <div class="pl-5 pt-2 ">
                                <label class="bg-emerald-400 hover:bg-emerald-700 text-white text-sm font-normal py-2 px-4 rounded mr-2">
                                    Upload new photo
                                    <input type="file" id="edit-photo_picture" name="edit-photo_picture" class="edit-account-file-input" hidden accept="image/png, image/jpeg"/>
                                </label>
                                <label type="button" class="mt-3 edit-account-image-reset bg-gray-400 hover:bg-gray-700 text-white text-sm font-normal py-2 px-4 rounded">
                                    Reset
                                </label>
                                <div class="block pt-3 mb-2 text-sm font-normal text-gray-900 dark:text-white" >
                                    Allowed JPG, GIF or PNG. Max size of 2048K
                                </div>
                                <!-- Erro Message -->
                                <div class="text-sm">
                                    <span class="errorMsg_photo_picture"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Branch & Category -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Branch Select -->
                            <div>
                                <label for="edit-branch_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
                                <select name="edit-branch_id" id="edit-branch_id" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
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
                            <!-- Category Selection -->
                            <div>
                                <label for="edit-cat_id" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select name="edit-cat_id" id="edit-cat_id" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
                                    <option value="" disabled selected hidden>Please choose...</option>
                                    @foreach($category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                    @endforeach
                                </select>  
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_cat_id"></span>
                                </div>                          
                            </div>
                        </div>

                        <!-- Menu Code Input -->
                        <div>
                            <label for="edit-menu_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menu Code</label>
                            <input type="text" name="edit-menu_code" id="edit-menu_code" placeholder="Ex. ABC123" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_menu_code"></span>
                            </div>
                        </div>

                        <!-- Menu Name Input -->
                        <div>
                            <label for="edit-menu_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menu Name</label>
                            <input type="text" name="edit-menu_name" id="edit-menu_name" placeholder="Ex. Fried Chicken" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_menu_name"></span>
                            </div>
                        </div>

                        <!-- Price & Servings -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Price Select -->
                            <div>
                                <label for="edit-price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input type="number" name="edit-price" id="edit-price" placeholder="Ex. ₱ 100.00" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_price"></span>
                                </div>
                            </div>
                            <!-- Servings Selection -->
                            <div>
                                <label for="edit-servings" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Servings</label>
                                <input type="number" name="edit-servings" id="edit-servings" placeholder="Ex. 50" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_servings"></span>
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
                        
                        <!-- Menu Picture -->
                        <div class="grid grid-flow-col-dense  justify-center">
                            <div>
                                <img id="view-uploadedAvatar" class="w-24 h-24 rounded" src="{{ asset('storage/default2.png') }}" alt="Default avatar">
                            </div>
                        </div>
                        
                        <!-- Branch & Category -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Branch Select -->
                            <div>
                                <label for="view-branch_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
                                <input disabled type="text" name="view-branch_id" id="view-branch_id" class="bg-emerald-50 border border-emerald-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                            <!-- Category Selection -->
                            <div>
                                <label for="view-category_id" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <input disabled type="text" name="view-category_id" id="view-category_id" class="bg-emerald-50 border border-emerald-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                        </div>

                        <hr>

                        <!-- Menu Code Input -->
                        <div>
                            <label for="view-menu_code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menu Code</label>
                            <input disabled type="text" name="view-menu_code" id="view-menu_code" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_menu_code"></span>
                            </div>
                        </div>


                        <!-- Menu Name Input -->
                        <div>
                            <label for="view-menu_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menu Name</label>
                            <input disabled type="text" name="view-menu_name" id="view-menu_name" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_menu_name"></span>
                            </div>
                        </div>

                        <!-- Price & Servings -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Price Select -->
                            <div>
                                <label for="view-price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                <input disabled type="text" name="view-price" id="view-price" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            </div>
                            <!-- Servings Selection -->
                            <div>
                                <label for="view-servings" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Servings</label>
                                <input disabled type="text" name="view-servings" id="view-servings" class="bg-emerald-50 border border-emerald-300 focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
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
                    <h3 id="error-label" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Oops! Category table is empty.</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- / Error Modal -->

    <!-- Category Add & Edit Modal -->
    <div id="category-modal" role="dialog" aria-labelledby="category-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex h-screen justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="category-title" class="text-xl font-semibold text-gray-900 dark:text-white pr-8"></h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="Dismiss('category-form')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="px-6 lg:px-8">
                    <form class="space-y-6">
                        @csrf
                        <!-- Hidden ID -->
                        <input type="hidden" id="category_id" name="category_id">
                        <!-- Product Name Input -->
                        <div>
                            <label for="category_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Name</label>
                            <input type="text" name="category_name" id="category_name" placeholder="Ex. Drinks" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" >
                            <!-- Error Message -->
                            <div class="pt-1 text-sm">
                                <span class="errorMsg_category_name"></span>
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="pb-5">
                            <button onclick="SaveCategory()" id="category-submit" type="button" class=" text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 dark:focus:ring-emerald-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Create
                            </button>
                            <button onclick="Dismiss('category-form')" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Category Add & Edit Modal -->

    <!-- Ingredients Modal -->
    <div id="ingredients-modal" role="dialog" aria-labelledby="ingredients-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex h-screen justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="ingredients-modal-title" class="text-xl font-semibold text-gray-900 dark:text-white"></h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="Dismiss('form-ingredients')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="px-6 lg:px-8">
                    <form class="space-y-6" enctype="multipart/form-data" id="ingredients">
                        @csrf
                        <!-- Hidden ID -->
                        <input type="hidden" id="id" name="id">

                        <!-- Inventory & Quantity -->
                        <div id="inv_list" class="grid grid-rows-1 grid-cols-2 gap-4 pb-8">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Ingredients Modal -->

    <!-- Ingredients Add & Edit Modal -->
    <div id="ing-modal" role="dialog" aria-labelledby="ing-modalLabel" aria-hidden="true" tabindex="-1" class="grid h-screen place-items-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div  class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>    
        <div class="flex h-screen justify-center items-center bg-opacity-75 transition-opacity">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 id="ing-title" class="text-xl font-semibold text-gray-900 dark:text-white pr-8"></h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="Dismiss('ing-form')">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="px-6 lg:px-8">
                    <form class="space-y-6">
                        @csrf
                        <!-- Hidden ID -->
                        <input type="hidden" id="ingredients_id" name="ingredients_id">
                        <!-- Branch & Category -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Branch Input -->
                            <div>
                                <label for="br_id" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch Name</label>
                                <select name="br_id" id="br_id" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
                                    <option value="" disabled selected hidden>Please choose...</option>
                                    @foreach($branch as $br)
                                    <option value="{{$br->id}}">{{$br->branch_name}}</option>
                                    @endforeach
                                </select>  
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_br_id"></span>
                                </div>                       
                            </div>
                            <!-- Menu Name Selection -->
                            <div>
                                <label for="mn_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Menu Name</label>
                                <select name="mn_id" id="mn_id" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
                                    <option value="" disabled selected hidden>Please choose...</option>
                                    @foreach($menu_active as $mna)
                                    <option value="{{$mna->id}}">{{$mna->menu_code}} - {{$mna->menu_name}}</option>
                                    @endforeach
                                </select>  
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_mn_id"></span>
                                </div>
                            </div>
                        </div>
                        <!-- Branch & Category -->
                        <div class="grid grid-rows-1 grid-cols-2 gap-4">
                            <!-- Product Name Selection -->
                            <div>
                                <label for="inv_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
                                <select name="inv_id" id="inv_id" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" >
                                    <option value="" disabled selected hidden>Please choose...</option>
                                    @foreach($inventory as $inv)
                                    <option value="{{$inv->id}}">{{$inv->product_name}} - {{$inv->measurement}}</option>
                                    @endforeach
                                </select>  
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_inv_id"></span>
                                </div>
                            </div>
                            <!-- Quantity -->
                            <div>
                                <label for="qty" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity (Per Serving)</label>
                                <input name="qty" id="qty" class="focus:outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 10" >
                                <!-- Error Message -->
                                <div class="pt-1 text-sm">
                                    <span class="errorMsg_qty"></span>
                                </div>                          
                            </div>
                        </div>
                        <!-- Buttons -->
                        <div class="pb-5">
                            <button onclick="SaveIngredients()" id="ing-submit" type="button" class=" text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 dark:focus:ring-emerald-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Create
                            </button>
                            <button onclick="Dismiss('ing-form')" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Ingredients Add & Edit Modal -->

@endsection

@section('admin_content')
    <main>
        <div class="pt-6 px-4 bg-gray-900">

            <!-- Categories -->
            <div class="w-full grid grid-cols-1 xl:grid-cols-1 2xl:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 mb-4 ">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold  mb-2">Categories List</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of all menu categories.</span>
                        </div>
                        <div>
                            <button onclick="AddCategory()" class="btn focus:ring-4 focus:outline-none focus:ring-emerald-300 bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-full">
                                Add Menu
                            </button>
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
                                                    Category Name
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Total Active Menu
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach($category as $cat)
                                            <tr>
                                                <td></td>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal ">
                                                    <span class="font-semibold">{{$cat->category_name}}</span>
                                                </td>
                                                <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                    {{$cat->category_name}}
                                                </td>
                                                <td>
                                                    <button onclick="EditCategory({{$cat->id}})" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                        <svg class="text-blue-600 fill-current hover:text-blue-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                    </button>
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

            <!-- Menu -->
            <div class="w-full grid grid-cols-1 xl:grid-cols-1 2xl:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 mb-4 ">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold  mb-2">Menu List</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of all menu.</span>
                        </div>
                        <div>
                            @if(count($category) == 0)
                                <button onclick="Error(document.getElementById('error-label').innerHTML='Oops! Category table is empty.')" class="btn bg-emerald-500 hover:bg-emerald-400 text-white font-bold py-2 px-4 rounded-full">
                                    Add New
                                </button>
                            @elseif(count($branch) == 0)
                                <button onclick="Error(document.getElementById('error-label').innerHTML='Oops! Branch table is empty.')" class="btn bg-emerald-500 hover:bg-emerald-400 text-white font-bold py-2 px-4 rounded-full">
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
                                    <table id="dataTable1" class="hover:table-auto min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th></th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Branch
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Category
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Menu Name
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Price
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Servings
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
                                            @foreach($menu as $mn)
                                                <tr>
                                                    <td>
                                                        @if($mn->photo_path==null)
                                                        <img class="w-10 h-10 h-8 mr-4 rounded-full ring-2 ring-emerald-300 dark:ring-emerald-500" src="{{ asset('storage/default2.png') }}" alt="user-profile">
                                                        @else
                                                        <?php
                                                            $str = $mn->photo_path;
                                                            $str = ltrim($str, 'public/');
                                                        ?>
                                                        <img class="w-10 h-10 h-8 mr-4 rounded-full ring-2 ring-emerald-300 dark:ring-emerald-500" src="{{ asset('../storage/'.$str) }}" alt="user-profile">
                                                        @endif
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal">
                                                        <span class="font-semibold">{{$mn->branch->branch_name}}</span>
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$mn->category->category_name}}
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$mn->menu_name}}
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        ₱ {{$mn->price}}
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$mn->servings}}
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap">
                                                        @if($mn->status == 'Active')
                                                            <span class="bg-green-400 text-xs font-normal text-white font-bold py-1 px-3 rounded-full">
                                                            {{$mn->status}}
                                                            </span>
                                                        @else
                                                            <span class="bg-red-400 text-xs font-normal text-white font-bold py-1 px-3 rounded-full">
                                                            {{$mn->status}}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                    @if($mn->photo_path==null)
                                                    <button onclick="View({{$mn->id}},document.getElementById('view-uploadedAvatar').src='{{ asset('storage/default2.png') }}')" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                        <svg class="text-green-600 fill-current hover:text-green-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                        <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>
                                                    </button>
                                                    @else
                                                    <button onclick="View({{$mn->id}},document.getElementById('view-uploadedAvatar').src='{{ asset('../storage/'.$str) }}')" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                        <svg class="text-green-600 fill-current hover:text-green-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                        <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>
                                                    </button>
                                                    @endif
                                                    @if($mn->photo_path==null)
                                                    <button onclick="Edit({{$mn->id}},document.getElementById('edit-uploadedAvatar').src='{{ asset('storage/default2.png') }}')" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                        <svg class="text-blue-600 fill-current hover:text-blue-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                    </button>
                                                    @else
                                                    <button onclick="Edit({{$mn->id}},document.getElementById('edit-uploadedAvatar').src='{{ asset('../storage/'.$str) }}')" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                        <svg class="text-blue-600 fill-current hover:text-blue-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                    </button>
                                                    @endif
                                                    <button onclick="Ingredients({{$mn->id}}, {{$mn->branch_id}})" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
                                                    <svg class="text-orange-600 fill-current hover:text-orange-400 w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                        <path d="M0 192c0-35.3 28.7-64 64-64c.5 0 1.1 0 1.6 0C73 91.5 105.3 64 144 64c15 0 29 4.1 40.9 11.2C198.2 49.6 225.1 32 256 32s57.8 17.6 71.1 43.2C339 68.1 353 64 368 64c38.7 0 71 27.5 78.4 64c.5 0 1.1 0 1.6 0c35.3 0 64 28.7 64 64c0 11.7-3.1 22.6-8.6 32H8.6C3.1 214.6 0 203.7 0 192zm0 91.4C0 268.3 12.3 256 27.4 256H484.6c15.1 0 27.4 12.3 27.4 27.4c0 70.5-44.4 130.7-106.7 154.1L403.5 452c-2 16-15.6 28-31.8 28H140.2c-16.1 0-29.8-12-31.8-28l-1.8-14.4C44.4 414.1 0 353.9 0 283.4z"/></svg>
                                                    </button>
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

            <!-- Ingredients -->
            <div class="w-full grid grid-cols-1 xl:grid-cols-1 2xl:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 mb-4 ">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold  mb-2">Menu Ingredients List</h3>
                            <span class="text-base font-normal text-gray-500">This is a list of all menu ingredients.</span>
                        </div>
                        <div>
                            @if(count($category) == 0)
                                <button onclick="Error(document.getElementById('error-label').innerHTML='Oops! Category table is empty.')" class="btn bg-emerald-500 hover:bg-emerald-400 text-white font-bold py-2 px-4 rounded-full">
                                    Add New
                                </button>
                            @elseif(count($branch) == 0)
                                <button onclick="Error(document.getElementById('error-label').innerHTML='Oops! Branch table is empty.')" class="btn bg-emerald-500 hover:bg-emerald-400 text-white font-bold py-2 px-4 rounded-full">
                                    Add New
                                </button>
                            @elseif(count($menu_active) == 0)
                                <button onclick="Error(document.getElementById('error-label').innerHTML='Oops! Menu table is empty.')" class="btn bg-emerald-500 hover:bg-emerald-400 text-white font-bold py-2 px-4 rounded-full">
                                    Add New
                                </button>
                            @else
                                <button onclick="AddIngredients()" class="btn focus:ring-4 focus:outline-none focus:ring-emerald-300 bg-emerald-500 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-full">
                                    Add New
                                </button>
                            @endif                       
                        </div>
                    </div>
                    <div class="flex flex-col mt-8">
                        <div class="overflow-x-auto rounded-lg">
                            <div class="align-middle inline-block min-w-full">
                                <div class="shadow overflow-hidden sm:rounded-lg">
                                    <table id="dataTable2" class="hover:table-auto min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th></th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Branch
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Menu Name
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Product Name
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Quantity
                                                </th>
                                                <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach($ingredients as $in)
                                                @if($in->menu->status == 'Active')
                                                <tr>
                                                    <td></td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal">
                                                        <span class="font-semibold">{{$in->menu->branch->branch_name}}</span>
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$in->menu->menu_name}}
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$in->inventory->product_name}}
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$in->quantity}} {{$in->inventory->measurement}} 
                                                    </td>
                                                    <td>
                                                    <button onclick="EditIngredients({{$in->id}})" class="bg-grey-light hover:bg-grey text-grey-darkest font-bold rounded inline-flex items-center">
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
        $('#sidebar-menu').addClass('text-white')
        
        // DataTable
        $('#dataTable').DataTable();
        $('#dataTable1').DataTable();
        $('#dataTable2').DataTable();

        var dropdown = $('select[name="inv_id"]');
        var dropdown2 = $('select[name="mn_id"]');
        // Submit Form
        $(document).ready(function (e) {
            // Dynamic Dropdown
            $('#br_id').on('change', function () {
                // Clear Error Messages
                $("#ing-modal .errorMsg_br_id").html('');
                $("#ing-modal .errorMsg_inv_id").html('');
                $("#ing-modal .errorMsg_mn_id").html('');
                $("#ing-modal .errorMsg_qty").html('');
                var branchId = this.value;
                $('#mn_id').html('');
                Controller.Post('/api/menu/list2', { 'branch_id': branchId }).done(function(result2) {
                    dropdown2.prop('disabled', false);
                    $('#mn_id').html('<option value="" disabled selected hidden>Please choose...</option>');
                    $.each(result2, function (key, value2) {
                        $('#mn_id').append('<option value="'+ value2.id +'">'+ value2.menu_code +' - '+ value2.menu_name + '</option>');                            
                    });
                });
                $('#inv_id').html('');
                Controller.Post('/api/inventory/list', { 'branch_id': branchId }).done(function(result) {
                    dropdown.prop('disabled', false);
                    $('#inv_id').html('<option value="" disabled selected hidden>Please choose...</option>');
                    $.each(result, function (key, value) {
                        $('#inv_id').append('<option value="'+ value.id +'">' + value.product_name + ' - ' + value.measurement + '</option>');                            
                    });
                });
            });
            // Add Data to Database
            $(document).on('submit','#adding', function(e) {
                e.preventDefault();
                let addformData = new FormData($('#adding')[0]);
                $.ajax({
                    type:'POST',
                    url: "{{ url('/api/menu/create') }}",
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
                        let error_cat_id = "";
                        let error_menu_code = "";
                        let error_menu_name = "";
                        let error_price = "";
                        let error_servings = "";
                        let error_menu_picture = "";
                        for (const listKey in error1){
                            if(listKey == "branch_id"){
                                error_branch_id = ""+error1[listKey]+"";
                            }else if(listKey == "cat_id"){
                                error_cat_id = ""+error1[listKey]+"";
                            }else if(listKey == "menu_code"){
                                error_menu_code = ""+error1[listKey]+"";
                            }else if(listKey == "menu_name"){
                                error_menu_name = ""+error1[listKey]+"";
                            }else if(listKey == "price"){
                                error_price = ""+error1[listKey]+"";
                            }else if(listKey == "servings"){
                                error_servings = ""+error1[listKey]+"";
                            }else if(listKey == "menu_picture"){
                                error_menu_picture = ""+error1[listKey]+"";
                            }
                        }
                        let msg_branch_id = "<text>"+error_branch_id+"</text>";
                        let msg_cat_id = "<text>"+error_cat_id+"</text>";
                        let msg_menu_code = "<text>"+error_menu_code+"</text>";
                        let msg_menu_name = "<text>"+error_menu_name+"</text>";
                        let msg_price = "<text>"+error_price+"</text>";
                        let msg_servings = "<text>"+error_servings+"</text>";
                        let msg_menu_picture = "<text>"+error_menu_picture+"</text>";
                        $("#add-modal .errorMsg_branch_id").html(msg_branch_id).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_cat_id").html(msg_cat_id).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_menu_code").html(msg_menu_code).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_menu_name").html(msg_menu_name).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_price").html(msg_price).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_servings").html(msg_servings).addClass('text-red-500').fadeIn(1000);
                        $("#add-modal .errorMsg_menu_picture").html(msg_menu_picture).addClass('text-red-500').fadeIn(1000);
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
                    url: "{{ url('/api/menu/update') }}",
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
                        let error_cat_id = "";
                        let error_menu_code = "";
                        let error_menu_name = "";
                        let error_price = "";
                        let error_servings = "";
                        let error_menu_picture = "";
                        for (const listKey in error1){
                            if(listKey == "edit-branch_id"){
                                error_branch_id = ""+error1[listKey]+"";
                            }else if(listKey == "edit-cat_id"){
                                error_cat_id = ""+error1[listKey]+"";
                            }else if(listKey == "edit-menu_code"){
                                error_menu_code = ""+error1[listKey]+"";
                            }else if(listKey == "edit-menu_name"){
                                error_menu_name = ""+error1[listKey]+"";
                            }else if(listKey == "edit-price"){
                                error_price = ""+error1[listKey]+"";
                            }else if(listKey == "edit-servings"){
                                error_servings = ""+error1[listKey]+"";
                            }else if(listKey == "edit-menu_picture"){
                                error_menu_picture = ""+error1[listKey]+"";
                            }
                        }
                        let msg_branch_id = "<text>"+error_branch_id+"</text>";
                        let msg_cat_id = "<text>"+error_cat_id+"</text>";
                        let msg_menu_code = "<text>"+error_menu_code+"</text>";
                        let msg_menu_name = "<text>"+error_menu_name+"</text>";
                        let msg_price = "<text>"+error_price+"</text>";
                        let msg_servings = "<text>"+error_servings+"</text>";
                        let msg_menu_picture = "<text>"+error_menu_picture+"</text>";
                        $("#edit-modal .errorMsg_branch_id").html(msg_branch_id).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_cat_id").html(msg_cat_id).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_menu_code").html(msg_menu_code).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_menu_name").html(msg_menu_name).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_price").html(msg_price).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_servings").html(msg_servings).addClass('text-red-500').fadeIn(1000);
                        $("#edit-modal .errorMsg_menu_picture").html(msg_menu_picture).addClass('text-red-500').fadeIn(1000);
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
            }else if(type == 'category-form'){
                $('#category-modal').hide();
            }else if(type == 'category-confirm'){
                $('#category-confirm-modal').hide();
            }else if(type == 'form-ingredients'){
                $('#ingredients-modal').hide();
            }else if(type == 'ing-form'){
                $('#ing-modal').hide();
            }
        }

        // Onclick Add Function
        function Add(){
            $('#view-modal').hide();
            document.getElementById("add-modal-title").innerHTML= "Create Menu Information";
            document.getElementById("uploadedAvatar").src = "{{ asset('storage/default2.png') }}";
            document.getElementById("add-modal-submit").innerHTML= "Create";
            // Clear Input Fields
            $('#id').val('-1'),
            $('#branch_id').val(''),
            $('#cat_id').val(''),
            $('#menu_code').val(''),
            $('#menu_name').val(''),
            $('#price').val(''),
            $('#servings').val(''),
            $('#menu_picture').val(''),
            // Clear Error Messages
            $("#add-modal .errorMsg_branch_id").html('');
            $("#add-modal .errorMsg_cat_id").html('');
            $("#add-modal .errorMsg_menu_code").html('');
            $("#add-modal .errorMsg_menu_name").html('');
            $("#add-modal .errorMsg_price").html('');
            $("#add-modal .errorMsg_servings").html('');
            $("#add-modal .errorMsg_menu_picture").html('');
            // Show Modal
            $('#add-modal').show();
        }

        // Onclick Edit Function
        function Edit(id) {
            $('#view-modal').hide();
            document.getElementById("edit-modal-title").innerHTML= "Edit Menu Information";
            document.getElementById("edit-modal-submit").innerHTML= "Save";
            // Show Values in Modal
            Controller.Post('/api/menu/items', { 'id': id }).done(function(result) {
                // Clear Error Messages
                $("#edit-modal .errorMsg_branch_id").html('');
                $("#edit-modal .errorMsg_category_id").html('');
                $("#edit-modal .errorMsg_menu_code").html('');
                $("#edit-modal .errorMsg_menu_name").html('');
                $("#edit-modal .errorMsg_price").html('');
                $("#edit-modal .errorMsg_servings").html('');
                $("#edit-modal .errorMsg_status").html('');
                $("#edit-modal .errorMsg_photo_picture").html('');
                // Show ID values in Input Fields
                $('#edit-id').val(result.id),
                $('#edit-branch_id').val(result.branch_id),
                $('#edit-cat_id').val(result.category_id),
                $('#edit-menu_code').val(result.menu_code),
                $('#edit-menu_name').val(result.menu_name),
                $('#edit-price').val(result.price),
                $('#edit-servings').val(result.servings),
                $('#edit-status').val(result.status),
                $('#edit-photo_picture').val(result.photo_picture),
                // Show Modal
                $('#edit-modal').show();
            });
        }

        // Onclick View Function
        function View(id) {
            $('#view-modal-footer').html('');
            document.getElementById("view-modal-title").innerHTML= "View Menu Information";
            // Show Values in Modal
            Controller.Post('/api/menu/items', { 'id': id }).done(function(result) {
                if(result.photo_path==null){
                    var edit1 = "document.getElementById('edit-uploadedAvatar').src='{{ asset('storage/default2.png') }}'"
                    $('#view-modal-footer').append('<button type="button" onclick="Edit('+result.id+','+edit1+')" class=" text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Edit</button>');  
                }else{
                    var str = result.photo_path;
                    var str1 = str.replace('public/','')
                    var str2 = "document.getElementById('edit-uploadedAvatar').src='{{ asset('../storage/rep') }}'"
                    var edit2 = str2.replace('rep',''+str1+'')
                    $('#view-modal-footer').append('<button type="button" onclick="Edit('+result.id+','+edit2+')" class=" text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Edit</button>');  
                }

                // Show ID values in Input Fields
                $('#view-id').val(result.id),
                $('#view-branch_id').val(result.branch.branch_name),
                $('#view-category_id').val(result.category.category_name),
                $('#view-menu_code').val(result.menu_code),
                $('#view-menu_name').val(result.menu_name),
                $('#view-price').val(result.price),
                $('#view-servings').val(result.servings),
                $('#view-status').val(result.status),
                $('#view-menu_picture').val(result.menu_picture),
                // Show Modal
                $('#view-modal').show();
            });
        }

        // Onclick Add Function
        function AddCategory(){
            document.getElementById("category-title").innerHTML= "Create Category Information";
            document.getElementById("category-submit").innerHTML= "Create";
            // Clear Input Fields
            $('#category_id').val('-1'),
            $('#category_name').val(''),
            // Clear Error Messages
            $("#category-modal .errorMsg_category_name").html('');
            // Show Modal
            $('#category-modal').show();
        }

        // Onclick Edit Function
        function EditCategory(id) {
            document.getElementById("category-title").innerHTML= "Edit Category Information";
            document.getElementById("category-submit").innerHTML= "Save";
            // Show Values in Modal
            Controller.Post('/api/category/items', { 'id': id }).done(function(result) {
                // Clear Error Messages
                $("#category-modal .errorMsg_category_name").html('');
                // Show ID values in Input Fields
                $('#category_id').val(result.id),
                $('#category_name').val(result.category_name),
                // Show Modal
                $('#category-modal').show();
            });
        }

        // Onclick Save Function
        function SaveCategory() {
            // Get Values from input fields
            var data = {
                id: $('#category_id').val(),
                category_name: $('#category_name').val(),
            }
            // Add Data to Database
            if(data.id == -1) {
                Controller.Post('/api/category/create', data)
                // If success, return message
                .done(function(result) {
                    $('#category-modal').hide();
                    document.getElementById("success-label").innerHTML= "Successfully added to the database.";
                    $('#success-modal').fadeIn().delay(5000).fadeOut();
                    window.location.reload();
                })
                //If fail, show errors
                .fail(function (error) {
                    const error1 = error.responseJSON.errors;
                    let error_category_name = "";
                    for (const listKey in error1){
                        if(listKey == "category_name"){
                            error_category_name = ""+error1[listKey]+"";
                        }
                    }
                    let msg_category_name = "<text>"+error_category_name+"</text>";
                    $("#category-modal .errorMsg_category_name").html(msg_category_name).addClass('text-red-500').fadeIn(1000);
                    $("#category-modal button").attr('disabled',false);
                })
            }
            // // Update Data to Database
            else if(data.id > 0) {
                Controller.Post('/api/category/update', data)
                // If success, return message
                .done(function(result) {
                    $('#category-modal').hide();
                    document.getElementById("success-label").innerHTML= "Successfully updated to the database.";
                    $('#success-modal').fadeIn().delay(5000).fadeOut();
                    window.location.reload();
                })
                //If fail, show errors
                .fail(function (error) {
                    const error1 = error.responseJSON.errors;
                    let error_category_name = "";
                    for (const listKey in error1){
                        if(listKey == "category_name"){
                            error_category_name = ""+error1[listKey]+"";
                        }
                    }
                    let msg_category_name = "<text>"+error_category_name+"</text>";
                    $("#category-modal .errorMsg_category_name").html(msg_category_name).addClass('text-red-500').fadeIn(1000);
                    $("#category-modal button").attr('disabled',false);
                })    
            }
        }

        // Onclick Ingredient Function
        function Ingredients(id,branch_id) {
            $('#inv_list').html('');
            $('#br_id').val(branch_id);
            $('#mn_id').val(id);
            document.getElementById("ingredients-modal-title").innerHTML= "Menu Ingredients";
            // Show Modal
            Controller.Post('/api/ingredients/list', { 'menu_id': id }).done(function(result) {
                if(result.length == 0){
                    $('#inv_list').html('Menu Ingredients list is empty.');
                }else{
                    $.each(result, function (key, value) {                
                        $('#inv_list').append('<div><label for="inventory_id'+value.id+'" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label><input disabled value="'+value.inventory.product_name+'" name="inventory_id'+value.id+'" id="inventory_id'+value.id+'" class="focus:outline-none bg-emerald-50 border border-emerald-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"><div class="pt-1 text-sm"><span class="errorMsg_inventory_id'+value.id+'"></span></div></div>');
                        $('#inv_list').append('<div><label for="quantity'+value.id+'" class="col-span-1 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label><input disabled value="'+value.quantity+' '+value.inventory.measurement+'" name="quantity'+value.id+'" id="quantity'+value.id+'" class="focus:outline-none bg-emerald-50 border border-emerald-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Ex. 10" ><div class="pt-1 text-sm"><span class="errorMsg_quantity'+value.id+'"></span></div></div>');
                    });
                }
            })
            Controller.Post('/api/inventory/list', { 'branch_id': branch_id }).done(function(res) {
                $.each(res, function (key, val) {  
                    $('[id^="inventory_id"]').append('<option value="'+val.id+'">'+val.product_name+'</option>');
                } )
                $('#ingredients-modal').show();
            })
            
        }
        
        // Onclick Add Function
        function AddIngredients(){
            dropdown.prop('disabled', true);
            dropdown2.prop('disabled', true);
            document.getElementById("ing-title").innerHTML= "Create Menu Ingredients Information";
            document.getElementById("ing-submit").innerHTML= "Create";
            // Clear Input Fields
            $('#ingredients_id').val('-1'),
            $('#br_id').val(''),
            $('#inv_id').val(''),
            $('#mn_id').val(''),
            $('#qty').val(''),
            // Clear Error Messages
            $("#ing-modal .errorMsg_br_id").html('');
            $("#ing-modal .errorMsg_inv_id").html('');
            $("#ing-modal .errorMsg_mn_id").html('');
            $("#ing-modal .errorMsg_qty").html('');
            // Show Modal
            $('#ing-modal').show();
        }

        // Onclick Edit Function
        function EditIngredients(id) {
            dropdown.prop('disabled', true);
            dropdown2.prop('disabled', true);
            document.getElementById("ing-title").innerHTML= "Edit Menu Ingredients Information";
            document.getElementById("ing-submit").innerHTML= "Save";
            // Show Values in Modal
            Controller.Post('/api/ingredients/items', { 'id': id }).done(function(res) {
                // Clear Error Messages
                $("#ing-modal .errorMsg_br_id").html('');
                $("#ing-modal .errorMsg_inv_id").html('');
                $("#ing-modal .errorMsg_mn_id").html('');
                $("#ing-modal .errorMsg_qty").html('');
                // Show ID values in Input Fields
                $('#ingredients_id').val(res.id);
                $('#br_id').val(res.menu.branch_id);
                $('#inv_id').val(res.inventory_id);
                $('#mn_id').val(res.menu_id);
                $('#qty').val(res.quantity);
                // Show Modal
                $('#ing-modal').show();
            });
        }

        // Onclick Save Function
        function SaveIngredients() {
            // Get Values from input fields
            var data = {
                id: $('#ingredients_id').val(),
                branch_id: $('#br_id').val(),
                menu_id: $('#mn_id').val(),
                inventory_id: $('#inv_id').val(),
                quantity: $('#qty').val(),
            }
            // Add Data to Database
            if(data.id == -1) {
                Controller.Post('/api/ingredients/create', data)
                // If success, return message
                .done(function(result) {
                    $('#ing-modal').hide();
                    document.getElementById("success-label").innerHTML= "Successfully added to the database.";
                    $('#success-modal').fadeIn().delay(5000).fadeOut();
                    window.location.reload();
                })
                //If fail, show errors
                .fail(function (error) {
                    const error1 = error.responseJSON.errors;
                    let error_br_id = "";
                    let error_mn_id = "";
                    let error_inv_id = "";
                    let error_qty = "";
                    for (const listKey in error1){
                        if(listKey == "branch_id"){
                            error_br_id = ""+error1[listKey]+"";
                        }else if(listKey == "menu_id"){
                            error_mn_id = ""+error1[listKey]+"";
                        }else if(listKey == "inventory_id"){
                            error_inv_id = ""+error1[listKey]+"";
                        }else if(listKey == "quantity"){
                            error_qty = ""+error1[listKey]+"";
                        }
                    }
                    let msg_br_id = "<text>"+error_br_id+"</text>";
                    let msg_mn_id = "<text>"+error_mn_id+"</text>";
                    let msg_inv_id = "<text>"+error_inv_id+"</text>";
                    let msg_qty = "<text>"+error_qty+"</text>";
                    $("#ing-modal .errorMsg_br_id").html(msg_br_id).addClass('text-red-500').fadeIn(1000);
                    $("#ing-modal .errorMsg_mn_id").html(msg_mn_id).addClass('text-red-500').fadeIn(1000);
                    $("#ing-modal .errorMsg_inv_id").html(msg_inv_id).addClass('text-red-500').fadeIn(1000);
                    $("#ing-modal .errorMsg_qty").html(msg_qty).addClass('text-red-500').fadeIn(1000);
                    $("#ing-modal button").attr('disabled',false);
                })
            }
            // Update Data to Database
            else if(data.id > 0) {
                Controller.Post('/api/ingredients/update', data)
                // If success, return message
                .done(function(result) {
                    $('#ing-modal').hide();
                    document.getElementById("success-label").innerHTML= "Successfully updated to the database.";
                    $('#success-modal').fadeIn().delay(5000).fadeOut();
                    window.location.reload();
                })
                //If fail, show errors
                .fail(function (error) {
                    const error1 = error.responseJSON.errors;
                    let error_br_id = "";
                    let error_mn_id = "";
                    let error_inv_id = "";
                    let error_qty = "";
                    for (const listKey in error1){
                        if(listKey == "branch_id"){
                            error_br_id = ""+error1[listKey]+"";
                        }else if(listKey == "menu_id"){
                            error_mn_id = ""+error1[listKey]+"";
                        }else if(listKey == "inventory_id"){
                            error_inv_id = ""+error1[listKey]+"";
                        }else if(listKey == "quantity"){
                            error_qty = ""+error1[listKey]+"";
                        }
                    }
                    let msg_br_id = "<text>"+error_br_id+"</text>";
                    let msg_mn_id = "<text>"+error_mn_id+"</text>";
                    let msg_inv_id = "<text>"+error_inv_id+"</text>";
                    let msg_qty = "<text>"+error_qty+"</text>";
                    $("#ing-modal .errorMsg_br_id").html(msg_br_id).addClass('text-red-500').fadeIn(1000);
                    $("#ing-modal .errorMsg_mn_id").html(msg_mn_id).addClass('text-red-500').fadeIn(1000);
                    $("#ing-modal .errorMsg_inv_id").html(msg_inv_id).addClass('text-red-500').fadeIn(1000);
                    $("#ing-modal .errorMsg_qty").html(msg_qty).addClass('text-red-500').fadeIn(1000);
                    $("#ing-modal button").attr('disabled',false);
                })   
            }
        }

    </script>
@endsection