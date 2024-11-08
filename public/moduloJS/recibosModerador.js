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
            if (row.estado === 'En Proceso') {
                return '<span class="badge badge-warning">En Proceso</span>';
            } else if (row.estado == 'Activa') {
                return '<span class="badge badge-success">Activa</span>';
            } else if (row.estado == 'Completada') {
                return '<span class="badge badge-info">Completada</span>';
            }
            else {
                return '<span class="badge badge-danger">Cancelada</span>';
            }
        }
    },
    {
        data: 'fecha_entrada',
        name: 'fecha_entrada',
        className: 'text-center'
    },
    {
        data: 'fecha_salida',
        name: 'fecha_salida',
        className: 'text-center'
    },
    {
        data: 'habitacione.identificador',
        name: 'habitacione.identificador',
        className: 'text-center'
    },
    {
        data: 'habitacione.tipo',
        name: 'habitacione.tipo',
        className: 'text-center'
    },
    {
        data: 'user.identificacion',
        name: 'user.identificacion',
        className: 'text-center'
    },
    {
        "data": null,
        "width": "100px",
        "className": "text-center",
        "render": function (row) {
            if (row.estado === 'En Proceso') {
                return `
                        <div class="dropdown dropleft">
                            <button class="btn btn-link text-secondary mb-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:editar(${row.id});"><i class="fa fa-edit text-warning"></i> Editar</a>
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:cancelar(${row.id});"><i class="fa fa-trash text-danger"></i> Cancelar</a>
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:activar(${row.id});"><i class="fa fa-trash text-success"></i> Activar</a>
                            </div>
                        </div>`
            } else if (row.estado === 'Activa') {
                return `
                        <div class="dropdown dropleft">
                            <button class="btn btn-link text-secondary mb-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:completar(${row.id});"><i class="fa fa-trash text-info"></i> Completada</a>
                            </div>
                        </div>`
            } else if (row.estado === 'Completada') {
                return `<span class="badge badge-info">Completada</span>`
            } if (row.estado === 'Cancelada') {
                return `<span class="badge badge-danger">Cancelada</span>`
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

// activar = function (id) {
//     Swal.fire({
//         title: '¿ Estas seguro que desea Activar la reserva #' + id + ' ?',
//         text: "¡ No podrás revertir esto !",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: '¡ Sí, Activar !',
//     }).then((result) => {
//         if (result.isConfirmed) {
//             $.ajax({
//                 url: urlCompleta + '/Activar/' + id,
//                 method: "GET",
//                 headers: {
//                     'X-CSRF-TOKEN': token
//                 },
//                 success: function (data) {
//                     if (data.success) {
//                         table.ajax.reload(null, false);
//                         notificacion.fire({
//                             icon: "success",
//                             title: "¡ Activada !",
//                             text: "Tu reserva ha sido Activada."
//                         });
//                     } else {
//                         notificacion.fire({
//                             icon: "error",
//                             title: "¡ Error !",
//                             text: "Tu reserva no ha sido Activada."
//                         });
//                     }
//                 },
//                 error: function (xhr, status, error) {
//                     Swal.fire({
//                         title: "Error en el sistema",
//                         text: "El registro no fue agregado al sistema!!",
//                         icon: "error"
//                     });
//                 }
//             });
//         }
//     });
// };