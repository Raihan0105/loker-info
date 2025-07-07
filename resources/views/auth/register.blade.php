@extends('layouts.app')

@section('title', 'Register Akun Baru')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Buat Akun Baru
            </h2>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                <p class="font-bold">Terjadi Kesalahan:</p>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="sr-only">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" autofocus
                       class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Nama Lengkap">
            </div>

            <div class="mb-4">
                <label for="email" class="sr-only">Alamat Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                       class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Alamat Email">
            </div>

            <div class="mb-4">
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" required autocomplete="new-password"
                       class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Password">
            </div>

            <div>
                <label for="password-confirm" class="sr-only">Konfirmasi Password</label>
                <input id="password-confirm" name="password_confirmation" type="password" required autocomplete="new-password"
                       class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Konfirmasi Password">
            </div>

            <div>
                <button type="submit" class="group mt-6 relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Register
                </button>
            </div>
             <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
                    Sudah punya akun? Login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection