<template>
   <div>
    <b-aspect :aspect="3" v-if="!edit">
        <b-img center  :src="form.foto ? '/storage/images/perfilEmpresa/'+form.foto : '/img/imagenDefault.png'" fluid alt="Responsive image"></b-img>
    </b-aspect>
    <picture-input
    v-else
    ref="pictureInput"
    width="1200"
    height="600"
    margin="16"
    accept="image/jpeg,image/png"
    size="10"
    button-class="btn"
    zIndex=1
    :removable="true"
    :custom-strings="{
        upload: '<h1>Bummer!</h1>',
        drag: 'Arrastra una foto o click <br> para actualizar foto',
        change:'Cambiar imagen',
        remove:'Remover imagen',
        tap:'Pulsa aquí para seleccionar una foto <br> desde tu galería'
    }"
    @change="onChange">
    </picture-input>
    <div class="row align-items-center justify-content-center" v-if="scope === 'true'">
        <button class="btn btn-primary btn-sm mt-2" v-on:click="edit=!edit" v-if="!edit"><i class="ft-edit"></i> Actualizar foto</button>
        <button class="btn btn-danger btn-sm mt-2" v-on:click="edit=!edit" v-else>Regresar</button>
    </div>
   </div>
</template>

<script>
    import PictureInput from 'vue-picture-input'
    import Swal from 'sweetalert2'
    export default {
        props:['form', 'scope'],
        mounted() {
        },
        data(){
            return{
                image:'',
                edit:false
            }
        },
        components: {
            PictureInput
        },
        methods: {
            onChange (image) {

                if (image) {

                    this.image = image
                    axios.put(`/api/fotoEmpresa/${this.form.id}`, {image:this.image}).then( ({data}) => {

                        this.form.foto = data.foto;
                        Swal.fire('Éxito', 'La foto se ha actualizado', 'success');
                    }).catch( error => Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error'));
                } else {
                    console.log('FileReader API not supported: use the <form>, Luke!')
                }
            }
        }
    }
</script>
