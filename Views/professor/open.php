<?php extract($professor); ?>
<h2><?php echo $usuario_nome.' '.$usuario_sobrenome ;?></h2><br>
<a href="<?php echo URL; ?>professor/<?php echo $usuario_slug;?>/agenda">Agenda</a>