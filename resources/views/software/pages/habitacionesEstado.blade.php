@extends('software.layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Habitaciones Estado')
@section('content_header_title', 'Habitaciones')
@section('content_header_subtitle', 'Estado')

{{-- plugins --}}
{{-- Datatable --}}
@section('plugins.Datatables', true)

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container mb-3 mt-4">
        <table class="table table-striped table-hover display responsive nowrap" cellspacing="0" id="datatable"
            style="width: 100%">
            <thead class="bg-info">
                <tr>
                    <th data-priority="1">Identifiacador</th>
                    <th>Tipo</th>
                    <th data-priority="2">Disponibilidad</th>
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
    <script src="{{ asset('moduloJS/habitacionesEstado.js') }}"></script>
@endpush
