<?php
    if(!session_start()){session_start();}
	if (!isset($_SESSION['IDUSUARIO'])){ header('Location: sign-in.php');  }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>ILValle Admin web | Configuracion</title>
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

<script src="js/dropzone.js"></script>

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
				<h1><a href="index.php">ILValle <span>Admin</span></a></h1>
			</div>
			<div class="logo-icon text-center">
				<a href="index.php"><i class="lnr lnr-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
					<ul class="nav nav-pills nav-stacked custom-nav">
						<li class="active"><a href="index.php"><i class="lnr lnr-power-switch"></i><span>Dashboard</span></a></li>
						<!-- <li><a href="products.php"><i class="lnr lnr-cart"></i> <span>Productos</span></a></li> -->
						<?php 
							if ($_SESSION['ROLUSUARIO']=='administrador') {
								?>
								<li class="menu-list">
									<a href="#"><i class="lnr lnr-cog"></i>
										<span>Configuracion</span></a>
										<ul class="sub-menu-list">
											<li><a href="users.php">Usuario</a> </li>
											<li><a href="Config.php">configuracion</a></li>
										</ul>
								</li>
								<?php
							}
						?>
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
									<li> <a href="log-out.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
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
					
					<h3 class="blank1">Cargar Informacion </h3>
					<div class="col_3">
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>fuente </h5>
								  <div class="grow">
									<p style="cursor: pointer;" onclick="showHiddenUpload('fuente')">Cargar</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>Iva </h5>
								  <div class="grow grow1">
									<p style="cursor: pointer;" onclick="showHiddenUpload('iva')">Cargar</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>Ica </h5>
								  <div class="grow grow3">
									<p style="cursor: pointer;" onclick="showHiddenUpload('ica')">Cargar</p>
								  </div>
								</div>
							</div>
						 </div>
						 <div class="col-md-3 widget">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>Estampillas </h5>
								  <div class="grow grow2">
									<p style="cursor: pointer;" onclick="showHiddenUpload('estampillas')">Cargar</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Ingresos y <br>Retenciones </h5>
								  <div class="grow grow3">
									<p style="cursor: pointer;" onclick="showHiddenUpload('ingresos_retenciones')">Cargar</p>
								  </div>
								</div>
							</div>
						 </div>
						<div class="clearfix"> </div>
					</div>
					<br>
					<h3 class="blank1">Eliminar Informacion </h3>
					<div class="col_3">
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>fuente </h5>
								  <div class="grow">
									<p style="cursor: pointer;" onclick="deleteDataCert('fuente')">Eliminar</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>Iva </h5>
								  <div class="grow grow1">
									<p style="cursor: pointer;" onclick="deleteDataCert('iva')">Eliminar</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>Ica </h5>
								  <div class="grow grow3">
									<p style="cursor: pointer;" onclick="deleteDataCert('ica')">Eliminar</p>
								  </div>
								</div>
							</div>
						 </div>
						 <div class="col-md-3 widget">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>Estampillas </h5>
								  <div class="grow grow2">
									<p style="cursor: pointer;" onclick="deleteDataCert('estampillas')">Eliminar</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Ingresos y <br>Retenciones </h5>
								  <div class="grow grow3">
									<p style="cursor: pointer;" onclick="deleteDataCert('ingresos_retenciones')">Eliminar</p>
								  </div>
								</div>
							</div>
						 </div>
						<div class="clearfix"> </div>
					</div>
					<br>
					<h3 class="blank1">Configurar Informes</h3>
					<div class="col_3">
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>fuente </h5>
								  <div class="grow">
									<p style="cursor: pointer;" onclick="configCert('fuente')">Configurar</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>Iva </h5>
								  <div class="grow grow1">
									<p style="cursor: pointer;" onclick="configCert('iva')">Configurar</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>Ica </h5>
								  <div class="grow grow3">
									<p style="cursor: pointer;" onclick="configCert('ica')">Configurar</p>
								  </div>
								</div>
							</div>
						 </div>
						 <div class="col-md-3 widget">
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5>Rete. <br>Estampillas </h5>
								  <div class="grow grow2">
									<p style="cursor: pointer;" onclick="configCert('estampillas')">Configurar</p>
								  </div>
								</div>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					

				</div>
			<!--body wrapper start-->
			</div>
			 <!--body wrapper end-->
		</div>
        <!--footer section start-->
			<footer>
			   <p>&copy 2019 ILValle. All Rights Reserved <!-- | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts.</a> --></p>
			</footer>
        <!--footer section end-->

      <!-- main content end-->
   </section>
   <div class="containLoad" id="containLoad" style="visibility: hidden;">
		<div id="dropzone">
			<span style="color: #FFF;font-weight: bold;font-size: 25px;cursor: pointer;" onclick="showHiddenUpload()">X</span>
			<form action="" class="dropzone needsclick dz-clickable" id="upload">
			<h4>
				El formato de excel debera tener la siguiente estructura y se cargara informacion a
				partir de la segunda fila, la primera fila se tomara como el titulo del excel
			</h4>
			<img src="images/guia.png" style="width: 100%;height: 100px;">
			  <input type="date" name="anio" id="anio" >
			  <div class="dz-message needsclick">
			  	<h2 id='titleCert'></h2>
			    Arrastre los archivos aqui o haga click para seleccionar<br>
			    <span class="note needsclick">(Cargue el archivo excel <strong>solo se permiten</strong> xls y xlsx)</span>
			  </div>
			  <input type="hidden" name="typeCert" id="typeCert">
			</form>
		</div>

		<!-- <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div> -->
	</div>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
	// var myDropzone = new Dropzone("#upload", { url: "/file/post"});
	var dropzone = new Dropzone(
								"div#dropzone", 
								{ 
									url: "backend/config/upload_file.php",
								 	success : function(file, result){
								        // console.log(file);
								        // console.log(result);
	            						var response = jQuery.parseJSON( result );
	            						console.log(response);
	            						alert(response.msg)
	            						if (response.status=='success'){ location.reload(); }
								    }
								}
							);
	var configCert=(type)=>{
		// config_report
		window.location = "config_report.php?type="+type;
	}

	var showHiddenUpload = (typeCert)=>{
		// console.log($(".containLoad"));
		let style=document.getElementById('containLoad').getAttribute("style")
		,	title_upload = ''
		switch(typeCert){
			case 'fuente':
				title_upload = 'Cargar rete fuente';
			break;
			case 'iva':
				title_upload = 'Cargar Rete Iva';
			break;
			case 'ica':
				title_upload = 'Cargar Rete Ica';
			break;
			case 'estampillas':
				title_upload = 'Cargar Estampillas';
			break;
			case 'ingresos_retenciones':
				title_upload = 'Cargar ingresos y retenciones';
			break;
		}

		document.getElementById('typeCert').value=typeCert;
		document.getElementById('titleCert').innerHTML=title_upload;
		// console.log(style);
		if (style=='visibility: hidden;') {			
			$(".containLoad").css("visibility", "visible");
			// $("#containLoad").css("visibility", "visible");
		}
		else{
			$(".containLoad").css("visibility", "hidden");
		}
	}
	
	var deleteDataCert = (typeCert)=>{
		if (!confirm('Relamente desea eliminar los datos del certificado?')) {return;}
		var anio = prompt("Por favor digite el año a eliminar", "");

		if (anio == null) {
		  alert("debe digitar el año");
		  return;
		}

		$.ajax({
			method : 'POST',
			url    : 'backend/config/controller.php',
			data   : {anio:anio, method:"deleteDataCert",typeCert:typeCert},
            beforeSend: function(){
                // $('.submitBtn').attr("disabled","disabled");
                // $('#fupForm').css("opacity",".5");
            },
            success: function(result){
            	var response = jQuery.parseJSON( result );
            	console.log(result);
				// $(".containLoad").css("visibility", "hidden");
				if (response.response=='success') { 
					// location.reload();
					// alert(response.msg);
					// $("#fupForm").trigger("reset"); 
					// if ($("#id_producto").val()>0){ window.location = "products.php"; }
				}
				else{ alert(response.msg) }
            }
        });

	}

</script>
</body>
</html>