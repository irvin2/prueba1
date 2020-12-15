<?php 
include('../../Config/Config.php');
$docente = new docente($conexion);

$proceso = 'recibirDatos';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
if($proceso == "recibirDatos"){
    $docente->recibirDatos( $_POST['nombre'], $_POST['precio'], $_POST['descripcion'], $_FILES['imagen']);

}else{
    $docente->$proceso();
}

print_r(json_encode($docente->respuesta));

class docente{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($nombre, $precio, $descripcion, $imagen){
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;

        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->descripcion) ){
            $this->respuesta['msg'] = 'por favor ingrese el una descripcion del producto';
        }
        if( empty($this->nombre) ){
            $this->respuesta['msg'] = 'por favor ingrese el nombre del producto';
        }
        if( empty($this->precio) ){
            $this->respuesta['msg'] = 'por favor ingrese el precio del producto';
        }
        if( $this->imagen['error'] === 4 ){
            $this->respuesta['msg'] = 'por favor ingrese imagen del producto';
        }
        $this->almacenar_docente();
    }
    private function almacenar_docente(){
        if( $this->respuesta['msg']==='correcto' ){
            $imagenBlob =addslashes(file_get_contents($this->imagen['tmp_name']));
            $this->db->consultas('
               INSERT INTO producto (nombre, precio, descripcion, imagen) VALUES(
                   
               "'. $this->nombre.'",
               "'. $this->precio .'",         
               "'. $this->descripcion .'",
               "'. $imagenBlob .'"
           
            
            )
            ');
             $this->respuesta['msg'] = 'Registro insertado correctamente';
            
        }
    }

    
    public function buscarDocente(){

        

        $this->db->consultas('SELECT nombre, precio, descripcion FROM producto WHERE producto.idDocente="'.$idDocente.'"');
        return$this->respuesta = $this->db->obtener_datos();

    }

    public function eliminarDocente($idDocente = 0){
        $this->db->consultas('
            DELETE producto
            FROM producto
            WHERE producto.idDocente="'.$idDocente.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>