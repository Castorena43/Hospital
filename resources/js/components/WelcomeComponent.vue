<template>
  <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Pacientes</div>
                            <div class="number" ><p id="p"></p></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Doctores</div>
                            <div class="number "><p id="d"></p></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">Especialidades</div>
                            <div class="number " ><p id="e"></p></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Consultorios</div>
                            <div class="number"><p id="co"></p></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Citas</div>
                            <div class="number" ><p id="cs"></p></div>
                        </div>
                    </div>
                </div>
            </div>
</template>

<script>
export default {
    props:["especialidad","paciente","doctor","consultorio","cita"],
    mounted(){
        
        document.querySelector('#p').textContent = this.paciente;
        document.querySelector('#d').textContent = this.doctor;
        document.querySelector('#e').textContent = this.especialidad;
        document.querySelector('#co').textContent = this.consultorio;
        document.querySelector('#cs').textContent = this.cita;
    }

}
</script>

<style>

</style>