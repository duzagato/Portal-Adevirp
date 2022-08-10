<?php extract($livro); ?>

<a href="<?php echo URL.'admin/biblioteca'; ?>">voltar para biblioteca</a>
<h2>Editar Livro</h2>

<form method="post" enctype="multipart/form-data" name="admin/livros/editar/<?php echo $biblioteca_livro_id; ?>">
    <input type="text" name="biblioteca_livro_titulo" value="<?php echo $biblioteca_livro_titulo;?>" placeholder="digite o título do livro" required /><br>
    <label for="biblioteca_livro_sinopse">Sinopse: </label><br>
    <textarea name="biblioteca_livro_sinopse" id="biblioteca_livro_sinopse" cols="30" rows="10" required>
        <?php echo $biblioteca_livro_sinopse;?>
    </textarea><br><br>
    <label for="biblioteca_livro_arquivo">Arquivo de Áudio: </label><br>
    <input type="file" name="biblioteca_livro_arquivo" id="biblioteca_livro_capa" /><br><br>
    <input type="number" name="biblioteca_livro_paginas" value="<?php echo $biblioteca_livro_paginas;?>" placeholder="Número de Páginas" /><br><br>
    <label for="biblioteca_livro_capa">Capa do Livro: </label><br>
    <input type="file" name="biblioteca_livro_capa" id="biblioteca_livro_capa" /><br><br>
    <input type="text" name="biblioteca_autor_nome" value="<?php echo $biblioteca_autor_nome;?>" placeholder="digite o nome completo do autor" required /><br>
    <label>Categoria(s):</label>
    <?php 
        $livro_categorias = Database::query('SELECT biblioteca_categoria.biblioteca_categoria_nome FROM biblioteca_categoria, biblioteca_livro, livro_categoria WHERE livro_categoria.biblioteca_livro_id = :id AND biblioteca_categoria.biblioteca_categoria_id = livro_categoria.biblioteca_categoria_id', array(':id'=>$biblioteca_livro_id));
        if($livro_categorias != array()){
            foreach($livro_categorias as $lc){
                $values[] = $lc['biblioteca_categoria_nome'];
            }

            $lc = array_unique($values);
        }else{
            $lc = array();
        }

        foreach($categorias as $c){
            extract($c);
    ?>
    <input type="checkbox" name="biblioteca_categoria_id[]" id="<?php echo $biblioteca_categoria_nome; ?>" value="<?php echo $biblioteca_categoria_id; ?>" <?php if(in_array($biblioteca_categoria_nome, $lc)){echo 'checked';}?> />
    <label for="<?php echo $biblioteca_categoria_nome; ?>"><?php echo $biblioteca_categoria_nome; ?></label>
    <?php }; ?>
    <br><br>
    <button  type="submit" name="form_submit" class="form_submit">Solicitar</button>
</form>

<script src="<?php echo URL.'assets/js/script.js'; ?>"></script>