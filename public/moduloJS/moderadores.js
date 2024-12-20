var token = $('meta[name="csrf-token"]').attr('content');
var opcion;
const urlCompleta = window.location.href;


$(document).ready(function () {
    const selectSede = $("#sede_id");

    // Sedes
    $.ajax({
        url: urlCompleta + "/Lista/Sedes",
        type: 'GET',
        dataType: "json",
        success: function (data) {
            data.forEach(function (item) {
                const optionSede = new Option(item.sedeText, item.sedeId);
                selectSede.append(optionSede);
            });
        }
    });

    $('#nombre').on('input', function() {
        $(this).val($(this).val().replace(/\d/g, ''));
      });
      $('#apellido').on('input', function() {
          $(this).val($(this).val().replace(/\d/g, ''));
      });
      $('#telefono').on('input', function() {
          $(this).val($(this).val().replace(/[^0-9]/g, ''));
      });
      $('#email').on('input', function() {
          $(this).val($(this).val().replace(/\s+/g, ''));
      });

      $('#sede_id').select2({
        dropdownParent: $('#modalCRUD'),
        width: 'resolve',
        theme: "classic",
        placeholder: "Selecciona una Sede",
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
        data: 'name',
        name: 'name',
        className: 'text-center'
    },
    {
        data: 'apellido',
        name: 'apellido',
        className: 'text-center'
    },
    {
        data: 'identificacion',
        name: 'identificacion',
        className: 'text-center'
    },
    {
        data: 'telefono',
        name: 'telefono',
        className: 'text-center'
    },
    {
        data: 'email',
        name: 'email',
        className: 'text-center'
    },
    {
        data: 'sede.nombre',
        name: 'sede.nombre',
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
    formData.append('apellido', $.trim($('#apellido').val()));
    formData.append('identificacion', $.trim($('#identificacion').val()));
    formData.append('telefono', $.trim($('#telefono').val()));
    formData.append('email', $.trim($('#email').val()));
    formData.append('password', $.trim($('#password').val()));
    formData.append('sede_id', $.trim($('#sede_id').val()));

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
                    text: "Recuerda que no pueden haber 2 otro usuario con el mismo Identificador."
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
    $("#titulo").html("Agregar Moderador");
    $("#titulo").attr("class", "modal-title text-white");
    $("#bg-titulo").attr("class", "modal-header bg-gradient-primary");

    $('#submit').show();
    $('#modalCRUD').modal('show');
};

editar = async function(id) {
    rutaAccion = urlCompleta + '/Editar/' + id;
    accion = 2;

    try {
        $("#formulario").trigger("reset");
        dat = await consulta(id);
        $("#titulo").html("Editar Moderador -> " + dat.identificacion);
        $("#titulo").attr("class", "modal-title text-white");
        $("#bg-titulo").attr("class", "modal-header bg-warning");

        // asigancion de valores
        $("#nombre").val(dat.name);
        $("#apellido").val(dat.apellido);
        $("#identificacion").val(dat.identificacion);
        $("#telefono").val(dat.telefono);
        $("#email").val(dat.email);
        $("#password").val();
        console.log(dat.datos);
        

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