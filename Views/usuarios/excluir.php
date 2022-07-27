<?php extract($usuario);?>

<h2>Tem certeza de que você deseja excluir o usuário <?php echo $usuario_nome.' '.$usuario_sobrenome; ?>?</h2>

<a href="<?php echo URL.'usuarios/cexcluir/'.$usuario_id; ?>">Excluir</a>
<a href="<?php echo URL.'usuarios'; ?>">Cancelar</a>