<?php
namespace Application\Service;

use Application\Model\EventoModel;

class EventoService
{

    private $eventoModel;

    private function getEventoModel()
    {
        return $this->eventoModel = new EventoModel();
    }

    function getAll()
    {
        return $this->getEventoModel()->getAll();
    }

    function addSimulacro($dataEvento)
    {
        $respuesta = array();
        $evento = $this->getEventoModel()->buscarDetalles($dataEvento);
        
        if (count($evento) == 0) {
            $respuesta = $this->getEventoModel()->addEvento($dataEvento);
            $respuesta["mensaje"] = "Evento Registrado";
        } else {
            $respuesta["status"] = false;
            $respuesta["mensaje"] = "Ya existe evento en  : " . $evento['direccion'] . "<br />Con fecha : " . $evento["fecha"];
        }
        
        return $respuesta;
    }

    function buscarDetalles($decodePostData)
    {
        return $this->getEventoModel()->buscarDetalles($decodePostData);
    }

    function eliminarEvento($decodePostData)
    {
        return $this->getEventoModel()->eliminarEvento($decodePostData);
    }
}
?>