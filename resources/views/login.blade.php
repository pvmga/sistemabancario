@extends('layouts.login_register_layout')
@section('content')
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-sm text-center">
        <h1 class="text-2xl font-bold mb-6">MiniBank</h1>
        <input type="email" placeholder="Email" class="w-full mb-4 p-2 border rounded" />
        <input type="password" placeholder="Senha" class="w-full mb-6 p-2 border rounded" />
        <a href="/dashboard">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">Entrar</button>
        </a>
        <p class="text-sm text-gray-600 mt-4">
            Ainda não tem conta? <a href="/register" class="text-blue-500 hover:underline">Cadastre-se</a>
        </p>
    </div>
@endsection
