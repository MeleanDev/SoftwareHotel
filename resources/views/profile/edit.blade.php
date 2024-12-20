@extends('adminlte::page')

@section('title', 'Editar Perfil')

@section('content_header')
    <h1 class="text-center" style="font-family: Bold">
        Perfil
    </h1>
@stop

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        @role('Huesped')
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        @endrole
    </div>
@stop

@section('css')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@stop
