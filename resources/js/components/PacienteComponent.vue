<template>
    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Pacientes</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="paciente.nombre" type="text" class="form-control" name="nombre" required id="nombre">
                                        <label class="form-label">Nombre</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="paciente.apellido_paterno" type="text" class="form-control" name="nombre" required id="ap">
                                        <label class="form-label">Apellido Paterno</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="paciente.apellido_materno" type="text" class="form-control" name="nombre" required id="am">
                                        <label class="form-label">Apellido Materno</label>
                                    </div>
                                </div>    
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="paciente.nss" type="text" class="form-control" name="nombre" required id="nss">
                                        <label class="form-label">NSS</label>
                                    </div>
                                </div> 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="paciente.direccion" type="text" class="form-control" name="nombre" required id="direccion">
                                        <label class="form-label">Direccion</label>
                                    </div>
                                </div>         
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="paciente.telefono" type="text" class="form-control" name="nombre" required id="telefono">
                                        <label class="form-label">telefono</label>
                                    </div>
                                </div>                 
                                
                                
                                <input v-if="editar===false" class="btn btn-primary waves-effect" type="button" v-on:click="EventoGuardar()" value="Agregar">
                                <input v-if="editar===true" class="btn btn-success waves-effect" type="button" v-on:click="Actualizar(paciente.id)" value="Guardar">
                            </form>
                        </div>
                        <div class="body">
                        <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>NSS</th>
                                            <th>Direccion</th>
                                            <th>Telefono</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(elemento,index) in lista" :key="elemento.id">
                                            <td>{{elemento.nombre}}</td>
                                            <td>{{elemento.apellido_paterno}}</td>
                                            <td>{{elemento.apellido_materno}}</td>
                                            <td>{{elemento.nss}}</td>
                                            <td>{{elemento.direccion}}</td>
                                            <td>{{elemento.telefono}}</td>
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
                paciente : {
                    nombre:null,
                    apellido_paterno:null,
                    apellido_materno:null,
                    nss:null,
                    direccion:null,
                    telefono:null,
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
                if(bool === true){
                    let self = this;
                    axios.post("/paciente/guardar",this.paciente).then(response=>{
                        console.log(response)
                        self.lista.push(response.data.paciente)
                    })
                    .catch(error=>{
                        console.log(error)
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
                axios.post('/paciente/eliminar/'+id).then(response=>{
                    console.log("Exito")
                    this.lista.splice(idx,1)
                    
                })
                .catch(error=>{
                    console.log(error)
                })
            },
            Cargar:function(){
                axios.get("/paciente").then(({data})=>(
                    this.lista=data
           
                ))
            },
            Editar:function(idx,id){
                this.lista.forEach(list => {
                    if(id==list.id)
                    {
                        this.paciente.nombre=list.nombre
                        this.paciente.apellido_paterno=list.apellido_paterno
                        this.paciente.apellido_materno=list.apellido_materno
                        this.paciente.nss=list.nss
                        this.paciente.direccion=list.direccion
                        this.paciente.telefono=list.telefono
                        this.paciente.id=id
                        this.editar=true
                        console.log(id)
                        this.idx=idx
                    }
              
                })
            },
            Actualizar:function(id){
                axios.post('/paciente/editar/'+id,this.paciente).then(response=>{
                    this.lista[this.idx].nombre=response.data.nombre
                    this.lista[this.idx].apellido_paterno=response.data.apellido_paterno
                    this.lista[this.idx].apellido_materno=response.data.apellido_materno
                    this.lista[this.idx].nss=response.data.nss
                    this.lista[this.idx].direccion=response.data.direccion
                    this.lista[this.idx].telefono=response.data.telefono
                    this.editar=false;
                    
                    console.log(response)
                })
                .catch(error=>{
                    console.log(error)
                })
            },
            Verificacion:function(){
                let nombre = document.querySelector('#nombre').value
                let ap = document.querySelector('#ap').value
                let am = document.querySelector('#am').value
                let d = document.querySelector('#direccion').value
                let t = document.querySelector('#telefono').value
                let nss = document.querySelector('#nss').value
                if(nombre === "" || ap === "" || am === "" || d === "" || t === "" || nss === ""){
                    return false
                }else{
                    return true
                }
            }
         }
    }
</script>
