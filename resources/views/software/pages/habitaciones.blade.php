@extends('software.layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Habitaciones')
@section('content_header_title', 'Habitaciones')
@section('content_header_subtitle', 'Registros')

{{-- plugins --}}
{{-- Datatable --}}
@section('plugins.Datatables', true)
{{-- Sweetalert2 --}}
@section('plugins.Sweetalert2', true)

{{-- Content body: main page content --}}

@section('content_body')
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="crear()">
            Agregar Habitacion
        </button>
    </div>
    <div class="container mt-4">
        <table class="table table-striped table-hover display responsive nowrap" cellspacing="0" id="datatable"
            style="width: 100%">
            <thead class="bg-info">
                <tr>
                    <th data-priority="1">Identifiacador</th>
                    <th data-priority="2">Disponibilidad</th>
                    <th>Piso</th>
                    <th>Tipo</th>
                    <th>Cant. Max</th>
                    <th>precio</th>
                    <th>Sede</th>
                    <th class="text-center">Accion</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
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
                        <div class="form-group">
                            <label for="identificador">Identificador</label>
                            <input type="text" required minlength="1" maxlength="5" class="form-control"
                                id="identificador" placeholder="HS-3F">
                        </div>
                        <div class="form-group">
                            <label for="sede_id">Sede a asignar</label>
                            <input type="hidden" class="form-control" id="sede_idVer" readonly>
                            <select id="sede_id" required class="form-control">
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="piso">Piso</label>
                                <input type="number" required min="1" max="100" class="form-control"
                                    id="piso">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tipo">Tipo</label>
                                <input type="hidden" class="form-control" id="tipoVer" readonly>
                                <select id="tipo" class="form-control">
                                    <option selected value="Individual">Individual</option>
                                    <option value="Familiar">Familiar</option>
                                    <option value="Vip">Vip</option>
                                    <option value="Presidencial">Presidencial</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="numPersonas">Cantidad Max de personas</label>
                                <input type="number" required min="1" max="999" class="form-control"
                                    id="numPersonas">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="precio">Precio</label>
                                <input type="number" required class="form-control" id="precio" step="0.01"
                                    min="0.01">
                            </div>
                        </div>
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
    <script src="{{ asset('moduloJS/habitaciones.js') }}"></script>
@endpush
