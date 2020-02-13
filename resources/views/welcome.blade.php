<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Hospital</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="{{mix('/css/all.css')}}">
</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->

    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="/">Hospital</a>
            </div>
            <!-- Opciones esquina superior derecha -->

            <!-- END-Opciones esquina superior derecha -->
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                    <div class="email">{{Auth::user()->email}}</div>

                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="/">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="/especialidad">
                            <i class="material-icons">text_fields</i>
                            <span>Especialidades</span>
                        </a>
                    </li>
                    <li>
                        <a href="/paciente">
                            <i class="material-icons">text_fields</i>
                            <span>Pacientes</span>
                        </a>
                    </li>
                    <li>
                        <a href="/consultorio">
                            <i class="material-icons">text_fields</i>
                            <span>Consultorio</span>
                        </a>
                    </li>
                    <li>
                        <a href="/doctor">
                            <i class="material-icons">text_fields</i>
                            <span>Doctores</span>
                        </a>
                    </li>
                    <li>
                        <a href="/cita">
                            <i class="material-icons">text_fields</i>
                            <span>Citas</span>
                        </a>
                    </li>
                    <li>
                        <a href="/usuario">
                            <i class="material-icons">text_fields</i>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="/profile">
                            <i class="material-icons">person</i>Profile
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 - 2017
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->

        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <main id="app">
                <welcome-component especialidad="{{json_encode($especialidad)}}" cita="{{json_encode($cita)}}" paciente="{{json_encode($paciente)}}"
                consultorio="{{json_encode($consultorio)}}" doctor="{{json_encode($doctor)}}"></welcome-component>
            </main>
            
        </div>
    </section>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="{{ mix('/js/all.js') }}"></script>

</body>

</html>
