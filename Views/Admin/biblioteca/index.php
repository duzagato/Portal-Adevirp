<h2>Biblioteca</h2>

<h3>Livros</h3>
<a href="<?php echo URL ?>admin/biblioteca/livros/adicionar">Adicionar Livro</a>
<?php
    if(Database::getTableCount('biblioteca_livro') == 0){
        echo '<br><span>Nenhum livro encontrado</span>';
    }else{
?>
<table>
    <thead>
        <th>Título</th>
        <th>Autor</th>
        <th>Categoria(s)</th>
        <th>Ações</th>
    </thead>
<?php
    foreach($livros as $l){
        extract($l);
?> 
    <tbody>
        <td><?php echo $biblioteca_livro_titulo; ?></td>
        <td><?php echo $biblioteca_autor_nome; ?></td>
        <td>
            <?php
                $livro_categorias = Database::query('SELECT biblioteca_categoria.biblioteca_categoria_nome FROM biblioteca_categoria, biblioteca_livro, livro_categoria WHERE livro_categoria.biblioteca_livro_id = :id AND biblioteca_categoria.biblioteca_categoria_id = livro_categoria.biblioteca_categoria_id', array(':id'=>$biblioteca_livro_id));
                
                if($livro_categorias != array()){
                    foreach($livro_categorias as $lc){
                        $values[] = $lc['biblioteca_categoria_nome'];
                    }

                    echo implode(', ', array_unique($values));
                }
            ?>
        </td>
        <td>
            <a href="<?php echo URL.'admin/livros/editar/'.$biblioteca_livro_id; ?>">Editar</a>
            <a href="<?php echo URL.'admin/livros/excluir/'.$biblioteca_livro_id; ?>">Excluir</a>
        </td>
    </tbody>
<?php }}?>
</table>

<h3>Categorias</h3>
<a href="<?php echo URL ?>admin/categorias/adicionar">Adicionar Categoria</a>
<?php
    if(Database::getTableCount('biblioteca_categoria') == 0){
        echo '<br><span>Nenhuma categoria encontrada</span>';
    }else{
?>
<table>
    <thead>
        <th>Categoria</th>
        <th>Ações</th>
    </thead>
<?php
    foreach($categorias as $c){
        extract($c);
?> 
    <tbody>
        <td><?php echo $biblioteca_categoria_nome; ?></td>
        <td>
            <a href="<?php echo URL.'admin/categorias/editar/'.$biblioteca_categoria_id; ?>">Editar</a>
            <a href="<?php echo URL.'admin/categorias/excluir/'.$biblioteca_categoria_id; ?>">Excluir</a>
        </td>
    </tbody>
<?php }}?>
</table>