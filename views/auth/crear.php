
<div class="contenedor crear">
    <h1 class="uptask">UpTask</h1>
    <p class="tagline">Crea y administra tus proyectos</p>

    
    <div class="contenedor-sm">
        <p class="descripcion-pagina"> Crea tu cuenta en UpTask </p>
        
        <?php include_once __DIR__ . '/../templates/alertas.php';   ?>
        
    <form action="/crear" class="formulario" method="post">
        <div class="campo">
            <label for="nombre">nombre</label>
            <input type="text" id="nombre" placeholder="Tu nombre" name="nombre" value="<?php echo $usuario->nombre; ?>">
        </div>
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Tu email" name="email" value="<?php echo $usuario->email; ?>">
        </div>
        <div class="campo">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Tu password" name="password">
        </div>
        <div class="campo">
            <label for="passwordRepeat">Repetir Password</label>
            <input type="password" id="passwordRepeat" placeholder="Repite tu password" name="passwordRepeat">
        </div>

        <input type="submit" class="boton" value="Crear cuenta">
    </form>

    <div class="acciones">
        <a href="/">¿Ya tienes cuenta? Iniciar sesión</a>
        <a href="/olvide">¿Olvidaste tu password?</a>
    </div>
</div>
</div>