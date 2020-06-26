<template>
    <div class>
        <nav class="navbar navbar-area navbar-expand-lg nav-absolute white nav-style-01 header-style-09">
            <div class="container nav-container">
                <div class="responsive-mobile-menu">
                    <div class="logo-wrapper wow fadeInRight">
                        <a href="javascript:void(0)" class="logo" title="Regresar" @click="back"><i class="fas fa-arrow-left fa-3x mr-3 text-white "></i></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#appside_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="appside_main_menu">
                    <ul class="navbar-nav">
                        <li class="current-menu-item">
                            <a href="javascript:void(0)" @click="back">Inicio</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="breadcrumb-area breadcrumb-bg extra" v-if="!complete">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-inner wow fadeInUp">
                            <h1 class="page-title">Registre su negocio <a href="#formulario"><i class="fas fa-arrow-circle-down text-white"></i></a></h1>
                            <ul class="page-navigation">
                                <li>Complete el formulario, validaremos su información, y nos pondremos en contácto con usted.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="complete-bg" v-else>
            <div class="container" style="height:100%">
               <div class="row align-items-end" style="height:100%">
                    <div class="col-12">
                        <p class="complete-text mb-5">Muchas gracias por completar su registro, nos pondremos en contácto brevemente</p>
                    </div>
               </div>
            </div>
        </div>

        <!-- <img src="/assets/images/landing_pages/bg/bg-register-complete.png" alt=""> -->

        <div class="page-content-area padding-top-120 padding-bottom-120" id="formulario" v-if="!complete">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="single-post-details-item">
                                <div class="entry-content wow fadeInDown">
                                    <h4 class="title">Formulario de registro</h4>
                                </div>
                                <div class="comment-form-wrap">
                                    <h3 class="title">_</h3>
                                    <formempresa promo="true" @complete="completeFunction"></formempresa>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import formempresa from'../admin/FormEmpresas'
import 'vue-search-select/dist/VueSearchSelect.css'
    export default {
        mounted() {

        },
        data(){
            return{
                complete: false
            }
        },
        methods:{
            back(){
                this.$emit('register');
            },
            completeFunction(){
                this.complete = true;
                window.scroll({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
            }
        },
        components:{
            formempresa
        }
    }
</script>

<style scoped>
    .complete-text{
        font-size: 1.5em;
        color: white;
        text-align: center;
    }
</style>
