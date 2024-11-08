@extends('software.layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Recibos')
@section('content_header_title', 'Recibos')
@section('content_header_subtitle', 'Registros')

{{-- plugins --}}
{{-- Datatable --}}
@section('plugins.Datatables', true)
{{-- Sweetalert2 --}}
@section('plugins.Sweetalert2', true)

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container mt-4">
        @role('Administrador')
            <table class="table table-striped table-hover display responsive nowrap" cellspacing="0" id="datatable"
                style="width: 100%">
                <thead class="bg-info">
                    <tr>
                        <th data-priority="1">Identifiacador</th>
                        <th data-priority="2">Estado</th>
                        <th>Fecha Entrada</th>
                        <th>Fecha Salida</th>
                        <th>Habitacion</th>
                        <th>Tip. Habitacion</th>
                        <th>Huesped</th>
                        <th class="text-center">Accion</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        @endrole
        @role('Moderador')
            <table class="table table-striped table-hover display responsive nowrap" cellspacing="0" id="datatable"
                style="width: 100%">
                <thead class="bg-info">
                    <tr>
                        <th data-priority="1">Identifiacador</th>
                        <th data-priority="2">Estado</th>
                        <th>Fecha Entrada</th>
                        <th>Fecha Salida</th>
                        <th>Habitacion</th>
                        <th>Huesped</th>
                        <th class="text-center">Accion</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        @endrole
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
    <script src="{{ asset('moduloJS/recibos.js') }}"></script>
@endpush
