<?php

    namespace Controllers;
    use MVC\Router;

    class DashboardController {

        public static function prueba(Router $router){
            
            

            $router->render('dashboard/index', [
          
            ]);

        }s

    }