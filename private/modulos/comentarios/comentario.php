<?php 
include('../../config/config.php');
$usuario = new usuario($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$usuario->$proceso( $_GET['usuario'] );
print_r(json_encode($usuario->respuesta));

class usuario{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($usuario){
        $this->datos = json_decode($usuario, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['Nombre']) ){
            $this->respuesta['msg'] = 'por favor ingrese el nombre del Usuario';
        }
        if( empty($this->datos['mensaje']) ){
            $this->respuesta['msg'] = 'por favor ingrese su contraseña';
        }
        if( empty($this->datos['email']) ){
            $this->respuesta['msg'] = 'por favor ingrese el correo ';
        }
        $this->almacenar_usuario();
    }
    private function almacenar_usuario(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO  sugerencias (nombre,sugerencia,correo) VALUES(
                     
                        "'. $this->datos['Nombre'] .'",
                        "'. $this->datos['mensaje'] .'",
                        "'. $this->datos['email'] .'"
                    )
                    
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                   UPDATE usuario SET                     
                        nombre     = "'. $this->datos['nombre'] .'",
                        contraseña  = "'. $this->datos['contraseña'] .'",
                        correo   = "'. $this->datos['correo'] .'",
                    WHERE idUsuario = "'. $this->datos['idUsuario'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarUsuario($valor=''){
        $this->db->consultas('
                       
           select*from sugerencias 
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