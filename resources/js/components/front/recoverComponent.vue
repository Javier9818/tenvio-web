<template>
  
  <div>
    <a style="cursor:pointer" class="card-link" @click="showModal">Olvidaste tu contraseña?</a>
    <b-modal ref="my-modal" hide-footer title="Recuperar contraseña"   centered  content-class="shadow" style="background-color:#0000009e," >
    <div class="d-block text-center">
        <p class=" text-center">Nombre de usuario o email</p>
      <b-form-input  placeholder="Nombre de usuario o email" v-model="username"></b-form-input>      
    </div>
    <div class=" text-center">
      <b-button class="mt-2" variant="success"   @click="enviar">Enviar</b-button>
      <b-button class="mt-2" variant="danger"   @click="hideModal">Cerrar</b-button>
    </div>
    
  </b-modal>
  </div>
</template>

<script>
import Swal from 'sweetalert2'
export default {
  data(){
    return{
      username:''
    }
  },
  methods: {
    showModal() {
      this.$refs['my-modal'].show()
    },
    hideModal() {
      this.$refs['my-modal'].hide()
    },
    enviar() {
      var that = this
      axios.post('/front/recupera',{user:this.username})
      .then(function (response) {
          console.log(response.data);
        if (!response.data.success)  
          Swal.fire('ERROR', 'Ha ocurrido un error', 'error')
        else{
          if(response.data)
            Swal.fire('Éxito', 'Se ha generado su solicitud, revise su correo por favor.', 'success')
          else
            Swal.fire('No encontrado', 'El usuario no existe', 'warning')
        } 
      })
      this.hideModal()
    } 
  }
}
</script>

<style>

</style>