<?php extract($projeto);?>

<h2>Tem certeza de que você deseja excluir o projeto <?php echo $projeto_nome; ?>?</h2>

<a href="<?php echo URL.'projetos/cexcluir/'.$projeto_id; ?>">Excluir</a>
<a href="<?php echo URL.'projetos'; ?>">Cancelar</a>