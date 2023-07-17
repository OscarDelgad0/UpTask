<div class="contenedor restablecer">
    <h1 class="uptask">UpTask</h1>
    <p class="tagline">Crea y administra tus proyectos</p>

    <div class="contenedor-sm">
    <p class="descripcion-pagina"> Iniciar Sesion </p>

    <?php include_once __DIR__ . '/../templates/alertas.php';   ?>

    <?php if($mostrar) { ?>
    <form class="formulario" method="post">
        <div class="campo">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Tu password" name="password">
        </div>

        <input type="submit" class="boton" value="Guardar Password">
    </form>

        <?php }?>
    <div class="acciones">
        <a href="/crear">¿Aun no tienes cuenta?</a>
        <a href="/olvide">¿Olvidaste tu password?</a>
    </div>
</div>
</div>