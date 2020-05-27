<template>
    <div style="padding: 2rem 3rem; text-align: left;" class="row">
        <p class="text-center">Datos de familiar de contacto que viva con usted, en caso de urgencia</p>
        <div class="field col-12">
            <label class="label">Nombres</label>
            <div class="control">
                <input :class="['input', ($v.form.namesFamiliar.$error) ? 'is-danger' : '']"  type="text" placeholder="Ingrese nombres y apellidos de contacto" v-model="form.namesFamiliar">
            </div>
            <p v-if="$v.form.namesFamiliar.$error" class="help is-danger">Este campo es inválido</p>
        </div>
        <div class="field col-12 col-md-6">
            <label class="label">Apellido paterno</label>
            <div class="control">
                <input :class="['input', ($v.form.appaternoFamiliar.$error) ? 'is-danger' : '']"  type="text" placeholder="Ingrese apellidos paternos" v-model="form.appaternoFamiliar">
            </div>
            <p v-if="$v.form.appaternoFamiliar.$error" class="help is-danger">Este campo es inválido</p>
        </div>
        <div class="field col-12 col-md-6">
            <label class="label">Apellido materno</label>
            <div class="control">
                <input :class="['input', ($v.form.apmaternoFamiliar.$error) ? 'is-danger' : '']"  type="text" placeholder="Ingrese apellidos maternos" v-model="form.apmaternoFamiliar">
            </div>
            <p v-if="$v.form.apmaternoFamiliar.$error" class="help is-danger">Este campo es inválido</p>
        </div>
        <div class="field col-12">
            <label class="label">Número de celular de contacto</label>
            <div class="control">
                <input :class="['input', ($v.form.celFamiliar.$error) ? 'is-danger' : '']"  type="text" class="input" placeholder="Ingrese número de celular de contácto" v-model="form.celFamiliar">
            </div>
            <p v-if="$v.form.celFamiliar.$error" class="help is-danger">Este campo es inválido</p>
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
                    namesFamiliar:'',
                    appaternoFamiliar:'',
                    apmaternoFamiliar:'',
                    celFamiliar:''
                }
            }
        },
        validations: {
            form: {
                namesFamiliar: {
                    required,
                    alpha,
                    maxLength: maxLength(50)
                },
                appaternoFamiliar: {
                    required,
                    alpha,
                    maxLength: maxLength(50)
                },
                apmaternoFamiliar: {
                    required,
                    alpha,
                    maxLength: maxLength(50)
                },
                celFamiliar:{
                    required,
                    numeric,
                    maxLength:maxLength(12),
                    minLength: minLength(6)
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
