<template>
    <div class="container-fluid">
       <div class="row justify-content-center align-items-center">
           <div class="text-center" v-if="edit === false">
               <span class="avatar avatar-online">
                    <img class="desvanecer" :src="'/storage/images/fotosPerfil/'+(foto || 'perfil.png')" alt="avatar">
                </span>
                <label class="mt-1" style="font-size:1.2em;"><a href="javascript:void(0);" v-on:click="edit=true"><i class="ft-edit"></i>Editar foto</a></label>
           </div>
           <picture-input v-else
                ref="pictureInput"
                width="600"
                height="600"
                margin="0"
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
            <label v-if="edit===true" class="mt-1" style="font-size:1.2em;"><a href="javascript:void(0);" v-on:click="edit=false">Cancelar</a></label>
       </div>
    </div>
</template>

<script>
import PictureInput from 'vue-picture-input'
import Swal from 'sweetalert2'
    export default {
        mounted() {
            console.log('Component mounted.')
            this.foto = user.foto;
            console.log(user);
        },
         data () {
            return {
                edit:false,
                image:'',
                foto:null,
            }
        },
        components: {
            PictureInput
        },
        methods: {
            onChange (image) {
            console.log('New picture selected!')
            if (image) {
                console.log('Picture loaded.')
                this.image = image
                axios.put(`/api/fotoPerfil/${user.id}`, {image:this.image}).then( ({data}) => {
                    console.log(data);
                    this.foto = data.foto;
                    Swal.fire('Éxito', 'La foto se ha actualizado', 'success').then(data => { this.edit=false });
                }).catch( error => Swal.fire('Error', 'Ha sucedido un error, por favor, comuniquese con el área de sistemas', 'error'));
            } else {
                console.log('FileReader API not supported: use the <form>, Luke!')
            }
            }
        }
    }
</script>

<style scoped>
    .avatar{
        width: 80%;
    }
</style>
