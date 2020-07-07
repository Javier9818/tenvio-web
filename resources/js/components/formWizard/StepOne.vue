<template>
    <div style="padding: 2rem 3rem; text-align: left;" class="row">
        <div class="field col-12">
            <label class="label" >Nombres</label>
            <div class="control">
                <input type="text" v-model="form.names" :class="['input', ($v.form.names.$error) ? 'is-danger' : '']" placeholder="Ingrese  su nombre">
            </div>
            <p v-if="$v.form.names.$error" class="help is-danger">Este campo es inválido</p>
        </div>
        <div class="field col-md-6">
            <label class="label">Ap. Paterno</label>
            <div class="control">
                <input  type="text" v-model="form.appaterno" :class="['input', ($v.form.appaterno.$error) ? 'is-danger' : '']" placeholder="Ingrese su apellido paterno">
            </div>
            <p v-if="$v.form.appaterno.$error" class="help is-danger">Este campo es inválido</p>
        </div>
        <div class="field col-md-6">
            <label class="label">Ap. Materno</label>
            <div class="control">
                <input  type="text" v-model="form.apmaterno" :class="['input', ($v.form.apmaterno.$error) ? 'is-danger' : '']" placeholder="Ingrese su apellido materno">
            </div>
            <p v-if="$v.form.apmaterno.$error" class="help is-danger">Este campo es inválido</p>
        </div>
        <div class="field col-12">
            <label class="label">Email</label>
            <div class="control">
                <input type="email" v-model="form.correo" :class="['input', ($v.form.correo.$error) ? 'is-danger' : '']"  placeholder="Ingrese su correo electrónico" >
            </div>
            <p v-if="!$v.form.correo.required" class="help is-danger">Este campo es requerido</p>
            <p v-else-if="!$v.form.correo.email" class="help is-danger">Este campo es inválido</p>
            <p v-else-if="valida" class="help text-green green-text">Validando...</p>
            <p v-else-if="!$v.form.correo.found" class="help is-danger">El correo electrónico ingresado está siendo utilizado.</p>
            <p v-else class="help">Correcto ✓</p>

        </div>
         <div class="field col-12">
            <label class="label">Celular * </label>
            <div class="control">
                <input type="number" :class="['input', ($v.form.celular.$error) ? 'is-danger' : '']"  placeholder="Ingrese su número de celular" v-model="form.celular">
            </div>
            <p class="ml-1">Su número de celular será utilizado como medio de contácto al realizar un pedido.</p>
            <p v-if="$v.form.celular.$error" class="help is-danger">Este campo es inválido</p>
        </div>


    </div>
</template>

<script>
    import {validationMixin} from 'vuelidate'
    import {required, numeric, minValue, maxValue,email, maxLength, minLength, helpers} from 'vuelidate/lib/validators'
    const nombreText = helpers.regex('alpha', /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]*$/)
    export default {
        props: ['clickedNext', 'currentStep'],
        mixins: [validationMixin],
        data() {
            return {
                valida: false,
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
                    maxLength: maxLength(50),
                    nombreText
                },
                appaterno:{
                    required,
                    maxLength: maxLength(50),
                    nombreText
                },
                apmaterno:{
                    required,
                    maxLength: maxLength(50),
                    nombreText
                },
                celular:{
                    required,
                    maxLength: maxLength(10),
                    minLength: minLength(6)
                },
                correo:{
                    required,
                    email,
                    async found(value) {
                        try {
                            if (/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i.test(value)){
                                this.valida = true;
                                let { data } = await axios.get(`/api/email/${value}`);
                                this.valida = false;
                                return !data.message
                            } else return false
                        } catch(e) {
                        return false;
                        }
                    }
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
                // console.log(val);
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
