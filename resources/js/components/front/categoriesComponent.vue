<template>
  <div class="row">
    <div class="col-lg-4 col-sm-6" v-for="(item, index) of MerchantType" :key="index">
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
  </div> 
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
