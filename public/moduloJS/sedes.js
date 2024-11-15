var token = $('meta[name="csrf-token"]').attr('content');
var opcion;
const urlCompleta = window.location.href;

$(document).ready(function() {
    $('#pais').select2({
      dropdownParent: $('#modalCRUD'),
      width: 'resolve',
      theme: "classic",
      placeholder: "Selecciona un Pais",
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
        data: 'nombre',
        name: 'nombre',
        className: 'text-center'
    },
    {
        data: 'ubicacione.pais',
        name: 'ubicacione.pais',
        className: 'text-center'
    },
    {
        data: 'ubicacione.estado',
        name: 'ubicacione.estado',
        className: 'text-center'
    },
    {
        data: 'ubicacione.municipio',
        name: 'ubicacione.municipio',
        className: 'text-center'
    },
    {
        data: 'ubicacione.direccion',
        name: 'ubicacione.direccion',
        className: 'text-center'
    },
    {
        "data": null,
        "width": "100px",
        "className": "text-center",
        "render": function (row) {
            return `
                        <div class="dropdown dropleft">
                            <button class="btn btn-link text-secondary mb-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-xs"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:ver(${row.id});"><i class="fa fa-file text-primary"></i> Ver</a>
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:editar(${row.id});"><i class="fa fa-edit text-warning"></i> Editar</a>
                                <a class="dropdown-item" data-id="${row.id}" href="javascript:eliminar(${row.id});"><i class="fa fa-trash text-danger"></i> Eliminar</a>
                            </div>
                        </div>`;
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

// Consulta Registro
consulta = function(id) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: urlCompleta + "/" + id,
            method: "GET",
            success: function(Data) {
                resolve(Data);
            },
            error: function(error) {
                reject(error);
            }
        });
    });
};

// Enviar datos
$('#formulario').submit(function (e) {
    e.preventDefault(); 

    var formData = new FormData(this);
    formData.append('nombre', $.trim($('#nombre').val()));
    formData.append('pais', $.trim($('#pais').val()));
    formData.append('estado', $.trim($('#estado').val()));
    formData.append('municipio', $.trim($('#municipio').val()));
    formData.append('direccion', $.trim($('#direccion').val()));

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
                    text: "Recuerda que no pueden haber 2 sedes con el mismo nombre."
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

// Funciones de Botones
crear = function () {
    rutaAccion = urlCompleta;
    accion = 1;

    // reinicial Formulario
    $("#formulario").trigger("reset");

    // Editar Modal
    $("#titulo").html("Agregar Sede");
    $("#titulo").attr("class", "modal-title text-white");
    $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");

    $("#nombre").attr("readonly", false);
    $("#pais").attr("readonly", false);
    $("#estado").attr("readonly", false);
    $("#municipio").attr("readonly", false);
    $("#direccion").attr("readonly", false);

    $('#submit').show()
    $('#modalCRUD').modal('show');
};

ver = async function(id) {
    try {
        $("#formulario").trigger("reset");
        datos = await consulta(id);
        $("#titulo").html("Ver Sede -> " + datos.nombre);
        $("#titulo").attr("class", "modal-title text-white");
        $("#bg-titulo").attr("class", "modal-header bg-info");

        // asigancion de valores
        $("#nombre").val(datos.nombre);
        $("#nombre").attr("readonly", true);
        $("#pais").val(datos.ubicacione.pais);
        $("#pais").attr("readonly", true);
        $("#estado").val(datos.ubicacione.estado);
        $("#estado").attr("readonly", true);
        $("#municipio").val(datos.ubicacione.municipio);
        $("#municipio").attr("readonly", true);
        $("#direccion").val(datos.ubicacione.direccion);
        $("#direccion").attr("readonly", true);

        $('#submit').hide()
        $('#modalCRUD').modal('show');
    } catch (error) {
        notificacion.fire({
            icon: "error",
            title: "¡ No Existe !",
            text: "Tu registro no se puede ver."
        });
    }
};

editar = async function(id) {
    rutaAccion = urlCompleta + '/Editar/' + id;
    accion = 2;

    try {
        $("#formulario").trigger("reset");
        datos = await consulta(id);
        $("#titulo").html("Editar Sede -> " + datos.nombre);
        $("#titulo").attr("class", "modal-title text-white");
        $("#bg-titulo").attr("class", "modal-header bg-warning");

        // asigancion de valores
        $("#nombre").val(datos.nombre);
        $("#nombre").attr("readonly", false);
        $("#pais").val(datos.ubicacione.pais);
        $("#pais").attr("readonly", false);
        $("#estado").val(datos.ubicacione.estado);
        $("#estado").attr("readonly", false);
        $("#municipio").val(datos.ubicacione.municipio);
        $("#municipio").attr("readonly", false);
        $("#direccion").val(datos.ubicacione.direccion);
        $("#direccion").attr("readonly", false);

        $('#submit').show()
        $('#modalCRUD').modal('show');
    } catch (error) {
        notificacion.fire({
            icon: "error",
            title: "¡ No Existe !",
            text: "Tu registro no se puede ver."
        });
    }
};

eliminar = function(id) {
    Swal.fire({
        title: '¿ Estas seguro que desea eliminar el registro #'+ id +' ?',
        text: "¡ No podrás revertir esto !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡ Sí, bórralo !',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: urlCompleta + '/' + id,
                method: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function(data) {
                    if (data.success) {
                        table.row('#' + id).remove().draw();
                        notificacion.fire({
                            icon: "success",
                            title: "¡ Eliminado !",
                            text: "Tu registro ha sido eliminado."
                        });
                    } else {
                        notificacion.fire({
                            icon: "error",
                            title: "¡ Error !",
                            text: "Tu registro no ha sido eliminado."
                        });
                    }
                },
                error: function(xhr, status, error) {
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