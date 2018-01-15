<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class UsuarioModel extends TableGateway
{

    private $dbAdapter;

    function __construct()
    {
        $this->dbAdapter = \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter();
        $this->table = 'usuario';
        $this->featureSet = new Feature\FeatureSet();
        $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
        $this->initialize();
    }

    function getAll()
    {
        $sql = new Sql($this->dbAdapter);
        $select = $sql->select();
        $select->columns(array(
            'id',
            'nombre',
            'apellidoP',
            'apellidoM',
            'correo',
            'telefono'
        ))->from(array(
            'p' => $this->table
        ));
        $selectString = $sql->getSqlStringForSqlObject($select);
        $execute = $this->dbAdapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
        $result = $execute->toArray();
        
        return $result;
    }

    function existe($dataVoluntario)
    {
        $consulta = $this->dbAdapter->query("select * FROM usuario where correo = '" . $dataVoluntario['correo'] . "'", Adapter::QUERY_MODE_EXECUTE);
        
        $res = $consulta->toArray();
        
        return ($res != null && count($res) >0) ? $res[0] : $res;
    }

    function addUsuario($dataUsuario)
    {
        $flag = false;
        $respuesta = array();
        
        try {
            $sql = new Sql($this->dbAdapter);
            $insertar = $sql->insert($this->table);
            $array = array(
                'nombre' => $dataUsuario["nombre"],
                'apellidoP' => $dataUsuario["apellidoP"],
                'apellidoM' => $dataUsuario["apellidoM"],
                'correo' => $dataUsuario["correo"],
                'telefono' => $dataUsuario["telefono"]
            );
            $insertar->values($array);
            $selectString = $sql->getSqlStringForSqlObject($insertar);
            $results = $this->dbAdapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
            $flag = true;
        } catch (\PDOException $e) {
            $flag = false;
        } catch (\Exception $e) {
        }
        $respuesta['status'] = $flag;
        
        return $respuesta;
    }
}
?>