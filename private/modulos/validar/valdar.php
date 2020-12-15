<?php 
include('../../config/config.php');   //conexion con la DB
$usuario = new usuario($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$usuario->$proceso( $_GET['correo'],$_GET['password'] );
print_r(json_encode($usuario->respuesta));

class usuario{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }

    //obtenemos los datos
    public function recibirDatos($correo,$password){
        $this->correo=$correo;
        $this->password=$password;
        $this->validar_datos();
    }

    //funcion que nos permite la validacion de los datos que enviamos a la DB
    private function validar_datos(){
        
        if( empty($this->password) ){
            $this->respuesta['msg'] = 'por favor ingrese su contraseña';
        }
        if( empty($this->correo) ){
            $this->respuesta['msg'] = 'por favor ingrese el correo ';
        }
        $this->login1();
    }
    //funcion del login
    private function login1(){
       
        if( $this->respuesta['msg']==='correcto' ){

            //consulta sql
            $this->db->consultas('
            SELECT*FROM usuarior WHERE                     
                 contraseña  = "'. $this->password .'" and
                 correo   = "'. $this->correo .'"
         ');
         $consulta=$this->db->obtener_datos();   //funcion para obtener datos desde la DB
         if(count($consulta)>=1){
            $this->respuesta['msg'] = true;
         }else{
            $this->respuesta['msg'] = false;
         }
        }
    }
    public function buscarUsuario($valor=''){
        $this->db->consultas('
                       
            select usuario.idUsuario,usuario.nombre, usuario.contraseña, usuario.correo,usuario.genero
            from usuario
            where  usuario.nombre like "%'.$valor.'%" 
        ');
        return $this->respuesta = $this->db->obtener_datos();
    }
    public function eliminarUsuario($idUsuario=''){
        $this->db->consultas('
            delete usuario
            from usuario
            where usuario.idUsuario = "'.$idUsuario.'"
        ');
        $this->respuesta['msg'] = 'Registro eliminado correctamente';
    }
}
?>