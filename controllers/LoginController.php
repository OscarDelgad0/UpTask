<?php
namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Clases\Email;


    class LoginController {
        public static function login(Router $router){
            $alertas = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                $usuario = new Usuario($_POST);

                $alertas = $usuario->validarLogin();

                if(empty($alertas)){
                    // verificar que usuario exista
                    $usuario = Usuario::where('email', $usuario->email);      
                    if(!$usuario || !$usuario->confirmado){
                        Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                    }else {
                        // El usuario existe 
                        if( password_verify($_POST['password'], $usuario->password)){
                            session_start();

                            $_SESSION['id'] = $usuario->id;
                            $_SESSION['nombre'] = $usuario->nombre;
                            $_SESSION['email'] = $usuario->email;
                            $_SESSION['login'] = true;

                            // Redireccionar 
                            header('Location: /dashboard');
                        }else {
                            Usuario::setAlerta('error', 'Password incorrecto');
                        }
                    }
                }
            }

            $alertas = Usuario::getAlertas();


            // RENDER DE LA VISTA
            $router->render('auth/login', [
                'titulo' => 'Iniciar sesion',
                'alertas' => $alertas
            ]);
        }
        public static function crear(Router $router){

            $usuario = new Usuario;
            $alertas = [];
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $usuario->sincronizar($_POST);
                $alertas = $usuario->validarNuevaCuenta();

                
                if(empty($alertas)){
                    $existeUsuario = Usuario::where('email', $usuario->email);
                    if($existeUsuario) {
                        Usuario::setAlerta('error', 'El usuario ya esta registrado');
                        $alertas = Usuario::getAlertas();
                    }else {
                        // Crear un nuevo usuario

                        // Hasehar password
                        $usuario->hashPassword();

                        // Eliminar passwordRepeat
                        unset($usuario->passwordRepeat);

                        //Generar Token
                        $usuario->crearToken();

                        //Crear nuevo usuario
                        $resultado = $usuario->guardar();

                        // Enviar email 

                        $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                        $email->enviarConfirmacion();
                        if($resultado){
                            header('Location: /mensaje');
                        }
  
                    }
                }
            }

            // RENDER DE LA VISTA
            $router->render('auth/crear', [
                'titulo' => 'Crear',
                'usuario' => $usuario,
                'alertas' => $alertas
            ]);
        }

        // -- Funcion Olvide 
        public static function olvide(Router $router){

            $alertas = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                $usuario = new Usuario($_POST);
                $alertas = $usuario->validarEmail();

                if(empty($alertas)){
                    $usuario = Usuario::where('email', $usuario->email);
                    
                    if($usuario && $usuario->confirmado){

                        // Generar nuevo token
                            $usuario->crearToken();
                        // Acutalizar usuario
                            $usuario->guardar();
                        // Enviar email
                            $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                            $email->enviarInstrucciones();
                        // Imprimir alerta
                        Usuario::setAlerta('exito', 'Hemos enviado instrucciones a tu email');
                    }else {
                        Usuario::setAlerta('error', 'el usuario no existe o no esta confirmado');
                    }
                }
            }
            $alertas = Usuario::getAlertas();
            
            // RENDER DE LA VISTA
            $router->render('auth/olvide', [
                'titulo' => 'Recuperar password',
                'alertas' => $alertas
            ]);
        }

        // -- Funcion restablecer
        public static function restablecer(Router $router){

            $token = s($_GET['token']);
            $mostrar = true;

            if(!$token) header('Location: /');

            $usuario = Usuario::where('token', $token);

            
            if(empty($usuario)){
                Usuario::setAlerta('error', 'Token No Válido');
                $mostrar = false;
            }
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                // Añadir el nuevo password
                $usuario->sincronizar($_POST);               

                // Validar password
                $alertas = $usuario->validarPassword();


                if(empty($alertas)) {
                    // hashear password
                    $usuario->hashPassword();         
                    // Eliminar el token
                    $usuario->token = null;
                    // Guardar el usuario

                    $resultado = $usuario->guardar();
                    // Redireccionar
                    if($resultado){
                        header('Location: /');
                    }
                }
            }

            $alertas = Usuario::getAlertas();

            // RENDER DE LA VISTA
            $router->render('auth/restablecer', [
                'titulo' => 'Restablecer password',
                'alertas'  => $alertas,
                'mostrar' => $mostrar
            ]);
        }
        public static function mensaje(Router $router){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
            }

            // RENDER DE LA VISTA
            $router->render('auth/mensaje', [
                'titulo' => 'Notificación'
            ]);
        }
        public static function confirmar(Router $router){

            $token = s($_GET['token']);

            if(!$token) header('Location: /');

            $usuario = Usuario::where('token', $token);

            if(empty($usuario)){
                // No se encontro usuario con ese token
                Usuario::setAlerta('error', 'Token no válido');
            }else {
                $usuario->confirmado = 1;
                $usuario->token = null;
                unset($usuario->passwordRepeat);

                $usuario->guardar();
                Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
            }

            $alertas = Usuario::getAlertas();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
            }

            // RENDER DE LA VISTA
            $router->render('auth/confirmar', [
                'titulo' => 'Confirmar cuenta',
                'alertas' => $alertas
            ]);
        }
    }