<template>
<div>
  <b-input-group class="form-group position-relative has-icon-left">
    <b-input-group-prepend is-text>
      <i class="ft-lock"></i>
    </b-input-group-prepend>
    <b-form-input type="password" @keyup="len"  v-model="form.newpassword" placeholder="Nueva Contraseña" class="form-control round"></b-form-input>
    <!-- <p v-if="$v.form.celular.$error" class="help is-danger">Contraseña muy corta</p> -->
  </b-input-group>
  <b-input-group class="form-group position-relative has-icon-left">
    <b-input-group-prepend is-text>
      <i class="ft-lock"></i>
    </b-input-group-prepend>
    <b-form-input type="password" class="form-control round" v-model="form.newpassword1"  placeholder="Repita Contraseña" required="" aria-invalid="false" autocomplete="off" @keyup="compara" minlength="7"></b-form-input>
  </b-input-group>   
  <div class="form-group row" v-if="view">                                     
      <div class="col-12 text-center">
          <div class="alert alert-danger" role="alert">
              Las contraseñas no son iguales
          </div>
      </div>
  </div>
  <div class="form-group text-center">
      <button @click="enviar" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Guardar</button>
  </div>
</div>
   
</template>

<script>
import Swal from 'sweetalert2'
 import {validationMixin} from 'vuelidate'
  import {required, minLength, helpers} from 'vuelidate/lib/validators'
export default {
  mixins: [validationMixin],
  props:['id'],
  data(){
    return{
      view:false,
      form: {
        newpassword1:'',
        newpassword:''
      }
      
    }
  },
  methods:
  {
    len()
    {
      this.$v.$touch()
      if(this.$v.$invalid)
        console.log(this.$v.$invalid)
      else
        console.log('valido')
    },
    compara() 
    {        
      if (this.form.newpassword1!=this.form.newpassword) 
        this.view=true
      else
        this.view=false 
    },
    enviar() { 
      var that = this
      axios.post('/front/recuperaPost',{pass:that.form.newpassword, user:that.id})
      .then(function (response) {        
        if (response.data.success==0)  
          Swal.fire('ERROR', 'Ha ocurrido un error', 'error')
        else{
          if(response.data==1)
          {
             Swal.fire('Éxito', 'Su cuenta ha sido actualizada', 'success')
             location.href="/"
          }           
          
        } 
      })
      
    } 
  },
  validations: {
    form: {           
      newpassword1:{
        required, 
        minLength: minLength(7)
      },
      newpassword:{
        required, 
        minLength: minLength(7)
      } 
    }
  } 
}
</script>

<style>

</style>