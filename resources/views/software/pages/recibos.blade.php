@extends('software.layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Reservas')
@section('content_header_title', 'Reservas')
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

    <!-- Modal -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="empleado" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="min-width: 600px">
            <div class="modal-content">
                <form id="formulario" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header" id="bg-titulo">
                        <h5 class="modal-title" id="titulo"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" id="submit" class="btn btn-primary"><i class="fas fa-lg fa-save"></i>
                            Guarda</button>
                    </div>
                </form>
            </div>
        </div>
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
