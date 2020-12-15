var appdocentes = new Vue({
    el: '#frm-docentes',
    data: {
        docente: {
            idDocente: 0,
            accion: 'nuevo',
            nombre: '',
            precio: '',
            descripcion: '',
            imagen: ''

        }
    },
    methods: {
        guardarDocentes() {

            /**let data=this.docente
            var sendData={
                proceso:"recibirDatos",
                docente:{
                    nombre:data.nombre,
                    precio:data.precio,
                    descripcion:data.descripcion,
                    imagen:data.imagen
                }
                
            }
            console.log(sendData);
            fetch(`private/Modulos/docentes/procesos.php`,{
                method:"POST",
                body:JSON.stringify(this.docente)
                
            }).then(resp => resp.json()).then(resp => {
                console.log(resp);
            })
            console.log(JSON.stringify(this.docente));**/
            var formData = new FormData(document.getElementById("frm-docentes"));
            $.ajax({
                url: "private/Modulos/docentes/procesos.php",
                type: "POST",
                dataType: "HTML",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function (echo) {
                console.log(echo);
            });

        },
        limpiarDocentes() {
            this.docente.idDocente = 0;
            this.docente.accion = "nuevo";
            this.docente.nombre = "";
            this.docente.direccion = "";
            this.docente.nit = "";
            this.docente.msg = "";
            console.log("xdxdxd");
        },
        obtenerImagen(input) {

            if (input.target.files && input.target.files[0]) {
                const el = this
                var reader = new FileReader();
                reader.onload = function (e) {
                    //$('#blah').attr('src', e.target.result); // Renderizamos la imagen
                    el.docente.imagen = e.target.result
                }
                reader.readAsDataURL(input.target.files[0]);
            }
        }
    }


});
