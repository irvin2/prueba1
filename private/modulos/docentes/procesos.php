<?php 
include('../../Config/Config.php');
$docente = new docente($conexion);

$proceso = '';
if( isset($_GET['proceso']) && strlen($_GET['proceso'])>0 ){
	$proceso = $_GET['proceso'];
}
$docente->$proceso( $_GET['docente'] );
print_r(json_encode($docente->respuesta));

class docente{
    private $datos = array(), $db;
    public $respuesta = ['msg'=>'correcto'];
    
    public function __construct($db){
        $this->db=$db;
    }
    public function recibirDatos($docente){
        $this->datos = json_decode($docente, true);
        $this->validar_datos();
    }
    private function validar_datos(){
        if( empty($this->datos['nit']) ){
            $this->respuesta['msg'] = 'por favor ingrese el una descripcion del producto';
        }
        if( empty($this->datos['nombre']) ){
            $this->respuesta['msg'] = 'por favor ingrese el nombre del producto';
        }
        if( empty($this->datos['direccion']) ){
            $this->respuesta['msg'] = 'por favor ingrese el precio del producto';
        }
        $this->almacenar_docente();
    }
    private function almacenar_docente(){
        if( $this->respuesta['msg']==='correcto' ){
            if( $this->datos['accion']==='nuevo' ){
                $this->db->consultas('
                    INSERT INTO poruducto (nombre, direccion, nit) VALUES(
                        
                        "'. $this->datos['nombre'] .'",
                        "'. $this->datos['direccion'] .'",         
                        "'. $this->datos['nit'] .'"
                    )
                ');
                $this->respuesta['msg'] = 'Registro insertado correctamente';
            } else if( $this->datos['accion']==='modificar' ){
                $this->db->consultas('
                    UPDATE poruducto SET
                        nombre      = "'. $this->datos['nombre'] .'",
                        direccion   = "'. $this->datos['direccion'] .'",
                        nit         = "'. $this->datos['nit'] .'"
                    WHERE idDocente = "'. $this->datos['idDocente'] .'"
                ');
                $this->respuesta['msg'] = 'Registro actualizado correctamente';
            }
        }
    }
    public function buscarDocente($valor = ''){
        $this->db->consultas('
            select docentes.idDocente, docentes.nombre, docentes.direccion,  docentes.nit
            from poruducto
            where docentes.nombre like "%'. $valor .'%" or docentes.direccion like "%'.  $valor .'%" or docentes.nit like "%'. $valor .'%"

        ');
        return $this->respuesta = $this->db->obtener_data();
    }
    public function eliminarDocente($idDocente = 0){
        $this->db->consultas('
            DELETE poruducto
            FROM poruducto
            WHERE docentes.idDocente="'.$idDocente.'"
        ');
        return $this->respuesta['msg'] = 'Registro eliminado correctamente';;
    }
}
?>