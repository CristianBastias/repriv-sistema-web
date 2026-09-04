<div class="container">
    <h2>Seguridad: Actualización de Contraseña</h2>
    <p>Es la primera vez que ingresa. Por favor, establezca una nueva contraseña para continuar.</p>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nueva Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Confirmar Nueva Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar y entrar al sistema</button>
    </form>
</div>
