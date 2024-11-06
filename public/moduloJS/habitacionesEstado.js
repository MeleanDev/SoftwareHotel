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
        data: 'tipo',
        name: 'tipo',
        className: 'text-center'
    },
    {
        data: 'disponibilidad',
        name: 'disponibilidad',
        className: 'text-center',
        render: function(data, type, row) {
            if (row.disponibilidad == 'disponible') {
                return '<span class="badge badge-success">Disponible</span>';
            } else {
                return '<span class="badge badge-danger">Ocupada</span>';
            }
        }
    },
    ],
    columnDefs: [{
        orderable: false,
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