<template>
  <div class="login-box">

        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input v-model="usuario.email" type="text" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input v-model="usuario.password" type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-4">
                            <input class="btn btn-block bg-pink waves-effect" type="button" value="SIGN IN" v-on:click="IniciarSesion">
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="/register">Register Now!</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
  </div>
</template>

<script>
export default {
    mounted(){

    }
    ,
    data() {
        return {
            usuario:{
                email:null,
                password:null
            }
        }
    },
    methods:{

        IniciarSesion:function(){
           axios.post('/login',this.usuario)
           .then(response=>{
               if(response.data === "inactivo"){
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Cuenta desactivada'
                    })
               }else{
                    window.location.href="/"
               }

               console.log(response)
           })
           .catch(error=>{
               console.log(error)
           })
        }
    }
}
</script>
