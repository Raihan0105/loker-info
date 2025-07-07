@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-gray-800 p-10 rounded-xl shadow-lg">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                Admin Area Login
            </h2>
        </div>
        @if ($errors->any())
            <div class="bg-red-500/20 border border-red-500 text-red-300 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ $errors->first('email') }}</span>
            </div>
        @endif
        <form class="mt-8 space-y-6" action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-700 bg-gray-900 text-white placeholder-gray-500 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-700 bg-gray-900 text-white placeholder-gray-500 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                </div>
            </div>
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
