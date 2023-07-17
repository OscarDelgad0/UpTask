<?php

    namespace Model;

    class Usuario extends ActiveRecord{
        protected static $tabla = 'usuarios';
        protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

        public function __construct($args = []){
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->email = $args['email'] ?? '';
            $this->password = $args['password'] ?? '';
            $this->passwordRepeat = $args['passwordRepeat'] ?? '';
            $this->token = $args['token'] ?? '';
            $this->confirmado = $args['confirmado'] ?? 0;
        }

        // Validar cuenta

        public function validarLogin(){
            if(!$this->email ){
                self::$alertas['error'][] = 'El email es obligatorio';
            }

            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                self::$alertas['error'][] = 'email no es válido';
            }

            if(!$this->password ){
                self::$alertas['error'][] = 'El password es obligatorio';
            }

            return self::$alertas;

        }
        // Validar nueva cuenta 
        public function validarNuevaCuenta(){
            if(!$this->nombre ){
                self::$alertas['error'][] = 'El nombre de usuario es obligatorio';
            }
            
            if(!$this->email ){
                self::$alertas['error'][] = 'El email es obligatorio';
            }

            if(!$this->password ){
                self::$alertas['error'][] = 'El password es obligatorio';
            }


            // if(strlen(!$this->password) < 6 ){
            //     self::$alertas['error'][] = 'El password debe tener al menos 6 caracteres';
            // }

            if($this->password !== $this->passwordRepeat){
                self::$alertas['error'][] = 'Las contraseñas no coinciden ';
            }

            return self::$alertas;
        }

        public function validarEmail(){

            if(!$this->email){
                self::$alertas['error'][] = 'El email es obligatorio';
            }

            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                self::$alertas['error'][] = 'email no es válido';
            }
            return self::$alertas;
        }

        public function hashPassword(){
            $this->password = password_hash( $this->password, PASSWORD_BCRYPT);
        }

        public function crearToken(){
            $this->token = uniqid();
        }

        public function validarPassword(){
            if(!$this->password ){
                self::$alertas['error'][] = 'El password es obligatorio';
            }
            
            if(strlen($this->password) < 6 ){
                self::$alertas['error'][] = 'El password debe tener al menos 6 caracteres';
            }
            return self::$alertas;
        }

    }