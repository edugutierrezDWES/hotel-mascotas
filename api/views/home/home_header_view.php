<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link href="/hotelmascotasmvc/css/bootstrap-select.css" rel="stylesheet">
<link href="/hotelmascotasmvc/css/bootstrap-icons.css" rel="stylesheet">
<link href="/hotelmascotasmvc/css/tables.css" rel="stylesheet">
<!-- My CSS -->
<link href="/hotelmascotasmvc/css/styles.css" rel="stylesheet">
<title>Hotel para Mascotas</title>
<link rel="icon" 
      type="image/png" 
      href="img/patita.png" />
</head>
<body>
<!--HEADER logos-->
<div class="container-fluid header_fixed">
  <div class="header container ">
    <div class="row ">
      <div class="col-sm-9 pad0">
        <!-- <div class="fleft"><a href="home.html"><img class="img-fluid" src="img/logo.png" alt="Logo SCAPR"/> </a></div> -->
        <div class="ipn-title fleft">
          <h1 clas="ipn-title"><a href="/hotelmascotasmvc/home">Bienvenido, <?php echo $nombre." ".$apellidos;?></a></h1>
        </div>
      </div>
      <!-- dropdown admin -->
      <div class="col-sm-3 text-right"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><?php echo $nombre." ".$apellidos;?><span class="caret"></span></a>
        <ul class="dropdown-menu dropdown-menu-right admin_user" aria-labelledby="dropdownMenuLink">
          <li><span>Email:</span><?php echo $email;?></li>
          <li><span>Usuario Desde:</span><?php echo $fecha_alta;?></li>
          <li><a class="dropdown-item" href="/hotelmascotasmvc/home/editar"><i class="bi bi-unlock-fill mar_r4"></i>Cambiar Datos</a>
          <li><a class="dropdown-item" href="/hotelmascotasmvc/logout"><i class="bi bi-power mar_r4 color_orange"></i>Cerrar Sesión</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>