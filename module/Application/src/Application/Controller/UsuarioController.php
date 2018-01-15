<?php
namespace Application\Controller;

use Application\Service\UsuarioService;
use Zend\Mvc\Controller\AbstractActionController;

class UsuarioController extends AbstractActionController
{

    private $usuarioService;

    /**
     * Instanciamos el servicio de voluntarios
     */
    function getUsuarioService()
    {
        return $this->usuarioService = new UsuarioService();
    }

    function listaAction()
    {
        $voluntarios = $this->getUsuarioService()->getAll();
        $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
            "response" => $voluntarios
        )));
        
        return $response;
    }

    function addUsuarioAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $postData = $this->getRequest()->getContent();
            $decodePostData = json_decode($postData, true);
            
            $result = $this->getUsuarioService()->addVoluntario($decodePostData);
            
            $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
                "response" => $result
            )));
            return $response;
        }
    }
}
?>