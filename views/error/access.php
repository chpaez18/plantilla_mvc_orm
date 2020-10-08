<h3><?php if($this->mensaje) echo $this->mensaje; ?></h3>

<p>&nbsp;</p>

<a href="<?php echo ROUTER::create_action_url("site/index")?>">Ir al Inicio</a> |
<a href="javascript:history.back()">Regresar a la Página Anterior</a> |


<!-- hacemos una verificacion -->

<?php //si el usuario no tiene sesion iniciada
	if(!Session::get("autenticado")){ ?>

	<a href="<?php echo ROUTER::create_action_url("site/login")?>">Iniciar Sesión</a> 

<?php } ?>