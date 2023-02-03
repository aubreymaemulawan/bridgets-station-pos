@extends('layouts.app')
@section('title','Login')

@section('login_content')
    <div class="bg-emerald-600 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-emerald-400 bottom-0 leading-5 h-full w-full overflow-hidden"></div>
        <div class="relative  min-h-screen  sm:flex sm:flex-row  justify-center bg-transparent rounded-3xl shadow-xl">
            <!-- Logo -->
            <div class="flex-col flex  self-center lg:px-14 sm:max-w-4xl xl:max-w-md  z-10">
                <div class="self-start hidden lg:flex flex-col  text-gray-300">
                    <img src="{{ asset('dist/images/logo_bridget_station.png') }}"></img>
                </div>
            </div>
            <div class="flex justify-center self-center  z-10">
                <div class="p-12 bg-white mx-auto rounded-3xl w-96 ">
                    <div class="mb-7">
                        <h3 class="font-semibold text-2xl text-gray-800">Sign In </h3>
                    </div>
                    <form id="formAuthentication" class="mb-3 needs-validation" action="{{ route('login') }}" method="POST">
                    @csrf
                        <div class="space-y-6">
                            <!-- Email Input -->
                            <div class="">
                                <input class="form-control form-control-user @error('email') is-invalid @enderror w-full text-sm  px-4 py-3 bg-gray-200 focus:bg-gray-100 border  border-gray-200 rounded-lg focus:outline-none focus:border-emerald-400" 
                                    id="email" 
                                    type="text" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required autocomplete="email" 
                                    autofocusaria-describedby="emailHelp"
                                    placeholder="Email"
                                    autofocus >
                                @error('email')
                                    <span class="text-sm text-red-600 font-light" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Password Input -->
                            <div class="relative" x-data="{ show: true }">
                                <input class="form-control form-control-user @error('password') is-invalid @enderror text-sm text-black px-4 py-3 rounded-lg w-full bg-gray-200 focus:bg-gray-100 border border-gray-200 focus:outline-none focus:border-emerald-400"
                                    placeholder="Password" 
                                    :type="show ? 'password' : 'text'" 
                                    id="password" 
                                    name="password" 
                                    required autocomplete="current-password"
                                    aria-describedby="password" >
                                @error('password')
                                    <span class="text-sm text-red-600 font-light" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Forgot Password Input -->
                            <div class="flex items-center justify-between">
                                <div class="text-sm ml-auto">
                                    <a href="#" class="text-blue-900 hover:text-blue-800">
                                        Forgot your password? Contact your administrator.
                                    </a>
                                </div>
                            </div>
                            <!-- Sign in Submit Button -->
                            <div>
                                <button type="submit" class="w-full flex justify-center bg-emerald-500  hover:bg-emerald-400 text-gray-100 p-3  rounded-lg tracking-wide font-semibold  cursor-pointer transition ease-in duration-500">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <svg class="absolute bottom-0 left-0 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,0L40,42.7C80,85,160,171,240,197.3C320,224,400,192,480,154.7C560,117,640,75,720,74.7C800,75,880,117,960,154.7C1040,192,1120,224,1200,213.3C1280,203,1360,149,1400,122.7L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
@endsection