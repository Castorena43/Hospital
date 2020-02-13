<template>
    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Especialidad</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="especialidad.nombre" type="text" class="form-control" name="nombre" required id="nombre">
                                        <label class="form-label">Name</label>
                                    </div>
                                </div>                               
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea  v-model="especialidad.descripcion" name="descripcion" cols="30" rows="5" class="form-control no-resize" required id="descripcion"></textarea>
                                        <label class="form-label">Description</label>
                                    </div>
                                </div>
                                
                                <input v-if="editar===false" class="btn btn-primary waves-effect" type="button" v-on:click="EventoGuardar" value="Agregar">
                                <input v-if="editar===true" class="btn btn-success waves-effect" type="button" v-on:click="Actualizar(especialidad.id)" value="Guardar">
                            </form>
                        </div>
                        <div class="body">
                        <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>descripcion</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(elemento,index) in lista" :key="elemento.id">
                                            <td>{{elemento.nombre}}</td>
                                            <td>{{elemento.descripcion}}</td>
                                            <td>
                                            <button type="button" class="btn bg-orange btn-circle waves-effect waves-circle waves-float" v-on:click="Editar(index,elemento.id)">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float" v-on:click="Eliminar(elemento.id,index)">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            </td>
                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            
</template>

<script>
    export default {
        props:["datos"],
        mounted() {
            this.lista = JSON.parse(this.datos)
            console.log(this.lista)
        },
        data(){
            return{
                lista:null,
                especialidad : {
                    nombre:null,
                    descripcion:null,
                    id:null

                },
                editar:false,
                idx:null
            }
            
        }
        ,
         methods:{
            EventoGuardar:function(){
                let bool = this.Verificacion()
                if (bool === true) {
                    let self = this;
                    axios.post("/especialidad/guardar",this.especialidad).then(response=>{
                        console.log(this.especialidad)
                        self.lista.push(response.data.especialidad)
                    })
                    .catch(error=>{
                        console.log(this.especialidad)
                    })
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ingresa todos los datos'
                    })
                }
                
            },
            Eliminar:function(id,idx){
                axios.post('/especialidad/eliminar/'+id).then(response=>{
                    console.log("Exito")
                    this.lista.splice(idx,1)
                    //this.Cargar()
                })
                .catch(error=>{
                    console.log(error)
                })
            },
            Cargar:function(){
                axios.get("/especialidad").then(({data})=>(
                    this.lista=data
           
                ))
            },
            Editar:function(idx,id){
                this.lista.forEach(list => {
                    if(id==list.id)
                    {
                        this.especialidad.nombre=list.nombre
                        this.especialidad.descripcion=list.descripcion
                        this.especialidad.id=id
                        this.editar=true
                        console.log(id)
                        this.idx=idx
                    }
              
                })
            },
            Actualizar:function(id){
                axios.post('/especialidad/editar/'+id,this.especialidad).then(response=>{
                    this.lista[this.idx].nombre=response.data.nombre
                    this.lista[this.idx].descripcion=response.data.descripcion
                    this.editar=false;
                    
                    console.log(response)
                })
                .catch(error=>{
                    console.log(error)
                })
            },
             Verificacion:function(){
                let nombre = document.querySelector('#nombre').value
                let d = document.querySelector('#descripcion').value
                
                if(nombre === "" || d === "" ){
                    return false
                }else{
                    return true
                }
            }
         }
    }
</script>
