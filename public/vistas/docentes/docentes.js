var appdocentes = new Vue({
    el:'#frm-docentes',
    data:{
        docente:{
            idDocente : 0,
            accion    : 'nuevo',
            nombre    : '',
            direccion : '',
            nit       : '',
            msg       : ''
        }
    },
    methods:{
        guardarDocentes(){
            fetch(`private/Modulos/docentes/procesos.php?proceso=recibirDatos&docente=${JSON.stringify(this.docente)}`).then( resp=>resp.json() ).then(resp=>{
                this.docente.msg = resp.msg;
                this.limpiarDocentes();
            });
        },
        limpiarDocentes(){
            this.docente.idDocente=0;
            this.docente.accion="nuevo";
            this.docente.nombre="";
            this.docente.direccion="";
            this.docente.nit="";
            this.docente.msg="";
        }
    }
});