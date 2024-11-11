@extends('software.layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Recibos')
@section('content_header_title', 'Mis Recibos')
@section('content_header_subtitle', 'Registros')

{{-- plugins --}}
{{-- Datatable --}}
@section('plugins.Datatables', true)
{{-- Sweetalert2 --}}
@section('plugins.Sweetalert2', true)

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container mt-4">
        <table class="table table-striped table-hover display responsive nowrap" cellspacing="0" id="datatable"
            style="width: 100%">
            <thead class="bg-info">
                <tr>
                    <th data-priority="1">Identifiacador</th>
                    <th data-priority="2">Estado</th>
                    <th>Fecha Emision</th>
                    <th>Monto</th>
                    <th>ID reserva</th>
                    <th class="text-center">Accion</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@stop

@push('css')
    <style>
        .dropdown-menu.show {
            display: inline-table;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('moduloJS/misRecibos.js') }}"></script>
@endpush
