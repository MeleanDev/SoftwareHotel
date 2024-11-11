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
        data: 'reserva.identificador',
        name: 'reserva.identificador',
        className: 'text-center'
    },
    {
        data: 'user',
        name: 'user',
        className: 'text-center'
    },
    {
        data: 'sede',
        name: 'sede',
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
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:anular(${row.id});"><i class="fa fa-trash text-danger"></i> Anular</a>
                                <a class="dropdown-item" data-id="${row.id}" href="Recibos/Descargar/${row.id}" target="_blank"><i class="fa fa-trash text-success"></i> Descargar</a>
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
        targets: [7],
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

anular = function (id) {
    Swal.fire({
        title: '¿ Estas seguro que desea Anular El recibo #' + id + ' ?',
        text: "¡ No podrás revertir esto !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡ Sí, Anular !',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: urlCompleta + '/Anular/' + id,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function (data) {
                    if (data.success) {
                        table.ajax.reload(null, false);
                        notificacion.fire({
                            icon: "success",
                            title: "¡ Anulado !",
                            text: "Tu Recibo ha sido Anulado."
                        });
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "¡ Error !",
                            text: "Tu reserva no ha sido Anulado."
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "Error en el sistema",
                        text: "El registro no fue agregado al sistema!!",
                        icon: "error"
                    });
                }
            });
        }
    });
};