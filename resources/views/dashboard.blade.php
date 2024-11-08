@extends('software.layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Panel Principal')

{{-- Sweetalert2 --}}
@section('plugins.Sweetalert2', true)

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container">
        @role('Administrador')
            @include('software.componet.adminView').
        @endrole
        @role('Moderador')
            @include('software.componet.moderadorView').
        @endrole
        @role('Huesped')
            @include('software.componet.huespedView').
        @endrole
        <div class="Bienvenida">
            <div class="col-lg-10 mb-4 order-0 mx-auto">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-black">Bienvenido {{auth()->user()->name}} {{auth()->user()->apellido}}, eres un {{auth()->user()->tipo}}!! 😎🎉</h5>
                                <p class="mb-2">
                                    <br>Al sistema de administracion de reservas del Hotel. <br><br>
                                </p>
                        
                                <a href="#" target="_blank" class="btn btn-sm btn-primary">Contactar con los 
                                    @role('Administrador') Desarrolladores @endrole
                                    @role('Moderador') Administradores @endrole
                                    @role('Huesped') Administradores @endrole
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                src="{{ asset("img/panelcard.png") }}"
                                height="140"
                                alt="img del sistema"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('css')
@endpush

@push('js')
@endpush
