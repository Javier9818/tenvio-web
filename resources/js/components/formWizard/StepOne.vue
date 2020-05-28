<template>
    <div style="padding: 2rem 3rem; text-align: left;" class="row">
        <div class="field col-12">
            <label class="label" >Nombres {{form.names}}</label>
            <div class="control">
                <input type="text" v-model="form.names" :class="['input', ($v.form.names.$error) ? 'is-danger' : '']" placeholder="Ingrese  su nombre">
            </div>
        </div>
        <div class="field col-md-6">
            <label class="label">Ap. Paterno  {{form.appaterno}}</label>
            <div class="control">
                <input  type="text" v-model="form.appaterno" :class="['input', ($v.form.appaterno.$error) ? 'is-danger' : '']" placeholder="Ingrese su apellido paterno">
            </div>
        </div>
        <div class="field col-md-6">
            <label class="label">Ap. Materno  {{form.apmaterno}}</label>
            <div class="control">
                <input  type="text" v-model="form.apmaterno" :class="['input', ($v.form.apmaterno.$error) ? 'is-danger' : '']" placeholder="Ingrese su apellido materno">
            </div>
        </div>
        <div class="field col-12">
            <label class="label">Email {{form.correo}}</label>
            <div class="control">
                <input type="email" v-model="form.correo" :class="['input', ($v.form.correo.$error) ? 'is-danger' : '']"  placeholder="Ingrese su correo electrónico" >
            </div>
        </div>
         <div class="field col-12">
            <label class="label">Celular</label>
            <div class="control">
                <input type="number" :class="['input', ($v.form.celular.$error) ? 'is-danger' : '']"  placeholder="Ingrese su número de celular" v-model="form.celular">
            </div>
            <p v-if="$v.form.celular.$error" class="help is-danger">Este campo es inválido</p>
        </div>


    </div>
</template>

<script>
    import {validationMixin} from 'vuelidate'
    import {required, numeric, minValue, maxValue,email, maxLength, minLength} from 'vuelidate/lib/validators'

    export default {
        props: ['clickedNext', 'currentStep'],
        mixins: [validationMixin],
        data() {
            return {
                //nameComplete : ``,
                form: {
                    names: '',
                    appaterno: '',
                    apmaterno: '',
                    correo: '',
                    celular:''
                }
            }
        },
        validations: {
            form: {
                names:{
                    required,
                    maxLength: maxLength(50)
                },
                appaterno:{
                    required,
                    maxLength: maxLength(50)
                },
                apmaterno:{
                    required,
                    maxLength: maxLength(50)
                },
                celular:{
                    required,
                    maxLength: maxLength(10),
                    minLength: minLength(6)
                },
                correo:{
                    required,
                    email
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
