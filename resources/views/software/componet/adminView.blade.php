<div class="row mt-3 mb-3">
    <div class="col">
        <x-adminlte-small-box title="{{ $habitaciones }}" text="Habitaciones Totales" icon="fas fa-door-closed text-dark"
            theme="success" url="{{ route('habitaciones') }}" url-text="Ver Habitaciones" />
    </div>
    <div class="col order-12">
        <x-adminlte-small-box title="{{ $reservas }}" text="Reservas Totales" icon="fas fa-clipboard-list text-dark"
            theme="danger" url="{{ route('reservas') }}" url-text="Ver registro Reservas" />
    </div>
    <div class="col order-1">
        <x-adminlte-small-box title="{{ $huespedes }}" text="Huespedes" icon="fas fa-address-book text-dark"
            theme="info" url="{{ route('huesped') }}" url-text="Ver registro Huespedes" />
    </div>
</div>

