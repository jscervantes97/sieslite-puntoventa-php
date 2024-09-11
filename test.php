<?php
//echo phpinfo() ;
class foo {
    public $a ="sss";
    public $b = 1;
    public $c;
    private $d;
    static $e;
   
    public function test() {
        var_dump(get_object_vars($this));
    }

    public function get_keys(){
        return get_object_vars($this);
    }
}

class Model {

    public $id ; 

    public $name ;

    public $age ; 

    public $elements ; 

    public function __construct() {
        //$this->id = $id ; 
        //$this->name = $name ; 
        //$this->age = $age ;
        $this->elements = array();
    }

    public function changeValue($key , $value){
        $this->key = $value ;
    }

    public function get_keys(){
        return get_object_vars($this);
    }


}

class Reader {

    public $id ; 

    public $name ;

    public $age ; 

    public function __construct($id , $name, $age) {
        $this->id = $id ; 
        $this->name = $name ; 
        $this->age = $age ;
    }

    public function get_keys(){
        return get_object_vars($this);
    }

}

class Mapper{

    private $reader ; 

    private $model ; 
    public function __construct($reader , $model) {
        $this->reader = $reader ; 
        $this->model = $model ; 
    }

    public function getKeys(){
        echo "Reader values " ; 
        echo var_dump($this->reader);
        echo "reader Keys" ;
        echo var_dump($this->reader->get_keys());
    }

    public function mapValues(){
        //$keys = $this->reader->get_keys();
        //$keys = get_object_vars($this->reader);
        $keys = $this->model->get_keys();
        echo var_dump($keys);
        foreach ($keys as $key => $value){
            
           $this->model->$key = $this->reader->$key ; 
           
        }
        
        return $this->model ;
    }

}



$test = new foo;
//var_dump(get_object_vars($test));

//$test->test();
//echo var_dump($test->get_keys());
//$keys = $test->get_keys();
//echo var_dump($keys);
//echo $keys["b"]. " " ;
/*
foreach ($keys as $key => $value){
    //$this->$key = $key;   // <-- this can be enhanced to store an
                          //     object with a whole bunch of meta-data, 
                          //     but you get the idea.
   echo "key " . $key ." value ". $value ."<br>";
}
*/
$dataArray = array();
for($i = 0 ; $i < 5 ; $i++){
    array_push($dataArray , new Reader($i , "name ".$i , ($i + 10)));
}
//echo var_dump($dataArray);
for($i = 0 ; $i < 5 ; $i++){
   $reader = $dataArray[$i]; 
   //$modelo = new Model();
   $mapper = new Mapper($reader, new Model());
   //$mapper->getKeys();
   $modelo = $mapper->mapValues();
   echo var_dump($modelo);
}
?>