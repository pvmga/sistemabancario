@extends('layouts.login_register_layout')
@section('content')
    <form action="{{ route('loginSubmit') }}" method="post" novalidate>
        @csrf
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-sm text-center">
            <h1 class="text-2xl font-bold mb-6">MiniBank</h1>

            <input type="email" placeholder="Email" name="text_email" class="w-full mb-4 p-2 border rounded" value="{{ old('text_email') }}" />
            @error('text_email')
                <div class="text-red-500 text-sm mt-1 text-left">{{ $message }}</div>
            @enderror
            <input type="password" placeholder="Senha" name="text_password" class="w-full mb-6 p-2 border rounded" value="{{ old('text_password') }}" />
            @error('text_password')
                <div class="text-red-500 text-sm mt-0.1 text-left">{{ $message }}</div>
            @enderror

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full mt-5">Entrar</button>
            
            <p class="text-sm text-gray-600 mt-4">
                Ainda não tem conta? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Cadastre-se</a>
            </p>
            {{-- invalid login --}}
            @if(session('loginError'))
                <div class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full mt-5">{{ session('loginError') }}</div>
            @endif
        </div>
    </form>
@endsection
