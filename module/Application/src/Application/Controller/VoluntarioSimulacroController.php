<?php
namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Service\VoluntarioSimulacroService;

class VoluntarioSimulacroController extends AbstractActionController
{

    private $voluntarioSimulacroService;

    /**
     * Instanciamos el servicio de participantes
     */
    public function getVoluntarioSimulacroService()
    {
        return $this->voluntarioSimulacroService = new VoluntarioSimulacroService();
    }

    public function listaAction(){

        $voluntariosSimulacro = $this->getVoluntarioSimulacroService()->getAll();
        $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
                "response" => $voluntariosSimulacro,
            )));
            
        return $response;
        //exit;
    }

    public function addVoluntarioSimulacroAction(){


        $request = $this->getRequest();
        if ($request->isPost()) {
            $postData       = $this->getRequest()->getContent();
            $decodePostData = json_decode($postData, true);

            
            $result = $this->getVoluntarioSimulacroService()->addVoluntarioSimulacro($decodePostData);
                   
            $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
                "response" => $result,
            )));
            return $response;
        }

        exit;
    }
    
    public function updateVoluntarioSimulacroAction(){
        
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $postData       = $this->getRequest()->getContent();
            $decodePostData = json_decode($postData, true);
            
            
            $result = $this->getVoluntarioSimulacroService()->updateVoluntario($decodePostData);
            
            $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
                "response" => $result,
            )));
            return $response;
        }
        
        exit;
    }
    
    public function buscarDetalleVoluntarioAction(){
        
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $postData       = $this->getRequest()->getContent();
            $decodePostData = json_decode($postData, true);
            
            
            $result = $this->getVoluntarioSimulacroService()->buscarDetalleVoluntario($decodePostData);
            
            $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
                "response" => $result,
            )));
            return $response;
        }
        
        exit;
    }
    
    public function deletelistaVoluntarioAction(){
        
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $postData       = $this->getRequest()->getContent();
            $decodePostData = json_decode($postData, true);
            
            
            $result = $this->getVoluntarioSimulacroService()->listaVoluntario($decodePostData);
            
            $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
                "response" => $result,
            )));
            return $response;
        }
        
        exit;
    }
    
    public function eliminarVolDeSimulacroAction(){
        
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $postData       = $this->getRequest()->getContent();
            $decodePostData = json_decode($postData, true);
            
            
            $result = $this->getVoluntarioSimulacroService()->eliminarVolDeSimulacro($decodePostData);
            
            $response = $this->getResponse()->setContent(\Zend\Json\Json::encode(array(
                "response" => $result,
            )));
            return $response;
        }
        
        exit;
    }
}
?>