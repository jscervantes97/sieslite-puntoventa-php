<?php 
namespace Repository ;
//include 'genericRepository.php';
use Repository\GenericRepository ; 

//include '../models/usuario.php';
use Models\Usuario;

//require_once '../models/usuario.php';
class UsuarioRepository extends GenericRepository{

    public function __construct(){
        parent::__construct('idUsuario', 'usuarios'); 
    }

    public function findUserByNombreUsuario($nombreUsuario){
        $searchUser = null;  
        $search = $this->findByQuery("SELECT idUsuario, nombreUsuario, contra, status, rol, modulos FROM usuarios where nombreUsuario = '$nombreUsuario' and status = 1;");
        if(count($search) > 0){
            $searchUser = new Usuario ; 
            $searchUser->setIdUsuario($search[0][0]);
            $searchUser->setNombreUsuario($search[0][1]);
            $searchUser->setContra($search[0][2]);
            $searchUser->setStatus($search[0][3]);
            $searchUser->setRol($search[0][4]);
            $searchUser->setModulos($search[0][5]);
            $modulosString = $search[0][5];
            $modulos = $this->findByQueryAssoc("select idModulo, nombre, url from modulos m where m.idModulo in ($modulosString);");
            $modulosArray = array();
            foreach($modulos as $modulo){
                array_push($modulosArray , [
                    'idModulo' => $modulo["idModulo"],
                    'nombre' => $modulo["nombre"],
                    'url' => $modulo["url"]
                ]);
            }
            $searchUser->setModulosArray($modulosArray);

        }
        return $searchUser ; 
    }

    public function findByUserId($id){
        $searchUser = null;  
        $search = $this->findByQuery("SELECT idUsuario, nombreUsuario, contra, status, rol, modulos FROM usuarios where idUsuario = $id and status = 1;");
        if(count($search) > 0){
            $searchUser = new Usuario ; 
            $searchUser->setIdUsuario($search[0][0]);
            $searchUser->setNombreUsuario($search[0][1]);
            $searchUser->setContra(base64_decode($search[0][2]));
            $searchUser->setStatus($search[0][3]);
            $searchUser->setRol($search[0][4]);
            $searchUser->setModulos($search[0][5]);
        }
        return $searchUser ; 
    }

    public function create($params){
        $contra = base64_encode($params->contra); 
        return $this->save("INSERT INTO usuarios (nombreUsuario, contra, status, rol, modulos) VALUES('$params->nombreUsuario', '$contra', 1, '$params->rol', '$params->modulos');"); 
    }

    public function update($params){
        $contra = base64_encode($params->contra);
        return $this->executeQuery("UPDATE usuarios SET nombreUsuario='$params->nombreUsuario', contra='$contra', status=$params->status, rol='$params->rol', modulos='$params->modulos' WHERE idUsuario=$params->idUsuario; "); 
    }

    public function remove($params){
        return $this->executeQuery("UPDATE usuarios SET nombreUsuario='$params->idUsuario', status=0 WHERE idUsuario=$params->idUsuario;"); 
    }
}
?>