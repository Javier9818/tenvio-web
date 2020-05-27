<template>
    <div style="padding: 2rem 3rem; text-align: left;" class="row">
        <div class="field col-12 col-md-6">
            <b-form-group label="Seguro de salud">
                <b-form-radio-group id="radio-group-2" v-model="form.seguroSalud" name="radio-sub-component2">
                    <b-form-radio value="1">SIS</b-form-radio>
                    <b-form-radio value="2">EsSalud</b-form-radio>
                    <b-form-radio value="3">Otro</b-form-radio>
                </b-form-radio-group>
            </b-form-group>
            <p v-if="$v.form.seguroSalud.$error" class="help is-danger">Este campo es requerido</p>
        </div>
        <div class="field col-12 col-md-6">
            <label >Centro de salud cercano</label>
            <div class="control">
                <input :class="['input', ($v.form.centroSalud.$error) ? 'is-danger' : '']"  type="text" class="input" placeholder="Ingrese su centro de salud cercano" v-model="form.centroSalud">
            </div>
            <p v-if="$v.form.centroSalud.$error" class="help is-danger">Este campo es inválido</p>
        </div>
        <div class="field col-12">
            <label >Enfermedades</label>
            <vue-multiselect
                v-model="form.enfermedades"
                placeholder="Buscar"
                label="name"
                track-by="code"
                :options="options"
                :multiple="true"
                :taggable="true"
                @tag="addTag">
            </vue-multiselect>
        </div>
        <div class="field col-12 col-md-6">
            <b-form-group label="¿Sigue algún tratamiento?">
                <b-form-radio-group id="radio-group-3" v-model="form.tratamiento">
                    <b-form-radio value="si">Si</b-form-radio>
                    <b-form-radio value="no">No</b-form-radio>
                </b-form-radio-group>
            </b-form-group>
            <p v-if="$v.form.tratamiento.$error" class="help is-danger">Este campo es requerido</p>
        </div>
        <div class="field col-md-12" v-if="form.tratamiento==='si'">
            <label for="">Especifique el tratamiento</label>
            <textarea cols="30" rows="5" class="input" v-model="form.especificacion"></textarea>
            <p v-if="$v.form.especificacion.$error" class="help is-danger">Este solo puede contener 150 caracteres</p>
        </div>
    </div>
</template>

<script>
    import {validationMixin} from 'vuelidate'
    import {required, numeric, maxLength, requiredIf, helpers, not } from 'vuelidate/lib/validators'
    const alpha = helpers.regex('alpha', /^[a-zA-ZÀ-ÿ\u00f1\u00d10-9\s]*$/)
    const characters = helpers.regex('characters', /^(\s*[.|s|\-|_|{|}|*|´|,|;|:|?|¡|¿|!|+|´|']*)+$/)

    export default {
        props: ['clickedNext', 'currentStep', 'names', 'email', 'dni'],
        mixins: [validationMixin],
        data() {
            return {
                form: {
                    seguroSalud:'',
                    centroSalud:'',
                    enfermedades:[],
                    tratamiento:null,
                    especificacion:''
                },
                options: [
                    {code:1, name: "Diabetes Mellitus"},
                    {code:2, name: "Asma"},
                    {code:3, name: "Enfermedad pulmonar crónica"},
                    {code:4, name: "Obesidad o sobrepeso"},
                    {code:5, name: "Hipertensión arterial"},
                    {code:6, name: "Cáncer con quimioterapia"},
                    {code:7, name: "Cáncer sin quimioterapia"},
                    {code:8, name: "Enfermedades cardiovasculares"},
                    {code:9, name: "Insuficiencia renal crónica"},
                    {code:10, name: "Enfermedad reumatológica con uso continuo de antinflamatorios /corticoides"},
                    {code:11, name: "Uso permanente de antinflamatorios o corticoides por otras causas"}
                ],
            }
        },
        validations: {
            form: {
                seguroSalud: {
                    required
                },
                centroSalud:{
                    required,
                    alpha,
                    maxLength: maxLength(50)
                },
                tratamiento:{
                    required
                },
                especificacion:{
                    required:  requiredIf(function(form){
                        return form.tratamiento === 'si' ? true : false;
                    }),
                    maxLength: maxLength(200)
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
            addTag (newTag) {
            const tag = {
                name: newTag,
                code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            }
            this.options.push(tag)
            this.value.push(tag)
            },
            handleTratamiento () {
                alert(this.form.tratamiento)
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
