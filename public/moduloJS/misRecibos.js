var token = $('meta[name="csrf-token"]').attr('content');
const urlCompleta = window.location.href;

var table = new DataTable('#datatable', {
    ajax: urlCompleta + '/Lista',
    responsive: true,
    processing: true,
    serverSide: true,
    lengthMenu: [
        [10, 25, 50],
        [10, 25, 50]
    ],
    columns: [{
        data: 'identificador',
        name: 'identificador',
        className: 'text-center'
    },
    {
        data: 'estado',
        name: 'estado',
        className: 'text-center',
        render: function (data, type, row) {
            if (row.estado === 'Realizada') {
                return '<span class="badge badge-success">Realizada</span>';
            } else if (row.estado == 'Anulado') {
                return '<span class="badge badge-danger">Anulada</span>';
            }
        }
    },
    {
        data: 'fecha_emision',
        name: 'fecha_emision',
        className: 'text-center'
    },
    {
        data: 'monto',
        name: 'monto',
        className: 'text-center'
    },
    {
        data: 'reserva_id',
        name: 'reserva_id',
        className: 'text-center'
    },
    {
        "data": null,
        "width": "100px",
        "className": "text-center",
        "render": function (row) {
            if (row.estado === 'Realizada') {
                return `
                        <div class="dropdown dropleft">
                            <button class="btn btn-link text-secondary mb-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-id="${row.id}" href="MisRecibos/Descargar/${row.id}" target="_blank"><i class="fa fa-trash text-success"></i> Descargar</a>
                            </div>
                        </div>`
            }else if (row.estado === 'Anulado') {
                return `<span class="badge badge-danger">Anulada</span>`
            }
        },
        "orderable": false
    },
    ],
    columnDefs: [{
        orderable: false,
        targets: [5],
        responsivePriority: 1,
        responsivePriority: 2,

    }],
    language: {
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "lengthMenu": "Mostrar _MENU_ registros",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "sProcessing": "Procesando...",
    },
});
