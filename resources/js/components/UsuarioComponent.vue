<template>
    <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Usuario</h2>

                        </div>
                        <div class="body">
                            <form id="form_validation">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="usuario.name" type="text" class="form-control" name="nombre" required id="nombre">
                                        <label class="form-label">Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="usuario.email" type="text" class="form-control" name="nombre" required id="email">
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="usuario.status" type="number" class="form-control" name="nombre" required id="status">
                                        <label class="form-label">Status</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input v-model="usuario.password" type="password" class="form-control" name="nombre" required id="password">
                                        <label class="form-label">Password</label>
                                    </div>
                                </div>



                                <input v-if="editar===false" class="btn btn-primary waves-effect" type="button" v-on:click="EventoGuardar()" value="Agregar">
                                <input v-if="editar===true" class="btn btn-success waves-effect" type="button" v-on:click="Actualizar(usuario.id)" value="Guardar">
                            </form>
                        </div>
                        <div class="body">
                        <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(elemento,index) in lista" :key="elemento.id">
                                            <td>{{elemento.name}}</td>
                                            <td>{{elemento.email}}</td>
                                            <td>{{elemento.status}}</td>

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
                usuario : {
                    name:null,
                    email:null,
                    status:null,
                    password:null,

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
                    axios.post("/usuario/guardar",this.usuario).then(response=>{
                        console.log(response)
                        self.lista.push(response.data.usuario)
                    })
                    .catch(error=>{
                        console.log(error)
                    })                  
                } else {
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ingresa todos los datos'
                    })
                }

            },
            Eliminar:function(id,idx){
                axios.post('/usuario/eliminar/'+id).then(response=>{
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
                        this.usuario.name=list.name
                        this.usuario.email=list.email
                        this.usuario.status=list.status
                        this.usuario.id=id
                        this.editar=true
                        console.log(id)
                        this.idx=idx
                    }

                })
            },
            Actualizar:function(id){
                axios.post('/usuario/editar/'+id,this.usuario).then(response=>{
                    this.lista[this.idx].name=response.data.name
                    this.lista[this.idx].email=response.data.email
                    this.lista[this.idx].status=response.data.status
                    this.editar=false;

                    console.log(response)
                })
                .catch(error=>{
                    console.log(error)
                })
            },
            Verificacion:function(){
                let nombre = document.querySelector('#nombre').value
                let email = document.querySelector('#email').value
                let status = document.querySelector('#status').value
                let password = document.querySelector('#password').value
                if(nombre === "" || email === "" || status === "" || password === ""){
                    return false
                }else{
                    return true
                }
            }
         }
    }
</script>
