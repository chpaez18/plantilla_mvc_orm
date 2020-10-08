<h3><?php if($this->mensaje) echo $this->mensaje; ?></h3>

<p>&nbsp;</p>

<a href="<?php echo ROUTER::create_action_url("index/index")?>">Ir al Inicio</a> |
<a href="javascript:history.back()">Regresar a la Página Anterior</a>