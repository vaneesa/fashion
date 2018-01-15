<?php
/**
 * @autor JuanMS
 * Controlador para las peticiones de sismos
 */
namespace Application\Controller;

use Application\Service\EventoService;
use Zend\Mvc\Controller\AbstractActionController;

class EventoController extends AbstractActionController
{

    private $eventoService;

    function getEventoService()
    {
        return $this->eventoService = new EventoService();
    }

    function listaAction()
    {
        $voluntarios = $this->getEventoService()->getAll();
        $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
            "response" => $voluntarios
        )));
        
        return $response;
    }

    function addEventoAction()
    {
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $postData = $this->getRequest()->getContent();
            $decodePostData = json_decode($postData, true);
            
            $result = $this->getEventoService()->addSimulacro($decodePostData);
            
            $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
                "response" => $result
            )));
            
            return $response;
        }
        exit();
    }

    function buscarEventoAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $postData = $this->getRequest()->getContent();
            $decodePostData = json_decode($postData, true);
            
            $result = $this->getEventoService()->buscarDetalles($decodePostData);
            
            $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
                "response" => $result
            )));
            return $response;
        }
    }

    function eliminarEventoAction()
    {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $postData = $this->getRequest()->getContent();
            $decodePostData = json_decode($postData, true);
            
            $result = $this->getEventoService()->eliminarEvento($decodePostData);
            
            $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
                "response" => $result
            )));
            return $response;
        }
    }
}