<template>
    <div>
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

        <div class="breadcrumb-area breadcrumb-bg extra">
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

        <div class="page-content-area padding-top-120 padding-bottom-120" id="formulario">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                            <div class="single-post-details-item">
                                <div class="entry-content wow fadeInDown">
                                    <h4 class="title">TITULO DEL FORMULARIO</h4>
                                </div>

                                <div class="comment-form-wrap ">
                                    <h3 class="title">_</h3>
                                    <form action="blog-details.html" class="comment-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Name...">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Subject...">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email...">
                                        </div>
                                        <div class="form-group textarea">
                                            <textarea name="message" id="message" class="form-control" placeholder="Message..." cols="30" rows="10"></textarea>
                                        </div>
                                        <button class="submit-btn btn-rounded gd-bg-1" type="submit">Registrar</button>
                                    </form>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {

        },
        methods:{
            back(){
                this.$emit('register');
            }
        }
    }
</script>
