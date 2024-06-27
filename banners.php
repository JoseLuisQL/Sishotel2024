<?php
require_once("class/class.php");
if (isset($_SESSION['acceso'])) {
    if ($_SESSION['acceso'] == "administrador" || $_SESSION['acceso'] == "secretaria") {

        $tra = new Login();
        $ses = $tra->ExpiraSession();

        if (isset($_POST["proceso"]) and $_POST["proceso"] == "save") {
            $reg = $tra->RegistrarBanner();
            exit;
        } elseif (isset($_POST["proceso"]) and $_POST["proceso"] == "update") {
            $reg = $tra->ActualizarBanner();
            exit;
        }

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Yoni Belito Sedano">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title></title>
    <link href="assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="assets/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/sweetalert.css">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/default.css" id="theme" rel="stylesheet">
</head>
<body onLoad="muestraReloj()" class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-boxed-layout="full" data-header-position="fixed" data-sidebar-position="fixed" class="mini-sidebar">
        <?php include('menu.php'); ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb border-bottom">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-0"><i class="fa fa-tasks"></i> Consulta General</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item">Administración</li>
                                <li class="breadcrumb-item active" aria-current="page">Banners</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="page-content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white"><i class="fa fa-tasks"></i> Gestión de Banners</h4>
                            </div>
                            <div id="save">
                                <!-- error will be shown here ! -->
                            </div>
                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h4 class="card-subtitle m-0 text-dark"><i class="font-20 fa fa-save"></i> Gestión de Banners</h4>
                                            <hr>
                                            <form class="form form-material" method="post" action="#" name="savebanner" id="savebanner" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback">
                                                            <label class="control-label">Nombre de Banner: <span class="symbol required"></span></label>
                                                            <input type="hidden" name="proceso" id="proceso" value="save" />
                                                            <input type="hidden" name="codbanner" id="codbanner">
                                                            <input type="text" class="form-control" name="nombrebanner" id="nombrebanner" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Nombre de Banner" autocomplete="off" required="" aria-required="true">
                                                            <i class="fa fa-pencil form-control-feedback"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback2">
                                                            <label class="control-label">Descripción de Banner: <span class="symbol required"></span></label>
                                                            <textarea class="form-control" name="descbanner" id="descbanner" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Descripción de Banner" rows="12" autocomplete="off" required="" aria-required="true"></textarea>
                                                            <i class="fa fa-pencil form-control-feedback2"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback">
                                                            <label class="control-label">Imagen de Banner: <span class="symbol required"></span></label>
                                                            <input type="file" class="form-control" name="imagenbanner" id="imagenbanner" required="" aria-required="true">
                                                            <input type="hidden" name="imagenbanner_actual" id="imagenbanner_actual">
                                                            <i class="fa fa-pencil form-control-feedback"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button type="submit" name="btn-submit" id="btn-submit" class="btn btn-info"><span class="fa fa-save"></span> Guardar</button>
                                                    <button class="btn btn-dark" type="button" onclick="
                                                        document.getElementById('proceso').value = 'save',
                                                        document.getElementById('codbanner').value = '',
                                                        document.getElementById('nombrebanner').value = '',
                                                        document.getElementById('descbanner').value = '',
                                                        document.getElementById('imagenbanner').value = '',
                                                        document.getElementById('imagenbanner_actual').value = ''
                                                    "><span class="fa fa-trash-o"></span> Limpiar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-7">
                                            <h4 class="card-subtitle m-0 text-dark"><i class="font-20 fa fa-tasks"></i> Listado de Banners</h4>
                                            <hr>
                                            <!-- <div class="row">
                                                <div class="col-md-6">
                                                    <div class="btn-group m-b-20">
                                                        <a class="btn waves-effect waves-light btn-light" href="reportepdf?tipo=<?php echo encrypt("BANNER") ?>" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" data-placement="bottom" title="Exportar Pdf"><span class="fa fa-file-pdf-o text-dark"></span> Pdf</a>
                                                        <a class="btn waves-effect waves-light btn-light" href="reporteexcel?documento=<?php echo encrypt("EXCEL") ?>&tipo=<?php echo encrypt("BANNER") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Excel"><span class="fa fa-file-excel-o text-dark"></span> Excel</a>
                                                        <a class="btn waves-effect waves-light btn-light" href="reporteexcel?documento=<?php echo encrypt("WORD") ?>&tipo=<?php echo encrypt("BANNER") ?>" data-toggle="tooltip" data-placement="bottom" title="Exportar Word"><span class="fa fa-file-word-o text-dark"></span> Word</a>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <div id="banner"></div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer text-center">
                <i class="fa fa-Copyright"></i> <span class="current-year"></span>.
            </footer>
        </div>
    </div>



    <script src="assets/script/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script src="assets/js/app.init.horizontal-fullwidth.js"></script>
    <script src="assets/js/app-style-switcher.js"></script>
    <script src="assets/js/perfect-scrollbar.js"></script>
    <script src="assets/js/sparkline.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/sweetalert-dev.js"></script>
    <script src="assets/js/sidebarmenu.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/plugins/fileupload/bootstrap-fileupload.min.js"></script>
    <script src="assets/script/titulos.js"></script>
    <script src="assets/script/script2.js"></script>
    <script src="assets/script/validation.min.js"></script>
    <script src="assets/script/script.js"></script>
    <link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
    <script src="assets/calendario/jquery-ui.js"></script>

    <!-- jQuery -->
    <script src="assets/plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script type="text/jscript">
    $('#banner').append('<center><i class="fa fa-spin fa-spinner"></i> Por favor espere, cargando registros ......</center>').fadeIn("slow");
    setTimeout(function() {
        $('#banner').load("consultas?CargaBanner=si");
    }, 200);
    </script>
    <!-- jQuery -->

</body>
</html>
<?php
    } else {
?>
<script type='text/javascript' language='javascript'>
    alert('NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO')
    document.location.href = 'panel'
</script>
<?php
    }
} else {
?>
<script type='text/javascript' language='javascript'>
    alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')
    document.location.href = 'logout'
</script>
<?php
}
?>
