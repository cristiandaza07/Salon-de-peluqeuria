<?php

namespace Model;

class Usuario extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'telefono', 'admin', 'confirmado', 'token', 'password'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    //MENSAJES DE VALIDACIÓN PARA LA CREACIÓN DE LA CUENTA
    public function validarNuevaCuenta()
    {
        if(!$this->nombre){
            self::$alertas['error'][]='El nombre del cliente es obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][]='El apellido del cliente es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][]='El email del cliente es obligatorio';
        }
        if(!$this->telefono){
            self::$alertas['error'][]='El telefono del cliente es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][]='La contraseña del cliente es obligatoria';
        }   
        if(strlen($this->password) < 6){
            self::$alertas['error'][]='La contraseña debe contener más de 6 caracteres';
        }

        return self::$alertas;
    }

    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email ."' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows){
            self::$alertas['error'][]='El usuario ya está registrado';
        }

        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();

    }

}