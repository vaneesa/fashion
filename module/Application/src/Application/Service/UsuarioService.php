<?php
namespace Application\Service;

use Application\Model\UsuarioModel;

class UsuarioService
{

    private $usuarioModel;

    private function getVoluntariosModel()
    {
        return $this->usuarioModel = new UsuarioModel();
    }

    /**
     * Obtenermos todos los participantes
     */
    function getAll()
    {
       return $this->getVoluntariosModel()->getAll();
        
    }

    function addVoluntario($dataUsuario)
    {
        $respuesta = array();
        $usuario = $this->getVoluntariosModel()->existe($dataUsuario);
        
        if (count($usuario) == 0) {
            $respuesta = $this->getVoluntariosModel()->addUsuario($dataUsuario);
            $respuesta["mensaje"] = "Usuario Registrado";
        } else {
            $respuesta["status"] = false; 
            $respuesta["mensaje"] = "Ya existe usuario asciado a la cuenta de correo : " . $usuario['correo'];
        }
        return $respuesta;
    }
}
?>