<?php 
namespace Repository ;

use conexion\Conexion ;
class GenericRepository{

    protected $id ; 
  
    protected $table ; 
    protected $db ; 

    protected $model ;

    public function __construct($id , $table) {
        $this->id = $id ; 
        $this->table = $table ; 
        
    }

    public function findAll(){
        $query = "select * from ".$this->table." ;" ; 
        $this->db = new Conexion;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->db->close();
        return $result->fetch_all();
    }

    public function findById($id){
        $this->db = new Conexion;
        $query = "select * from $this->table where $this->id = $id ;" ; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->db->close();
        return $result->fetch_assoc();
    }

    public function findOneByQuery($query){
        $this->db = new Conexion;
        //$query = "select * from $this->table where $row = '$value' ;" ; 
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->db->close();
        return $result->fetch_assoc();
    }

    public function findByQuery($query){
        $this->db = new Conexion;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->db->close();
        return $result->fetch_all();
    }

    public function executeQuery($query){
        $this->db = new Conexion();
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->affected_rows;
        $stmt->close();
        $this->db->close();
        return $result;
    }

    public function save($query){
        $this->db = new Conexion();
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->insert_id;
        $stmt->close();
        $this->db->close();
        return $result;
    }

    public function getKeysFromTable($object){
        return array_keys($object) ; 
    }

    public function closeConection(){
        $this->db->close();
    }

    public function  addAndParameterStringOrDate($parameter , $outPutQuery , $columnName){
        return $parameter == "" ?  $outPutQuery  : $outPutQuery." and $columnName = '$parameter' "; 
    }

    public function  addAndParameterNumber($parameter , $outPutQuery , $columnName){
        return $parameter == "" ?  $outPutQuery  : $outPutQuery." and $columnName = $parameter "; 
    }

    public function findByQueryAssoc($query){
        $this->db = new Conexion;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $this->db->close();
        return $result;
    }

    public function obtenerDatosPaginador($params){
        $resultDTO = array();
        $limite = $params->limite ; 
        $query = " select count(*) as total from $this->table where status = 1 ; "; 
        $registros  = $this->findByQueryAssoc($query);
        $totalRegistros = 0 ; 
        $totalPaginas = 0 ; 
        foreach($registros as $apb){
            $totalRegistros = $apb["total"];
        }
        $totalPaginas = ($totalRegistros == 0 ? 0 : floor($totalRegistros/$limite))+1 ;
        array_push($resultDTO , [ 'msg' => 'datos paginador' , 'totalRegistros' => $totalRegistros , 'totalPaginas' => $totalPaginas ]);
        return $resultDTO ; 
    }

    public function saveModel($params){

        /*
        el arreglo de los params debe de tener una estructura del tipo : 
        [ 
            'colunmName' => 'name' , 
            'rowTipe' => (1 , 0) // 1 String , 0 otro , 
            'value' => 'valor'
        ]
        */
        $finalQuery = "INSERT INTO $this->table(" ;  
        foreach($params as $row){
            $finalQuery .= $row["columnName"] ;
        }
    }

    

}
?>


