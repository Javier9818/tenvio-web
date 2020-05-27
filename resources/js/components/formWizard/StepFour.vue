<template>
    <div style="padding: 2rem 3rem; text-align: left;" class="row">
        <div class="field col-12">
            <b-form-group label="Ocupación laboral">
                <b-form-radio-group id="radio-group-5" v-model="form.ocupacion" name="radio-sub-component">
                    <b-form-radio value="1">Docente</b-form-radio>
                    <b-form-radio value="2">Personal Administrativo</b-form-radio>
                </b-form-radio-group>
            </b-form-group>
            <p v-if="$v.form.ocupacion.$error" class="help is-danger">Este campo es requerido</p>
        </div>
        <div class="field col-12">
            <label for="">Facultad</label>
            <b-form-select
                v-model="form.facultad"
                :options="facultades"
                class="mb-3"
                value-field="id"
                text-field="name"
                disabled-field="notEnabled"
                v-on:change="handleFacultad()"
            ></b-form-select>
            <p v-if="$v.form.facultad.$error" class="help is-danger">Este campo es requerido</p>
        </div>
        <div class="field col-12">
            <label for="">Escuela</label>
            <b-form-select
                v-model="form.escuela"
                :options="escuelas"
                class="mb-3"
                value-field="id"
                text-field="name"
                disabled-field="notEnabled"
            ></b-form-select>
            <p v-if="$v.form.escuela.$error" class="help is-danger">Este campo es requerido</p>
        </div>
    </div>
</template>

<script>
    import {validationMixin} from 'vuelidate'
    import {required, numeric, minValue, maxValue} from 'vuelidate/lib/validators'

    export default {
        props: ['clickedNext', 'currentStep', 'names', 'email', 'dni'],
        mixins: [validationMixin],
        data() {
            return {
                form: {
                    ocupacion:null,
                    escuela:null,
                    facultad:null
                },
                facultades: [{ id:null, name:"Elegir Facultad" }],
                escuelas: [{ id: null, name: '---', disabled:true}],
                dataEscuelasGlobal: []
            }
        },
        validations: {
            form: {
                ocupacion: {
                    required
                },
                escuela:{
                    required
                },
                facultad: {
                    required
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
        methods:{
            handleFacultad(){
                this.escuelas=[{id:null, name:'Elegir Escuela'}];
                this.form.escuela = null
               this.dataEscuelasGlobal.map((escuela) => {
                   if(escuela.facultadId === this.form.facultad && escuela.state) this.escuelas.push(escuela);
               })
            }
        },
        mounted() {
            if(!this.$v.$invalid) {
                this.$emit('can-continue', {value: true});
            } else {
                this.$emit('can-continue', {value: false});
            }

            axios.get('/assets_client/facultades.json').then(({data}) => {
                data.map( async (facultad) => {
                    if(facultad.state) this.facultades.push(facultad);
                });
            });

            axios.get('/assets_client/escuelas.json').then(({data}) => { this.dataEscuelasGlobal = data });
        }
    }
</script>
