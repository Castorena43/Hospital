<template>
    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Doctores</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="doctor.nombre" type="text" class="form-control" name="nombre" required id="nombre">
                                        <label class="form-label">Nombre</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="doctor.apellido_paterno" type="text" class="form-control" name="nombre" required id="ap">
                                        <label class="form-label">Apellido Paterno</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="doctor.apellido_materno" type="text" class="form-control" name="nombre" required id="am">
                                        <label class="form-label">Apellido Materno</label>
                                    </div>
                                </div>    
                                
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="doctor.direccion" type="text" class="form-control" name="nombre" required id="direccion">
                                        <label class="form-label">Direccion</label>
                                    </div>
                                </div>         
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="doctor.telefono" type="text" class="form-control" name="nombre" required id="telefono">
                                        <label class="form-label">telefono</label>
                                    </div>
                                </div>      
                                <div class="col-md-12">
                                    <select class="form-control show-tick" id="especialidad" >
                                        <option value="">-- Please select --</option>
                                        <option v-for="(elemento) in listaesp" :key="elemento.id" :value="elemento.id" >{{elemento.nombre}}</option>
                                        
                                    </select>
                                </div>           
                                
                                
                                <input v-if="editar===false" class="btn btn-primary waves-effect" type="button" v-on:click="EventoGuardar()" value="Agregar">
                                <input v-if="editar===true" class="btn btn-success waves-effect" type="button" v-on:click="Actualizar(doctor.id)" value="Guardar">
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
                                            <th>Direccion</th>
                                            <th>Telefono</th>
                                            <th>Especialidad</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(elemento,index) in lista" :key="elemento.id">
                                            <td>{{elemento.nombre}}</td>
                                            <td>{{elemento.apellido_paterno}}</td>
                                            <td>{{elemento.apellido_materno}}</td>
                                            <td>{{elemento.direccion}}</td>
                                            <td>{{elemento.telefono}}</td>
                                            <td>{{elemento.especialidad}}</td>
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
        props:["datos","especialidad"],
        mounted() {
            this.lista = JSON.parse(this.datos)
            this.listaesp = JSON.parse(this.especialidad)
            console.log(this.lista)
            console.log(this.listaesp)
        },
        data(){
            return{
                lista:null,
                listaesp:null,
                doctor : {
                    nombre:null,
                    apellido_paterno:null,
                    apellido_materno:null,
                    direccion:null,
                    telefono:null,
                    especialidad_id:null,
                
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
                    this.doctor.especialidad_id = parseInt(document.querySelector('#especialidad').value)
                    console.log(this.doctor)
                    axios.post("/doctor/guardar",this.doctor).then(response=>{
                        console.log(response)
                        self.lista.push(response.data)
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
                axios.post('/doctor/eliminar/'+id).then(response=>{
                    console.log("Exito")
                    this.lista.splice(idx,1)
                    
                })
                .catch(error=>{
                    console.log(error)
                })
            },
            Editar:function(idx,id){
                this.lista.forEach(list => {
                    if(id==list.id)
                    {
                        this.doctor.nombre=list.nombre
                        this.doctor.apellido_paterno=list.apellido_paterno
                        this.doctor.apellido_materno=list.apellido_materno
                        this.doctor.direccion=list.direccion
                        this.doctor.telefono=list.telefono
                        this.doctor.id=id
                        this.editar=true
                        console.log(id)
                        this.idx=idx
                    }
              
                })
            },
            Actualizar:function(id){
                this.doctor.especialidad_id = parseInt(document.querySelector('#especialidad').value)
                axios.post('/doctor/editar/'+id,this.doctor).then(response=>{
                    this.lista[this.idx].nombre=response.data[0].nombre
                    this.lista[this.idx].apellido_paterno=response.data[0].apellido_paterno
                    this.lista[this.idx].apellido_materno=response.data[0].apellido_materno
                    this.lista[this.idx].direccion=response.data[0].direccion
                    this.lista[this.idx].telefono=response.data[0].telefono
                    //this.lista[this.idx].especialidad = response.data.especialidad_id
                    this.lista[this.idx].especialidad = response.data[0].especialidad
                    this.editar=false;
                    
                    console.log(response.data[0])
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
                let e = document.querySelector('#especialidad').value
                if(nombre === "" || ap === "" || am === "" || d === "" || t === "" || e === ""){
                    return false
                }else{
                    return true
                }
            }
         }
    }
</script>