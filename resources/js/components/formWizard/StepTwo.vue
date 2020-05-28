<template>
    <div style="padding: 2rem 3rem; text-align: left;" class="row">
        <p class="text-center">Usuario</p>
        <div class="field col-12">
            <label class="label">Nombres</label>
            <div class="control">
                <input :class="['input', ($v.form.user.$error) ? 'is-danger' : '']"  type="text" placeholder="Ingrese nombres y apellidos de contacto" v-model="form.namesFamiliar">
            </div>
            <p v-if="$v.form.user.$error" class="help is-danger">Este usuario ya existe o es invalido</p>
        </div>
        <div class="field col-12">
            <label class="label">Contraseña</label>
            <div class="control">
                <input :class="['input', ($v.form.password.$error) ? 'is-danger' : '']"  type="text" placeholder="Ingrese apellidos paternos" v-model="form.appaternoFamiliar">
            </div>
            <p v-if="$v.form.password.$error" class="help is-danger">Este campo es inválido</p>
        </div>
    </div>
</template>

<script>
    import {validationMixin} from 'vuelidate'
    import {required, numeric, maxLength, minLength, email, helpers} from 'vuelidate/lib/validators'
    const alpha = helpers.regex('alpha', /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]*$/)

    export default {
        props: ['clickedNext', 'currentStep', 'names', 'email', 'dni'],
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
                    alpha,
                    maxLength: maxLength(50)
                },
                password: {
                    required,
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
                console.log(val);
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
