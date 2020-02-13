<template>
    <div class="signup-box">

        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST">
                    <div class="msg">Register a new membership</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input v-model="usuario.name" type="text" class="form-control" name="namesurname" placeholder="Name" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input v-model="usuario.email" type="email" class="form-control" name="email" placeholder="Email Address" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input v-model="usuario.password" type="password" class="form-control" name="password" minlength="6" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input v-model="usuario.password_confirmation" type="password" class="form-control" name="confirm" minlength="6" placeholder="Confirm Password" required>
                        </div>
                    </div>


                    <input class="btn btn-block btn-lg bg-pink waves-effect" type="button" v-on:click="Registrar" value="SIGN UP">

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="/login">You already have a membership?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted(){

    },
    data(){
        return {
            usuario : {
                name:null,
                email:null,
                password:null,
                password_confirmation:null
            }
        }
    },
    methods:{
        Registrar:function(){
            if(this.usuario.password === this.usuario.password_confirmation){
                axios.post('/register',this.usuario)
                .then(response=>{
                    window.location.href="/login"
                })
                .catch(error=>{
                    console.log(error)
                })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Verifica que las contraseñas sean iguales'
                    })
            }
        }
    }
}
</script>
