<?php
namespace Controllers;

use MVC\Router;


    class LoginController {
        public static function login(Router $router){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
            }

            // RENDER DE LA VISTA
            $router->render('auth/login', [
                'titulo' => 'Iniciar sesion'
            ]);
        }
        public static function crear(Router $router){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
            }

            // RENDER DE LA VISTA
            $router->render('auth/crear', [
                'titulo' => 'Crear'
            ]);
        }
        public static function olvide(Router $router){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
            }

            // RENDER DE LA VISTA
            $router->render('auth/olvide', [
                'titulo' => 'Recuperar password'
            ]);
        }
        public static function restablecer(Router $router){
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
            }

            // RENDER DE LA VISTA
            $router->render('auth/restablecer', [
                'titulo' => 'Restablecer password'
            ]);
        }
        public static function mensaje(){
            echo "desde mensaje";
        }
        public static function confirmar(){
            echo "desde confirmar";
        }
    }