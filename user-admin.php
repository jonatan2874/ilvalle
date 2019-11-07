<?php
    if(!session_start()){session_start();}
	if (!isset($_SESSION['IDUSUARIO'])){ header('Location: sign-in.php');  }
	include 'backend/configuracion/conectar.php';
	include 'backend/configuracion/define_variables.php';
	$titleAction = 'Agregar Usuario';
	$script      = "";
	$imgLogo     = "";
	if (!isset($id_user)) { $id_user=0; }
	if ($id_user>0){
		$titleAction='Modificar Usuario';
		$sql   = "SELECT  
						documento,
						dv,
						nombre,
						user_name,
						password,
						rol
					FROM users WHERE id=$id_user";
		$query = mysqli_query($mysql,$sql);
		// var_dump($query);
		$result    = $query->fetch_assoc();
		$documento = $result['documento'];
		$dv        = $result['dv'];
		$nombre    = $result['nombre'];
		$user_name = $result['user_name'];
		$password  = $result['password'];
		$rol       = $result['rol'];

		$script = "
					document.getElementById('documento').value ='$documento';
					document.getElementById('dv').value        ='$dv';
					document.getElementById('nombre').value    ='$nombre';
					document.getElementById('user_name').value ='$user_name';
					document.getElementById('password').value  ='$password';
					document.getElementById('rol').value       ='$rol';
					";
	}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>ILValle Admin Web | Users-Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Easy Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
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

</head>

 <body class="sticky-header left-side-collapsed"  onload="">
    <section>
    <!-- left side start-->
		<div class="left-side sticky-left-side">

			<!--logo and iconic logo start-->
			<div class="logo">
				<h1><a href="index.php">JTello <span>Admin</span></a></h1>
			</div>
			<div class="logo-icon text-center">
				<a href="index.php"><i class="lnr lnr-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
					<ul class="nav nav-pills nav-stacked custom-nav">
						<li ><a href="index.php"><i class="lnr lnr-power-switch"></i><span>Dashboard</span></a></li>
						<li ><a href="products.php"><i class="lnr lnr-cart"></i> <span>Productos</span></a></li>
						<li class="menu-list" class="active">
							<a href="#"><i class="lnr lnr-cog"></i>
								<span>Configuracion</span></a>
								<ul class="sub-menu-list">
									<li><a href="users.php">Usuario</a> </li>
									<li><a href="#">Otros</a></li>
								</ul>
						</li>
					</ul>
				<!--sidebar nav end-->
			</div>
		</div>
    <!-- left side end-->

    <!-- main content start-->
		<div class="main-content main-content3">
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
					<h3 class="blank1"><?= $titleAction; ?></h3>
						<div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" id="fupForm">
								<div class="form-group">
									<label for="codigo" class="col-sm-2 control-label">Documento (CC,NIT,RUT,etc)</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="documento" id="documento" >
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block">Debe ser Unico</p>
									</div>
								</div>
								<div class="form-group">
									<label for="nombre" class="col-sm-2 control-label">Digito verificacion</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="dv" id="dv" >
									</div>
								</div>
								<div class="form-group">
									<label for="nombre" class="col-sm-2 control-label">Nombre</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="nombre" id="nombre" >
									</div>
								</div>
								<div class="form-group">
									<label for="descripcion" class="col-sm-2 control-label">Nombre de usuario</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" name="user_name" id="user_name" >
									</div>
									<div class="col-sm-2 jlkdfj1">
										<p class="help-block">Debe ser Unico</p>
									</div>
								</div>
								<div class="form-group">
									<label for="precio" class="col-sm-2 control-label">Contraseña</label>
									<div class="col-sm-8">
										<input type="password" class="form-control1" name="password" id="password" >
									</div>
								</div>
								<div class="form-group">
									<label for="precio" class="col-sm-2 control-label">Rol</label>
									<div class="col-sm-8">
										<select id="rol" name="rol" class="form-control1">
											<option value="administrador">Administrador</option>
											<option value="proveedor">Proveedor</option>
											<option value="empleado">Empleado</option>
										</select>
									</div>
								</div>
							  	<input type="hidden" name="id_user" id="id_user" value="<?= $id_user; ?>">
							</form>
							<div class="panel-footer">
							<div class="row">
								<div class="col-sm-8 col-sm-offset-2">
									<button class="btn-success btn" onclick="saveUser()">Guardar</button>
									<button class="btn-default btn" id="cancelar">Cancelar</button>
									<button class="btn-inverse btn" id="reset">Borrar</button>
								</div>
							</div>
						 </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="containLoad" style="visibility: hidden;">
			<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
		</div>
		<!--footer section start-->
			<footer>
			   <p>&copy 2019 ILValle. All Rights Reserved <!-- | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts.</a> --></p>
			</footer>
        <!--footer section end-->
	</section>

<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>
<script>

	$(document).ready(function(e){
		$("#fupForm").on('submit', function(e){
	        e.preventDefault();
	        $.ajax({
				type        : 'POST',
				url         : 'backend/users/controller.php',
				data        : new FormData(this),
				contentType : false,
				cache       : false,
				processData : false,
	            beforeSend: function(){
	                // $('.submitBtn').attr("disabled","disabled");
	                // $('#fupForm').css("opacity",".5");
	            },
	            success: function(result){
	            	var response = jQuery.parseJSON( result );
	            	console.log(result);
					$(".containLoad").css("visibility", "hidden");
					if (response.response=='success') { 
						alert(response.msg);
						$("#fupForm").trigger("reset"); 
						if ($("#id_user").val()>0){ window.location = "users.php"; }
					}
					else{ alert(response.msg) }
	            }
	        });
	    });

		$("#cancelar").on("click",()=>{
			window.location = "users.php";
		});
		$("#reset").on("click",()=>{
			$("#fupForm").trigger("reset"); 
		});
	});

	var saveUser = () =>{
		// let codigo      = document.getElementById('codigo').value
		// ,	nombre      = document.getElementById('nombre').value
		// ,	descripcion = document.getElementById('descripcion').value
		// ,	precio      = document.getElementById('precio').value
		// ,	logo        = document.getElementById('logo').value

		$(".containLoad").css("visibility", "visible");
		$( "#fupForm" ).submit();



	}
	<?= $script; ?>
</script>