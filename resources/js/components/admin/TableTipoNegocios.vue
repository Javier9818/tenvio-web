<template>
    <div> 
      <!--Table Tipo Negocio--> 
      <p>{{buttonEdit(selected)}}</p>
      <div v-if="!view">
          <div class=" text-right">
            <b-button-group>
              <b-button v-for="(item, index) of tableTipo.button" :key="index" :variant="item.color" @click="type(item.function)"><i :class="item.icon"> </i>{{item.text}}</b-button> 
            </b-button-group>
          </div>
            <b-table 
            :items="tableTipo.items" 
            :fields="tableTipo.fields"
            responsive="sm"
            :current-page="tableTipo.currentPage"
            :per-page="tableTipo.perPage"> 
              <template v-slot:cell(id)="row">  
                <b-form-group >               
                  <b-form-radio v-model="selected" name="some-radios" @change="buttonEdit(row.item.id)" :value="row.item.id"> </b-form-radio>   
                </b-form-group> 
              </template>
          </b-table>
          <b-pagination
              v-model="tableTipo.currentPage"
              :total-rows="tableTipo.totalRows"
              :per-page="tableTipo.perPage"
              align="fill"
              size="sm"
              class="my-0"
          ></b-pagination> 
      </div>
      <!--Table Categorias-->
      <div v-if="spinner">
        <b-spinner variant="primary" type="grow" label="Cargando"></b-spinner>
      </div>
      <div v-if="view">
        <div class=" row">
          <div class="col-6 text-left">
            <b-button pill variant="outline-secondary" @click="back"><i class="ft-arrow-left"></i> Regresar</b-button>
          </div>
          <div class="col-6 text-right">
            <b-button-group>
              <b-button v-for="(item, index) of tableCateorgia.button" :key="index" :variant="item.color" @click="type(item.function)"><i :class="item.icon"> </i>{{item.text}}</b-button> 
            </b-button-group>
          </div>
        </div>        
          
          <b-table 
            :items="tableCateorgia.items" 
            :fields="tableCateorgia.fields"
            responsive="sm"
            :current-page="tableCateorgia.currentPage"
            :per-page="tableCateorgia.perPage"> 
              <template v-slot:cell(id)="row">
                <b-form-group > 
                  <b-form-radio v-model="selected" name="some-radios" @change="buttonEdit(row.item)" :value="row.item.id"> </b-form-radio>
                </b-form-group>
              </template>
          </b-table>
          <b-pagination
              v-model="tableCateorgia.currentPage"
              :total-rows="tableCateorgia.totalRows"
              :per-page="tableCateorgia.perPage"
              align="fill"
              size="sm"
              class="my-0"
          ></b-pagination>
          
      </div>
      <b-modal ref="save" hide-footer title="Crear nuevo">
        <div class="d-block text-center">
          <p>Ingrese nuevo item</p>
          <b-form-input v-model="input_value" placeholder="Ingrese nuevo item"></b-form-input>
          <br>
          <b-form-input   v-model="item.icon" placeholder="Ingrese icon font-awesome(solo título)"></b-form-input>
        </div>
        <div class=" text-center">
          <b-button class="mt-2" variant="danger"  @click="hideModal('save')">Cerrar</b-button>
          <b-button class="mt-2" variant="success"  @click="crear">Guardar</b-button>
        </div>
      </b-modal>
      <b-modal ref="edit" hide-footer title="Editar">
        <div class="d-block text-center">
          <p>Editar item</p>
          <b-form-input v-model="item.descripcion" placeholder="Ingrese item"></b-form-input>
          <br>
          <b-form-input   v-model="item.icon" placeholder="Ingrese icon font-awesome(solo título)"></b-form-input>
        </div>
        <div class=" text-center">
          <b-button class="mt-2" variant="danger"  @click="hideModal('edit')">Cerrar</b-button>
          <b-button class="mt-2" variant="success"  @click="editar_CT">Guardar</b-button>
        </div>
      </b-modal>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
  export default {
    data() {
      return {
        tableTipo:
        {
          totalRows: 1,
          currentPage: 1,
          perPage: 5,
          fields: [
            { key: 'id', label: 'Item',sortable: true, sortDirection: 'desc'},
            { key: 'descripcion', label: 'Tipo de Negocio',sortable: true, sortDirection: 'desc'},            
            { key: 'icon', label: 'Icono',sortable: true, sortDirection: 'desc'},
            { key: 'state', label: 'Estado'},
            { key: 'created_at', label: 'Fecha',sortable: true, sortDirection: 'desc'}            
          ],
          items: [], 
          state:0,
          button:[            
            {
            color:'primary',
            text:'Administrar',
            icon:'ft-settings',
            function:'editar'
            },
            {
            color:'info',
            text:'Nuevo',
            icon:'ft-save',
            function:'showModal'
            },
            {
            color:'success',
            text:'Editar',
            icon:'ft-edit',
            function:'editar_CT'
            },
            {
            color:'danger',
            text:'Eliminar',
            icon:'ft-delete',
            function:'eliminar'
            }
          ]
        },
        tableCateorgia:
        {
          totalRows: 1,
          currentPage: 1,
          perPage: 5,
          fields: [
            { key: 'id', label: 'Item',sortable: true, sortDirection: 'desc'},
            { key: 'descripcion', label: 'Tipo de Negocio',sortable: true, sortDirection: 'desc'},
            { key: 'icon', label: 'Icono',sortable: true, sortDirection: 'desc'},
            { key: 'state', label: 'Estado'},
            { key: 'created_at', label: 'Fecha',sortable: true, sortDirection: 'desc'}           
          ],
          items: [], 
          button:[
            {
            color:'info',
            text:'Nuevo',
            icon:'ft-save',
            function:'showModal'
            },
            {
            color:'success',
            text:'Editar',
            icon:'ft-edit',
            function:'editar_CT'
            },
            {
            color:'danger',
            text:'Eliminar',
            icon:'ft-delete',
            function:'eliminar'
            }
          ]
        },
        view:false,
        spinner:true,
        apos:'TP',
        input_value:'',
        input_value2:'',
        selected:'', 
        negocio:'',
        item:{
          icon:'',
          descripcion:'',
          id:0,
          state:'',
          created_at:''
        }
      }
    },
    methods:{
      type (key) {
         switch (key) {
           case 'showModal':
             this.showModal('save')
            break;
          case 'editar':
             this.editar()
            break;
          case 'eliminar':
             this.eliminar()
            break;
          case 'editar_CT':
            this.showModal('edit')
            break;
         
           default:
             break;
         }
      },
      crear(){ 
        if(this.input_value.length<4)
          return;
        let array= (this.view)?this.tableCateorgia:this.tableTipo
        var that = this
        axios.post('/admin/empresa/'+this.apos+'_Save',
        {
          descripcion:this.input_value.toUpperCase(), 
          icon:this.item.icon,
          tipo_negocio_id: this.negocio
        })
        .then(function (response) {
          
          if (response.data.success==0)  
            Swal.fire('ERROR', 'Ha ocurrido un error', 'error')
          else{
            if(response.data.id>0)
            {
              Swal.fire('Éxito', 'Se ha registrado '+that.input_value+'.', 'success')
              array.items.push(
                {
                  icon:(that.view)?response.data.icon:'',
                  descripcion:response.data.descripcion,
                  id:response.data.id,
                  state:(response.data.state==1)?'Habilitado':'Deshabilitado',
                  created_at:response.data.created_at
                }
              ) 
              array.totalRows = array.items.length
            }
               
          } 
        })
        this.hideModal('save')
      },
      editar_CT()
      {
        if(this.item.descripcion.length<4)
          return;
        let array= (this.view)?this.tableCateorgia:this.tableTipo
        var that = this
        axios.post('/admin/empresa/'+this.apos+'_UDP',{
          descripcion:this.item.descripcion.toUpperCase(), 
          icon:this.item.icon,
          id: this.selected
        })
        .then(function (response) {
          
          if (response.data.success==0)  
            Swal.fire('ERROR', 'Ha ocurrido un error', 'error')
          else{
            if(response.data>0)
            {
              Swal.fire('Éxito', 'Se ha actualizado '+that.item.descripcion+'.', 'success')  
              array.items.forEach(element => {
                if (that.selected==element.id) {  
                  element.descripcion=that.item.descripcion.toUpperCase()
                  if (that.view) 
                    element.icon=that.item.icon                      
                }
              });
              array.totalRows = array.items.length
            }
               
          } 
        })
        this.hideModal('edit')
      },
      editar()
      {
        if(this.selected=='')
        {
          Swal.fire('ERROR', 'Seleccione un item', 'error')
          return
        }

        this.apos='CT'
        this.negocio=this.selected
        var that = this
        if(this.selected!='')
          this.view=true  
        axios.post('/admin/empresa/'+this.apos+'_CATEGORIES',{id:this.negocio})
        .then(function(response) {
          that.tableCateorgia.items= response.data
          that.cambio(that.tableCateorgia.items)
          that.tableCateorgia.totalRows = that.tableCateorgia.items.length
        }) 
      },
      eliminar()
      { 
        let array= (this.view)?this.tableCateorgia:this.tableTipo
        let m_state= (this.state==1)?'Habilitado' :'Deshabilitado'
        var that = this
        axios.post('/admin/empresa/'+this.apos+'_DELETE',
        {
          id:this.selected, 
          state:this.state
        })
        .then(function (response) {
          
          if (response.data.success==0)  
            Swal.fire('ERROR', 'Ha ocurrido un error', 'error')
          else{
            if(response.data>0)
            {
              Swal.fire('Éxito', 'Se ha '+m_state+'.', 'success')
              array.items.forEach(element => {
                if (element.id==that.selected) {
                  element.state=m_state
                }
              })
            }
               
          } 
        })
      },
      cambio(array)
      { 
        array.forEach(element => {
          element.state=(element.state==1)? 'Habilitado':'Deshabilitado'
        });         
      },
      showModal(modal) {
        this.$refs[modal].show()
      },
      hideModal(modal) {
        this.$refs[modal].hide()
      },
      buttonEdit(index)
      {   
        
        let array= (this.view)?this.tableCateorgia:this.tableTipo
        array.button[(this.view)?2:3]={
          color:'danger',
          text:'Eliminar',
          icon:'ft-delete',
          function:'eliminar'
        }
        this.state=0 
        array.items.forEach(element => {
          
          if(element.state=='Deshabilitado' && element.id==index)
          { 
            
            this.state=1
            array.button[(this.view)?2:3]={
              color:'warning',
              text:'Habilitar',
              icon:'ft-restore',
              function:'eliminar'
            }
            
          }else if(element.id==index){
            this.item=element
          }
        })
         
      },
      back()
      {
        this.apos='TP'       
        this.view=false 
        this.tableCateorgia.items=[]
        this.selected=''
        this.negocio=''
      }
    },
    mounted(){ 
        this.tableTipo.items = tiponegocios
        this.cambio(this.tableTipo.items)
        this.tableTipo.totalRows = this.tableTipo.items.length
    }
  }
</script>
