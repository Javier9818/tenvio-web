<template>
    <div style="padding: 2rem 3rem; text-align: left;" class="row">
        <!-- <p class="text-center">Usuario</p> -->
        <div class="field col-12">
            <label class="label">Nombre de usuario</label>
            <div class="control">
                <input :class="['input', ($v.form.user.$error) ? 'is-danger' : '']" v-model="form.user" type="text" placeholder="Ingrese un nombre de usuario">
            </div>
            <p v-if="!$v.form.user.required" class="help is-danger">Este campo es requerido</p>
            <p v-if="!$v.form.user.maxLength" class="help is-danger">El nombre de usuario no pueden superar los 20 caracteres</p>
            <p v-if="$v.form.user.required && !$v.form.user.minLength" class="help is-danger">El nombre de usuario debe tener más de 6 caracteres</p>
            <p v-if="$v.form.user.maxLength && $v.form.user.minLength && $v.form.user.required && !$v.form.user.found" class="help is-danger">El nombre de usuario ya está siendo utilizado.</p>
        </div>
        <div class="field col-12">
            <label class="label">Contraseña</label>
            <div class="control">
                <input :class="['input', ($v.form.password.$error) ? 'is-danger' : '']" v-model="form.password" type="password" placeholder="Ingrese apellidos paternos">
            </div>
            <p v-if="$v.form.password.$error" class="help is-danger">Este campo es inválido</p>
             <p v-if="!$v.form.password.maxLength" class="help is-danger">La contraseña no pueden superar los 18 caracteres</p>
            <p v-if="$v.form.password.required && !$v.form.password.minLength" class="help is-danger">La contraseña debe tener más de 7 caracteres</p>
            
        </div> 
    </div>
</template>

<script>
    import {validationMixin} from 'vuelidate'
    import {required, numeric, maxLength, minLength, email, helpers} from 'vuelidate/lib/validators'
    const alpha = helpers.regex('alpha', /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]*$/)

    export default {
        props: ['clickedNext', 'currentStep', 'names','appaterno','apmaterno', 'correo', 'celular'],
        mixins: [validationMixin],
        data() {
            return {
                form: {
                    user:'',
                    password:''
                }
            }
        },        
        validations: {
            form: {
                user: {
                    required,
                    maxLength: maxLength(20),
                    minLength: minLength(6),
                    async found(value) {
                        try {
                            if (value.length >= 6 && value.length <= 20){
                                let { data } = await axios.get(`/api/username/${value}`);
                                return !data.message
                            } else return false
                        } catch(e) {
                        return false;
                        }
                    }, 
                    async isUnique(value) 
                    { 
                        if ((/^[ñA-Za-z _]*[ñA-Za-z][ñA-Za-z _]*$/.test(value)) || (/^[0-9]+$/.test(value))) return true 
                    }
                },
                password: {
                    required,
                    maxLength: maxLength(18),
                    minLength: minLength(7)
                }
            }
        },
        watch: {
            $v: {
                handler: function (val) {
                    if(!val.$invalid) {
                        this.$emit('can-continue', {value: true, data: this.form});
                    } else {
                        this.$emit('can-continue', {value: false});
                        setTimeout(()=> {
                            this.$emit('change-next', {nextBtnValue: false});
                        }, 3000)
                    }
                },
                deep: true
            },

            clickedNext(val) {

                if(val === true) {
                    this.$v.form.$touch();
                }
            }
        },
        mounted() {
            if(!this.$v.$invalid) {
                this.$emit('can-continue', {value: true});
            } else {
                this.$emit('can-continue', {value: false});
            }
        }
    }
</script>
