<?php

namespace App\Service\DB;

use App\Models\Habitacione;
use App\Models\Recibo;
use App\Models\Reserva;
use App\Models\Sede;
use App\Models\Ubicacione;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BDClass
{
    // Propio
    // Buscar datos del usuario auth
    public function buscarAuth()
    {
        $id = auth::user()->getAuthIdentifier();
        $usu = User::with('reserva.recibo')->find($id);
        return $usu;
    }

    // Sede
    // Lista
    public function SedesLista()
    {
        $datos = Sede::with('ubicacione')->get();
        return $datos;
    }

    // Crear
    public function SedesCrear($datos)
    {
        $sede = new Sede();
        $sede->nombre = $datos['nombre'];
        $sede->save();

        $ubi = new Ubicacione();
        $ubi->pais = $datos['pais'];
        $ubi->estado = $datos['estado'];
        $ubi->municipio = $datos['municipio'];
        $ubi->direccion = $datos['direccion'];
        $ubi->sede()->associate($sede);
        $ubi->save();
    }

    // Editar
    public function SedesEditar($datos, $id)
    {
        $id->nombre = $datos['nombre'];
        $id->Ubicacione->pais = $datos['pais'];
        $id->Ubicacione->estado = $datos['estado'];
        $id->Ubicacione->municipio = $datos['municipio'];
        $id->Ubicacione->direccion = $datos['direccion'];
        $id->Ubicacione->save();
        $id->save();
    }

    // Detalle
    public function SedeDetalle($id)
    {
        $datos = Sede::with('ubicacione')->find($id);
        return $datos;
    }

    // Habitaciones
    // Lista
    public function HabitacionesLista()
    {
        $datos = Habitacione::with('sede')->get();
        return $datos;
    }

    // Buscar Por ID
    public function buscarHabitacionID($id)
    {
        $datos = Habitacione::find($id);
        $devolver = $datos->identificador;
        return $devolver;
    }

    // Lista
    public function HabitacionesCount()
    {
        $datos = Habitacione::count();
        return $datos;
    }

    // Disponibles
    public function habitacionesDisponibles()
    {
        $datos = Habitacione::where('disponibilidad', 'disponible')->with('sede')->get();
        return $datos;
    }

    // Disponibles Moderador
    public function habitacionesDisponiblesModerador($sede)
    {
        $datos = Habitacione::where('disponibilidad', 'disponible')->where('sede_id', $sede)->with('sede')->get();
        return $datos;
    }

    // Lista Moderador
    public function HabitacionesListaModerador($sede)
    {
        $datos = Habitacione::with('sede')->where('sede_id', $sede)->get();
        return $datos;
    }

    // Crear
    public function HabitacionesCrear($datos)
    {
        $habi = new Habitacione();
        $habi->identificador = $datos['identificador'];
        $habi->piso = $datos['piso'];
        $habi->tipo = $datos['tipo'];
        $habi->disponibilidad = 'disponible';
        $habi->numPersonas = $datos['numPersonas'];
        $habi->precio = $datos['precio'];
        $habi->sede()->associate($datos['sede_id']);
        $habi->save();
    }

    // editar
    public function HabitacionesEditar($datos, $id)
    {
        $id->identificador = $datos['identificador'];
        $id->piso = $datos['piso'];
        $id->tipo = $datos['tipo'];
        $id->numPersonas = $datos['numPersonas'];
        $id->precio = $datos['precio'];
        $id->sede()->associate($datos['sede_id']);
        $id->save();
    }

    // Liberal habitacion
    public function HabitacionesEstado($id, $estado)
    {
        $id = Habitacione::find($id);
        $id->disponibilidad = $estado;
        $id->save();
    }

    // Users
    // Lista
    public function UserListaHuesped()
    {
        $datos = User::where('tipo', 'Huesped')->get();
        return $datos;
    }

    // Buscar Por ID
    public function buscarUserID($id)
    {
        $datos = User::find($id);
        $devolver = $datos->identificacion;
        return $devolver;
    }

    // Count
    public function UserHuespedCount()
    {
        $datos = User::where("tipo", "Huesped")->count();
        return $datos;
    }

    public function UserListaModeradores()
    {
        $datos = User::where('tipo', 'Moderador')->with('sede')->get();
        return $datos;
    }

    public function UserListaAdministradores()
    {
        $datos = User::where('tipo', 'Administrador')->get();
        return $datos;
    }

    // Crear
    public function UserCrear($datos, $rol)
    {
        $admin = new User();
        $admin->name = $datos['nombre'];
        $admin->apellido = $datos['apellido'];
        $admin->identificacion = $datos['identificacion'];
        $admin->telefono = $datos['telefono'];
        $admin->email = $datos['email'];
        $admin->password = Hash::make($datos['password']);
        $admin->tipo = $rol;
        if ($datos['sede_id'] == true) {
            $admin->sede()->associate($datos['sede_id']);
        }
        $admin->assignRole($rol);
        $admin->save();
    }

    // EditarPanel
    public function UserEditarPanel($datos, $id)
    {
        $id->name = $datos['nombre'];
        $id->apellido = $datos['apellido'];
        $id->identificacion = $datos['identificacion'];
        $id->telefono = $datos['telefono'];
        $id->email = $datos['email'];
        $id->password = Hash::make($datos['password']);
        $id->save();
    }

    // Reservas
    // Lista
    // Admin
    public function ReservaListaAdmin()
    {
        $datos = Reserva::with('user')->with('habitacione')->get();
        return $datos;
    }

    // Huesped
    public function ReservaListaHuesped()
    {
        $user = $this->buscarAuth();
        $datos = Reserva::with('habitacione')->where('user_id', $user->id)->get();
        return $datos;
    }

    // Count
    public function ReservasCount()
    {
        $datos = Reserva::count();
        return $datos;
    }

    // Crear
    // Normal
    public function ReservaCrear($datos)
    {
        $user = $this->buscarAuth();
        $rese = new Reserva();
        $rese->estado = 'En Proceso';
        $rese->identificador = now()->timestamp * 1000;
        $rese->fecha_entrada = $datos['fecha_entrada'];
        $rese->fecha_salida = $datos['fecha_salida'];
        $rese->habitacione()->associate($datos['habitacione_id']);
        $rese->user()->associate($user);
        $rese->save();
    }

    // Admin o moderador
    public function ReservaCrearTrabajador($datos)
    {
        $rese = new Reserva();
        $rese->estado = 'En Proceso';
        $rese->identificador = now()->timestamp * 1000;
        $rese->fecha_entrada = $datos['fecha_entrada'];
        $rese->fecha_salida = $datos['fecha_salida'];
        $rese->habitacione()->associate($datos['habitacione_id']);
        $rese->user()->associate($datos['huesped_id']);
        $rese->save();
    }

    // Editar
    public function ReservaEditar($datos, $id)
    {
        $id->fecha_entrada = $datos['fecha_entrada'];
        $id->fecha_salida = $datos['fecha_salida'];
        $id->habitacione()->associate($datos['habitacione_id']);
        $id->user()->associate($datos['huesped_id']);
        $id->save();
    }

    // Editar Huesped
    public function ReservaEditarHuesped($datos, $id)
    {
        $id->fecha_entrada = $datos['fecha_entrada'];
        $id->fecha_salida = $datos['fecha_salida'];
        $id->habitacione()->associate($datos['habitacione_id']);
        $id->save();
    }

    // Verificar Activa
    public function ReservaVerificarActiva($id)
    {
        $dato = Reserva::where('user_id', $id)->where('estado', 'En Proceso')->first();
        return $dato;
    }

    // Ver Reserva de sede especifica donde trabaja el moderador
    public function ReservasModeradorLista($sede)
    {
        $reservas = Reserva::whereHas('habitacione.sede', function ($query) use ($sede) {
            $query->where('id', $sede);
        })->get();
        return $reservas;
    }

    // Recibo
    // Lista
    public function ReciboLista()
    {
        $datos = Recibo::with('reserva')->get();
        return $datos;
    }

    // Lista moderador
    public function ReciboListaModerador($sede)
    {
        $recibos = Recibo::with('reserva.habitacione.sede')
            ->whereHas('reserva.habitacione.sede', function ($query) use ($sede) {
                $query->where('sedes.id', $sede);
            })->get();
        return $recibos;
    }

    // Lista Huesped
    public function ReciboHuesped()
    {
        $user = $this->buscarAuth();
        $recibo = $user->reserva->flatMap(function ($reserva) {
            return $reserva->recibo;
        });
        return $recibo;
    }

    public function ReciboCrear($id)
    {
        $fecha_entrada = Carbon::parse($id->fecha_entrada);
        $fecha_salida = Carbon::parse($id->fecha_salida);
        $cantidadDias = $fecha_entrada->diffInDays($fecha_salida);

        $habitacion = Habitacione::find($id->habitacione_id);
        $precio = $habitacion->precio;

        $timestamp = now()->timestamp;
        $fecha_formateada = Carbon::createFromTimestamp($timestamp)->format('Y-m-d H:i:s');

        $recibo = new Recibo();
        $recibo->identificador = now()->timestamp * 1000;
        $recibo->estado = 'Realizada';
        $recibo->fecha_emision = $fecha_formateada;
        $recibo->monto = $precio * $cantidadDias;
        $recibo->reserva()->associate($id);
        $recibo->save();
    }

    public function ReciboAnular($id)
    {
        $id->estado = 'Anulado';
        $id->save();
    }
}
