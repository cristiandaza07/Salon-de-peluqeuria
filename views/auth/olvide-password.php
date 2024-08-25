<h1 class="nombre-pagina">Olvide Mi Contraseña</h1>
<p class="descripcion-pagina">Reestablece tu contraseña ingresando tu email</p>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Tu email">
    </div>

    <input class="boton" type="submit" value="Enviar">

</form>

<div class="acciones">
    <a href="/">¿Ya tienens cuentas? Inicia sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
</div>