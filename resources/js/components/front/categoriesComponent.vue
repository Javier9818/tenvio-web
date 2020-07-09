<template>
  <div class="row">
    <div class="col-lg-3 col-sm-6" v-for="(item, index) of MerchantType" :key="index">
        <div class="single-services services-color-3 text-center mt-30 wow fadeInUpBig" data-wow-duration="1.3s" data-wow-delay="0.2s">
            <div class="services-icon d-flex align-items-center justify-content-center">
              <i :class="item.icon"></i> 
            </div>
            <div class="services-content">
                <h4 class="services-title"><a href="#">{{item.descripcion}}</a></h4>
                <p class="text">{{item.texto}}</p>
            </div>
        </div> <!-- single services -->
    </div> 
    
    
  </div> <!-- row -->
  <!-- <div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
          <div class="menu-wrapper">
            <nav class="nav nav-tabs justify-content-center">
               
              <a :class="(index==0)?'nav__link  active':'nav__link ' " style="font-family: 'Nunito', sans-serif; margin-bottom: 2%" data-toggle="tab" :href="'#tab'+(index+2)"  v-for="(item, index) of MerchantType" :key="index" @click="funcionCategories(item.id)">{{item.descripcion}}</a>
            </nav>
          </div>
        </div>
      </div>
    <div class="row ">
      <div class="col-lg-3 col-md-4  col-6 d-flex justify-content-around" v-for="(item, index) of Categories" :key="index" style="cursor: pointer" @click="redirect(item.descripcion)">
        <div class="card d-flex align-items-center p-5 my-3" style="width: 18rem; width: 250px;
            height: 250px;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            border: 2px solid #ddd;
            border-radius: 10px;
            transition: .5s;
            box-shadow: 0 0 25px 5px rgba(0,0,0,.2)">
            <h5 class="card-title" style="background: linear-gradient(#fe4b7d, #ff8a4d);
                background-clip: border-box;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;"><i :class="'fas fa-'+item.icon+' fa-2x'"></i></h5>
            <p class="card-text text-center" style="font-family: 'Nunito', sans-serif;
            font-size: 24px; 
            font-size: 1.2em;
            color: #656064;
            font-weight: bold;">{{ item.descripcion}}</p>
        </div>
      </div>
    </div>
  </div>  -->
</template>
 
<script>
export default {
  data()
  {
    return{
      MerchantType:[],
      Categories:[]
    }
  },
  methods:{
    
    funcionMerchantType:function () {
      var that = this;
			axios.post('/front/TipoNegocio')
			.then(function (response) {
       that.MerchantType=response.data
			});
    },
    funcionCategories:function (id) {
      var that = this;
			axios.post('/front/CategoriasxNegocio',{id:id})
			.then(function (response) {
        that.Categories=response.data
			});
    },
    redirect: function (params) {
      location.href="/list?search="+params
    }
  },
  mounted(){
    this.funcionMerchantType(); 
  }
}
</script>

<style>

</style>
