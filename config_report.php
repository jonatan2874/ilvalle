<?php
    if(!session_start()){session_start();}
	if (!isset($_SESSION['IDUSUARIO'])){ header('Location: sign-in.php');  }
	include 'backend/configuracion/conectar.php';
	include 'backend/configuracion/define_variables.php';

	// CONSULTAR EL CERTIFICADO
	$sql   = "SELECT
				content
			 FROM certificados WHERE activo=1 AND type='$type'";
	$query   = mysqli_query($mysql,$sql);
	$result  = $query->fetch_assoc();
	$content = $result['content']; 
    $title = "";
	switch ($type) {
        case 'fuente':
            $title = "CERTIFICADO DE RETENCION EN LA FUENTE";
            break;
        case 'iva':
            $title = "CERTIFICADO DE RETENCION DE IVA";
            break;
        case 'ica':
            $title = "CERTIFICADO DE RETENCION DE ICA";
            break;
        case 'estampillas':
            $title = "CERTIFICADO ESTAMPILLAS";
            break;
    }

?>
<!DOCTYPE HTML>
<html>
<head>
<title>ILValle Admin Web| Configurar Certificado</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- ckeditor -->
 <script src="backend/misc/ckeditor/ckeditor.js"></script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts--->
 <!-- Meters graphs -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

<!-- jquery plugin para las tablas -->
<link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
   <script type="text/javascript" src="js/DataTables/datatables.min.js"></script>

</head>

 <body class="sticky-header left-side-collapsed"  onload="">
    <section>
    <!-- left side start-->
		<div class="left-side sticky-left-side">

			<!--logo and iconic logo start-->
			<div class="logo">
				<h1><a href="index.php">ILValle <span>Admin</span></a></h1>
			</div>
			<div class="logo-icon text-center">
				<a href="index.php"><i class="lnr lnr-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
					<ul class="nav nav-pills nav-stacked custom-nav">
						<li ><a href="index.php"><i class="lnr lnr-power-switch"></i><span>Dashboard</span></a></li>
						<li class="menu-list" class="active">
							<a href="#"><i class="lnr lnr-cog"></i>
								<span>Configuracion</span></a>
								<ul class="sub-menu-list">
									<li><a href="users.php">Usuario</a> </li>
									<li><a href="Config.php">configuracion</a></li>
								</ul>
						</li>
					</ul>
				<!--sidebar nav end-->
			</div>
		</div>
		<!-- left side end-->

		<!-- main content start-->
		<div class="main-content">
			<!-- header-starts -->
			<div class="header-section">

			<!--toggle button start-->
			<a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
			<!--toggle button end-->

			<!--notification menu start -->
			<div class="menu-right">
				<div class="user-panel-top">
					<div class="profile_details">
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">
										<span style="background:url(images/11.png) no-repeat center"> </span>
										 <div class="user-name">
											<p><?= $_SESSION['NOMBREUSUARIO'] ?><span><?= $_SESSION['ROLUSUARIO'] ?></span></p>
										 </div>
										 <i class="lnr lnr-chevron-down"></i>
										 <i class="lnr lnr-chevron-up"></i>
										<div class="clearfix"></div>
									</div>
								</a>
								<ul class="dropdown-menu drp-mnu">
									<!-- <li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> -->
									<li> <a href="profile.php"><i class="fa fa-user"></i>Profile</a> </li>
									<li> <a href="sign-up.html"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			  </div>
			<!--notification menu end -->
			</div>
		<!-- //header-ends -->
			<div id="page-wrapper">
				<div class="graphs">
					<h3 class="blank1">Configurar <?= $title; ?></h3>
					 <div class="xs tabls">

						<div class="bs-example4" data-example-id="simple-responsive-table">

						<button type="button" onclick="saveCert()" style="margin:10px;" class="btn btn_5 btn-lg btn-warning warning_11">Guardar</button>

						<div class="table-responsive">
						  <textarea name="certEditor" id="certEditor" rows="10" cols="80"><?= $content; ?></textarea>
						</div><!-- /.table-responsive -->
						</div>
					</div>
				</div>
			</div>
			 <!--body wrapper end-->
		</div>
		<div class="containLoad" style="visibility: hidden;">
			<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
		</div>
        <!--footer section start-->
			<footer>
			   <p>&copy 2019 ILValle. All Rights Reserved <!-- | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts.</a> --></p>
			</footer>
        <!--footer section end-->

      <!-- main content end-->
   </section>
<script>
	CKEDITOR.replace( 'certEditor' );

	var saveCert = ()=>{ 
		var data = CKEDITOR.instances.certEditor.getData();
		$(".containLoad").css("visibility", "visible");

	 	// if (!confirm("¿Realmente desea eliminar el usuario?")) {return}
	 	$.ajax({
			method : 'POST',
			url    : 'backend/users/controller.php?method=saveCert',
			data   : {type:'<?= $type; ?>', content:data},
            beforeSend: function(){
                // $('.submitBtn').attr("disabled","disabled");
                // $('#fupForm').css("opacity",".5");
            },
            success: function(result){
            	var response = jQuery.parseJSON( result );
            	console.log(result);
				$(".containLoad").css("visibility", "hidden");
				if (response.response=='success') { 
					alert("Se actualizo el certificado");
					location.reload();
				}
				else{ alert(response.msg) }
            }
        });
	}
</script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- data tables -->
</body>
</html>