<style>
.submenu {
    display: none; 
    list-style: none;
    padding-left: 20px;
}

.submenu li a {
    font-size: 16px;
    color: #f1f1f1;
    padding: 10px 0;
    display: block;
}

.submenu li a:hover {
    background-color: #6a11cb;
}

.submenu-toggle {
    cursor: pointer;
}

.submenu.active {
    display: block;
}

</style>
<div class="sidebar">
    <a href=""><i class="fas fa-tachometer-alt"></i> Dashboard</a>

    <a href="#" class="submenu-toggle"><i class="fas fa-users"></i> Usuarios <i class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
        <li><a href="">Ver todos</a></li>
        <li><a href="">Agregar usuario</a></li>
        <li><a href="">Roles y permisos</a></li>
    </ul>

    <a href="#" class="submenu-toggle"><i class="fas fa-ticket-alt"></i> Tickets <i class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
        <li><a href="">Ver tickets</a></li>
        <li><a href="">Crear ticket</a></li>
        <li><a href="">Historial de tickets</a></li>
    </ul>

    <a href="#" class="submenu-toggle"><i class="fas fa-user-tie"></i> Clientes <i class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
        <li><a href="">Ver clientes</a></li>
        <li><a href="">Agregar cliente</a></li>
        <li><a href="">Historial de clientes</a></li>
    </ul>

    <a href="#" class="submenu-toggle"><i class="fas fa-clipboard-list"></i> Actividades <i class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
        <li><a href="">Ver actividades</a></li>
        <li><a href="">Agregar actividad</a></li>
        <li><a href="">Historial de actividades</a></li>
    </ul>

    <a href="#" class="submenu-toggle"><i class="fas fa-calendar-check"></i> Asistencia <i class="fas fa-chevron-down"></i></a>
    <ul class="submenu">
        <li><a href="">Ver asistencia</a></li>
        <li><a href="">Registrar asistencia</a></li>
        <li><a href="">Resumen de asistencia</a></li>
    </ul>

    <a href="{{ route('report') }}"><i class="fas fa-file-alt"></i> Reporte de Registro de Asistencia</a>
    <a href="#"><i class="fas fa-cogs"></i> Configuración</a>

    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
<script>
    const submenuToggles = document.querySelectorAll('.submenu-toggle');

    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const submenu = toggle.nextElementSibling;

            if (submenu.classList.contains('active')) {
                submenu.classList.remove('active');
            } else {
                submenu.classList.add('active');
            }
        });
    });
</script>