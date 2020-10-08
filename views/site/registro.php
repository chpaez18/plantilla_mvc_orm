<?php 
use Application\Router;
?>
<div class="card card-container">
	
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="<?php echo $_layoutParams['ruta_img']?>user.png" />
			<center><h4>Registro de Usuario</h4></center>
			<p id="profile-name" class="profile-name-card"></p>
			<form id="formulario_login" name="form1" method="post" action="<?= ROUTER::create_action_url("site/registro")?>">
			<div class="form-group">
				<input type="text" name="nom_usuario" class="form-control" placeholder="Nombre de usuario">
			</div>
			<div class="form-group">
				<input type="password" name="pass_usuario" class="form-control" placeholder="Contraseña">
			</div>
			<br>

		<br>
		<br>
			<center><button type="submit" class="btn btn-primary btn-lg btn-block" onclick="validar()"> <span class="fas fa-sign-in-alt"></span> Registrarse</button></center>
			</form>
		</div><!-- /card-container -->
<br>
<br>
<br>
<br>




		


