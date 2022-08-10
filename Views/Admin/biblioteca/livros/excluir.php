<h2>Tem certeza que deseja excluir o livro <?php echo $livro['biblioteca_livro_titulo'];?>?</h2>
<a href="<?php echo URL.'admin/livros/cexcluir/'.$livro['biblioteca_livro_id']; ?>">Sim</a>
<a href="<?php echo URL.'admin/biblioteca'; ?>">Não</a>