var token = $('meta[name="csrf-token"]').attr('content');
var opcion;
const urlCompleta = window.location.href;
const selectHabitacion = $("#habitacione_id");
const selectHuesped = $("#huesped_id");

$(document).ready(function () {

    // habitaciones
    $.ajax({
        url: urlCompleta + "/Lista/Habitaciones",
        type: 'GET',
        dataType: "json",
        success: function (data) {
            data.forEach(function (item) {
                const optionHabitacion = new Option(item.habitacionText, item.habitacionId);
                selectHabitacion.append(optionHabitacion);
            });
        }
    });

});

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
                            </div>
                        </div>`
                    } else if(row.estado === 'Activa'){ 
                        return `
                        <span class="badge badge-success">Activa</span>`
                    }else if(row.estado === 'Completada'){ 
                        return `<span class="badge badge-info">Completada</span>`
                    }if(row.estado === 'Cancelada'){ 
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

// Consulta Registro
consulta = function (id) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: urlCompleta + "/" + id,
            method: "GET",
            success: function (Data) {
                resolve(Data);
            },
            error: function (error) {
                reject(error);
            }
        });
    });
};

// Enviar datos
$('#formulario').submit(function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append('identificador', $.trim($('#identificador').val()));
    formData.append('fecha_entrada', $.trim($('#fecha_entrada').val()));
    formData.append('fecha_salida', $.trim($('#fecha_salida').val()));
    formData.append('habitacione_id', $.trim($('#habitacione_id').val()));

    $.ajax({
        url: rutaAccion,
        method: 'POST',
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false,
        cache: false,
        headers: {
            'X-CSRF-TOKEN': token
        },
        success: function (data) {
            if (data.success) {
                table.ajax.reload(null, false);
                if (accion === 1) {
                    notificacion.fire({
                        icon: "success",
                        title: "Informacion Guardada!!",
                        text: "Registro guardado con exito."
                    });
                } else {
                    notificacion.fire({
                        icon: "success",
                        title: "Informacion Editada!!",
                        text: "Registro Editado con exito."
                    });
                }
            } else {
                notificacion.fire({
                    icon: "error",
                    title: "Registro no cargado.",
                    text: "Recuerda que un Huesped no puede tener 2 reservaciones 'En Proceso' al mismo tiempo."
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: "Falla en el sistema",
                text: "El registro no fue agregado al sistema!!",
                icon: "error"
            });
        }
    });

    $('#modalCRUD').modal('hide');
});

// // Funciones de Botones
crear = function () {
    rutaAccion = urlCompleta;
    accion = 1;

    $('#fecha_salida').prop('disabled', true);

    $('#fecha_entrada').on('change', function () {
        $('#fecha_salida').prop('disabled', false);
    });

    const now = new Date().toISOString().slice(0, 16);
    $('#fecha_entrada').attr('min', now);
    $('#fecha_salida').attr('min', now);

    $('#fecha_salida').on('change', function () {
        // Obtener las fechas de entrada y salida
        var fechaEntrada = new Date($('#fecha_entrada').val());
        var fechaSalida = new Date($(this).val());

        // Crear una nueva fecha que sea un día después de la fecha de entrada
        var fechaEntradaMasUnDia = new Date(fechaEntrada);
        fechaEntradaMasUnDia.setDate(fechaEntradaMasUnDia.getDate() + 1);

        // Comparar las fechas
        if (fechaSalida < fechaEntradaMasUnDia) {
            alert('La fecha de salida debe ser al menos un día después de la fecha de entrada.');
            $(this).val('');
        }
    });

    // reinicial Formulario
    $("#formulario").trigger("reset");

    // Editar Modal
    $("#titulo").html("Agregar Reservacion");
    $("#titulo").attr("class", "modal-title text-white");
    $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");

    $("#identificador").attr("readonly", false);
    $("#piso").attr("readonly", false);
    $("#tipo").attr("readonly", false);
    $("#numPersonas").attr("readonly", false);
    $("#precio").attr("readonly", false);

    $('#sede_idVer').attr('type', 'hidden');
    $('#tipoVer').attr('type', 'hidden');
    $('#tipo').show();
    $('#sede_id').show();

    $('#submit').show()
    $('#modalCRUD').modal('show');
};



// editar = async function(id) {
//     rutaAccion = urlCompleta + '/Editar/' + id;
//     accion = 2;

//     try {
//         $("#formulario").trigger("reset");
//         datos = await consulta(id);
//         $("#titulo").html("Editar Habitacion -> " + datos.identificador);
//         $("#titulo").attr("class", "modal-title text-white");
//         $("#bg-titulo").attr("class", "modal-header bg-warning");

//         // asigancion de valores
//         $("#identificador").val(datos.identificador);
//         $("#identificador").attr("readonly", false);

//         $("#piso").val(datos.piso);
//         $("#piso").attr("readonly", false);

//         $("#numPersonas").val(datos.numPersonas);
//         $("#numPersonas").attr("readonly", false);

//         $("#precio").val(datos.precio);
//         $("#precio").attr("readonly", false);

//         $('#sede_idVer').attr('type', 'hidden');
//         $("#sede_id").val(datos.sede.id);
//         $('#sede_id').show();

//         $('#tipoVer').attr('type', 'hidden');
//         $('#tipo').show();


//         $('#submit').show()
//         $('#modalCRUD').modal('show');
//     } catch (error) {
//         notificacion.fire({
//             icon: "error",
//             title: "¡ No Existe !",
//             text: "Tu registro no se puede ver."
//         });
//     }
// };

cancelar = function (id) {
    Swal.fire({
        title: '¿ Estas seguro que desea Cancelar la reserva #' + id + ' ?',
        text: "¡ No podrás revertir esto !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡ Sí, Cancelar !',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: urlCompleta + '/Cancelar/' + id,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function (data) {
                    if (data.success) {
                        table.ajax.reload(null, false);
                        notificacion.fire({
                            icon: "success",
                            title: "¡ Cancelada !",
                            text: "Tu registro ha sido Cancelada."
                        });
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "¡ Error !",
                            text: "Tu reserva no ha sido Cancelada."
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