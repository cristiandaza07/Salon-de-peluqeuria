<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $router->render('auth/login');
    }
    public static function logout(){
        echo 'Vista de logout';
    }
    public static function olvide(Router $router){
        $router->render('auth/olvide-password',[
            
        ]);
    }
    public static function recuperar(){
        echo 'Vista de recuperar';
    }
    public static function crear(Router $router){
        $usuario = new Usuario($_POST);

        //Alertas vacias
        $alertas = [];
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Verificar si no hay alertas
            if(empty($alertas)){
                //Verifivar que el usuario no esté registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    //Hashear la contraseña
                    $usuario->hashPassword();

                    //Generar token único
                    $usuario->crearToken();

                    //Enviar email
                    $email = new Email($usuario->email, $usuario->token, $usuario->nombre);

                    $email->enviarConfirmacion();

                    //Registrar el usuario
                    $resultado = $usuario->guardar();

                    if($resultado){
                        header('Location: /mensaje');
                    }

                }
            }
        }

        $router->render('auth/crear-cuenta',[
            'usuario' => $usuario, 
            'alertas' => $alertas 
        ]);
        
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }
}
