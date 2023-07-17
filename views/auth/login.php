<div class="contenedor login">
    <h1 class="uptask">UpTask</h1>
    <p class="tagline">Crea y administra tus proyectos</p>
    
    
    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php';   ?>
    <p class="descripcion-pagina"> Iniciar Sesion </p>

    <form action="/" class="formulario" method="post" novalidate>
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Tu email" name="email">
        </div>
        <div class="campo">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Tu password" name="password">
        </div>

        <input type="submit" class="boton" value="iniciar sesion">
    </form>

    <div class="acciones">
        <a href="/crear">¿Aun no tienes cuenta?</a>
        <a href="/olvide">¿Olvidaste tu password?</a>
    </div>
</div>
</div>