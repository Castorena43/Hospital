<template>
    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Citas</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation">
                                <div class="col-md-12">
                                    <select class="form-control show-tick"  >
                                        <option value="">Paciente</option>
                                        <option v-for="(elemento) in listaPaciente" :key="elemento.id" :value="elemento.id" id="paciente">{{elemento.nombre}}</option>
                                        
                                    </select>
                                </div>   
                                     
                                <div class="col-md-12">
                                    <select class="form-control show-tick"  >
                                        <option value="">Doctor</option>
                                        <option v-for="(elemento) in listaDoctor" :key="elemento.id" :value="elemento.id" id="doctor">DR. {{elemento.nombre}}  Especialidad en {{elemento.espNombre}}</option>
                                        
                                    </select>
                                </div>     
                                <div class="col-md-12">
                                    <select class="form-control show-tick"  >
                                        <option value="">Consultorio</option>
                                        <option v-for="(elemento) in listaConsultorio" :key="elemento.id" :value="elemento.id" id="consultorio">{{elemento.nombre}}</option>
                                        
                                    </select>
                                </div>         
                                <div class="col-md-12">
                                    <div class="form-group">
                                        
                                            <input type="date" class="form-control" placeholder="Please choose a date..." v-model="cita.fecha" id="fecha">
                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    
                                        <div class="form-line">
                                            <input type="time" class="timepicker form-control" placeholder="Please choose a time..." v-model="cita.hora" id="hora">
                                        </div>
                                    
                                </div>
                               
                                
                                <input v-if="editar===false" class="btn btn-primary waves-effect" type="button" v-on:click="EventoGuardar()" value="Agregar">
                                <input v-if="editar===true" class="btn btn-success waves-effect" type="button" v-on:click="Actualizar(cita.id)" value="Guardar">
                            </form>
                        </div>
                        <div class="body">
                        <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Paciente</th>
                                            <th>Doctor</th>
                                            <th>Especialidad</th>
                                            <th>Consultorio</th>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(elemento,index) in lista" :key="elemento.id">
                                            <td>{{elemento.paciente}}</td>
                                            <td>{{elemento.doctor}}</td>
                                            <td>{{elemento.especialidad}}</td>
                                            <td>{{elemento.consultorio}}</td>
                                            <td>{{elemento.fecha}}</td>
                                            <td>{{elemento.hora}}</td>
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
        props:["datos","doctor","paciente","consultorio"],
        mounted() {
            this.lista = JSON.parse(this.datos)
            
            this.listaDoctor = JSON.parse(this.doctor)
            this.listaPaciente = JSON.parse(this.paciente)
            this.listaConsultorio = JSON.parse(this.consultorio)
            console.log(this.lista)
            console.log(this.listaPaciente)
            //console.log(this.listaDoctor)
            console.log(this.listaConsultorio)
            
        },
        data(){
            return{
                lista:null,
                
                listaDoctor:null,
                listaPaciente:null,
                listaConsultorio:null,
                cita : {
                    paciente_id:null,
                    doctor_id:null,
                    consultorio_id:null,
                    fecha:null,
                    hora:null,
                
                    id:null

                },
                editar:false,
                idx:null
            }
            
            
        }
        ,
          methods:{
              
            EventoGuardar:function(){
                // let bool = this.Verificacion()
                // if(bool === true){
                    
                // }else if(bool === false){
                //     Swal.fire({
                //     icon: 'error',
                //     title: 'Oops...',
                //     text: 'Ingresa todos los datos'
                //     })
                // }
                let self = this;
                    this.cita.paciente_id = parseInt(document.querySelector('#paciente').value)
                    this.cita.consultorio_id = parseInt(document.querySelector('#consultorio').value)
                    this.cita.doctor_id = parseInt(document.querySelector('#doctor').value)
                    console.log(this.cita)
                    axios.post("/cita/guardar",this.cita).then(response=>{
                        console.log(response)
                        self.lista.push(response.data)
                    })
                    .catch(error=>{
                        console.log(error)
                    })
             },
            Eliminar:function(id,idx){
                axios.post('/cita/eliminar/'+id).then(response=>{
                    console.log("Exito")
                    this.lista.splice(idx,1)
                    
                })
                .catch(error=>{
                    console.log(error)
                })
            },
            Editar:function(idx,id){
                this.lista.forEach(list => {
                    if(id===list.id)
                    {
                        this.cita.paciente_id=list.paciente_id
                        this.cita.doctor_id=list.doctor_id
                        this.cita.consultorio_id=list.consultorio_id
                        this.cita.fecha=list.fecha
                        this.cita.hora=list.hora
                        this.cita.id=id
                        this.editar=true
                        console.log(id)
                        this.idx=idx
                    }
              
                })
            },
            Actualizar:function(id){
                this.cita.paciente_id = parseInt(document.querySelector('#paciente').value)
                this.cita.doctor_id = parseInt(document.querySelector('#doctor').value)
                this.cita.consultorio_id = parseInt(document.querySelector('#consultorio').value)
                axios.post('/cita/editar/'+id,this.cita).then(response=>{
                    this.lista[this.idx].paciente_id=response.data.paciente_id
                    this.lista[this.idx].doctor_id=response.data.doctor_id
                    this.lista[this.idx].consultorio_id=response.data.consultorio_id
                    this.lista[this.idx].paciente=response.data.paciente
                    this.lista[this.idx].doctor=response.data.doctor
                    this.lista[this.idx].consultorio=response.data.consultorio
                    this.lista[this.idx].fecha=response.data.fecha
                    this.lista[this.idx].hora=response.data.hora
                    this.editar=false;
                    
                    console.log(response.data)
                })
                .catch(error=>{
                    console.log(error)
                })
            },
            Verificacion:function(){
                let p = document.querySelector('#pacientee').value
                let d = document.querySelector('#doctorr').value
                let c = document.querySelector('#consultorioo').value
                let f = document.querySelector('#fecha').value
                let h = document.querySelector('#hora').value
                if(p === "" || d === "" || c === "" || f === "" || h === ""){
                    return false
                }else{
                    return true
                }
            }
          }
    }
</script>