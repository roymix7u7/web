<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://kit.fontawesome.com/d207858ac4.js" crossorigin="anonymous"></script>
        <link href="estilos/style1.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<header>
        <!-- Barra de menú-->
		<img width=220 height="90" src="imagenes/logo2.png" class="logo">
		<nav>
		<ul class="tranf">
                        <li><a href="#">INICIO</a></li>
			<li><a href="#">SERVICIOS</a>
                            <ul class="subMenu">
                                <li><a href="#">Mantenimiento Preventivo</a></li>
                                <li><a href="#">Mecánica y Electrónica</a></li>
                                <li><a href="#">Planchado y Pintura</a></li>
                            </ul>  
                        </li>
			<li><a href="#">REPUESTOS</a></li>
			<li><a href="#">LOCALES</a></li>
			<li><a href="#">CONTÁCTANOS</a></li>

                </ul>
		</nav>
                <a href="Login.php"><img src="imagenes/jugador.png" alt="alt" width="80px" height="80px" ></a>
	</header>

	<section class="zona1"></section>

	<div class="container">
        <h1 >Repuestos y Servicios</h1>
        <div class="image-gallery">
            <a href="#"><img src="imagenes/img1.jpg" alt="Imagen 1"></a>
            <a href="#"><img src="imagenes/img2.jpg" alt="Imagen 2"></a>
            <a href="#"><img src="imagenes/img3.jpg" alt="Imagen 3"></a>
            <a href="#"><img src="imagenes/img4.jpg" alt="Imagen 4"></a>
        </div>
    </div>

	<section class="zona2">
		

		<div class="txt2">
			<p>Poseemos mas de 25 años de experiencia en el rubro con las mejores soluciones que requiere para su auto</p>
			<br>
			<h3>¿Porqué debe elegirnos?</h3>
		</div>
		

	</section>

	<section class="zona3">

		<div class="sepa1">

			<img src="imagenes/bugia.png">
		

			<div class="text">
			<h3>Los mejores repuestos</h3>
			<br>
			<p> Disponibles más de 40,000 repuestos para
				 satisfacer la necesidad de su vehículo o flota, convirtiéndonos 
				 en los más rápidos del mercado.</p>
				 <button class="button">VER MÁS</button>
				
			</div>
		</div>

	</section>

	<footer>
	
		
		<div class="columna">
			<div class="colum1 ">
				<h5 class="colu1">Contacto</h5>
				<p>GOD OF CARS - 203230124134</p>
				<p>Lima - Perú</p>
				<p>godofcars@gmail.com</p>
				<div>
					<a class="qsub" href=""><i class="fa-brands fa-facebook"></i></a>
					<a class="qsub" href=""><i class="fa-brands fa-whatsapp"></i></a>
					<a class="qsub" href=""><i class="fa-brands fa-instagram"></i></a>
					<a class="qsub" href=""><i class="fa-brands fa-youtube"></i></a>
				</div>
			</div>
			<div class="colum2">
				<h5 class="colu1">Acerca de</h5>
				<a href="">Términos y Condiciones - Lista Express</a>
				<a href="">Políticas de Privacidad</a>
				<a href="">Cambios y Devoluciones</a>
				<a href="">Términos y Condiciones</a>
	
			</div>
			<div class="colum3">
				<h5 class="colu1">Medios de Pago</h5>
				<div>
					<img src="imagenes/tarjetas.png">
				</div>
				<div>
					<img src="imagenes/libro.png">
				</div>
			</div>	
		</div>
		<div class="pief">
			<span>Powered by ROY</span>
		</div>
	
	</footer>
	
	

	<script type="text/javascript">
		window.addEventListener("scroll", function(){
			var header = document.querySelector("header");
			header.classList.toggle("abajo",window.scrollY>0);
		})
	</script>
</body>
</html>