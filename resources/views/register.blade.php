<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Enlazamos a Bootstrap para que el diseño sea responsivo y estilizado -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo personalizado para centrar el formulario en la pantalla */
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
        }
        .card-header {
            text-align: center;
            background-color: #007bff;
            color: white;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="card shadow-lg">
    <div class="card-header">
        <h4>Registro de Usuario</h4>
    </div>

    <div class="card-body">
        <!-- Si hay errores de validación, se mostrarán aquí -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf  <!-- Token CSRF para protección -->

            <!-- Campo para el nombre -->
            <div class="form-group mb-3">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Campo para el correo electrónico -->
            <div class="form-group mb-3">
                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Campo para la contraseña -->
            <div class="form-group mb-3">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Campo para confirmar la contraseña -->
            <div class="form-group mb-3">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <!-- Botón de registro -->
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Registrar') }}
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
