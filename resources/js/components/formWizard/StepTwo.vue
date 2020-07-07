<template>
    <div style="padding: 2rem 3rem; text-align: left;" class="row">
        <!-- <p class="text-center">Usuario</p> -->
        <div class="field col-12">
            <label class="label">Nombre de usuario</label>
            <div class="control">
                <input :class="['input', ($v.form.user.$error) ? 'is-danger' : 'is-valid']" v-model="form.user" type="text" placeholder="Ingrese un nombre de usuario">
            </div>
            <p v-if="!$v.form.user.required" class="help is-danger">Este campo es requerido</p>
            <p v-else-if="!$v.form.user.alpha" class="help is-danger">Este campo no acepta caracteres especiales '*"%$... o espacios en blanco</p>
            <p v-else-if="!$v.form.user.maxLength" class="help is-danger">El nombre de usuario no pueden superar los 20 caracteres</p>
            <p v-else-if="!$v.form.user.minLength" class="help is-danger">El nombre de usuario debe tener más de 6 caracteres</p>
            <p v-else-if="valida" class="help text-green green-text">Validando...</p>
            <p v-else-if="!$v.form.user.found" class="help is-danger">El nombre de usuario ya está siendo utilizado.</p>
            <p v-else class="help">Correcto ✓</p>
        </div>
        <div class="field col-12">
            <label class="label">Contraseña</label>
            <div class="control">
                <input :class="['input', ($v.form.password.$error) ? 'is-danger' : 'is-valid']" v-model="form.password" type="password" placeholder="Ingrese apellidos paternos">
            </div>
            <p v-if="!$v.form.password.required" class="help is-danger">Este campo es requerido</p>
            <p v-else-if="!$v.form.password.alpha" class="help is-danger">no acepta caracteres especiales '*"%$... o espacios en blanco</p>
            <p v-else-if="!$v.form.password.minLength" class="help is-danger">La contraseña debe tener más de 6 caracteres</p>
            <p v-else-if="!$v.form.password.maxLength" class="help is-danger">La contraseña no debe tener más de 50 caracteres</p>
            <p v-else class="help">Correcto ✓</p>
            <!-- <p v-if="$v.form.password.$error" class="help is-danger">Este campo es inválido</p> -->
        </div>
    </div>
</template>

<script>
    import {validationMixin} from 'vuelidate'
    import {required, numeric, maxLength, minLength, email, helpers} from 'vuelidate/lib/validators'
    const alpha = helpers.regex('alpha', /^[a-zA-ZÀ-ÿ0-9\u00f1\u00d1]*$/)

    export default {
        props: ['clickedNext', 'currentStep', 'names','appaterno','apmaterno', 'correo', 'celular'],
        mixins: [validationMixin],
        data() {
            return {
                valida: false,
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
                    alpha,
                    maxLength: maxLength(20),
                    minLength: minLength(6),
                    async found(value) {
                        var alpha =this.$v.form.user.alpha;
                        try {
                            if (value.length >= 6 && value.length <= 20 && alpha){
                                this.valida = true;
                                let res = false;
                                await axios.get(`/api/username/${value}`).then( ({data}) => {
                                    res = !data.message
                                }).finally( () => { this.valida = false;});
                                return res
                            } else return false
                        } catch(e) {return false;}
                    }
                },
                password: {
                    required,
                    alpha,
                    minLength: minLength(6),
                    maxLength: maxLength(50)
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
