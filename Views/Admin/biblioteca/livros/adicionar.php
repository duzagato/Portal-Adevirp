<a href="<?php echo URL.'admin/biblioteca'; ?>">voltar para biblioteca</a>
<h2>Adicionar Livro</h2>

<form method="post" enctype="multipart/form-data" name="admin/livros/adicionar">
    <input type="text" name="biblioteca_livro_titulo" placeholder="digite o título do livro" required /><br>
    <label for="biblioteca_livro_sinopse">Sinopse: </label><br>
    <textarea name="biblioteca_livro_sinopse" id="biblioteca_livro_sinopse" cols="30" rows="10" required></textarea><br><br>
    <label for="biblioteca_livro_arquivo">Arquivo de Áudio: </label><br>
    <input type="file" name="biblioteca_livro_arquivo" id="biblioteca_livro_capa" required /><br><br>
    <input type="number" name="biblioteca_livro_paginas" placeholder="Número de Páginas" /><br><br>
    <label for="biblioteca_livro_capa">Capa do Livro: </label><br>
    <input type="file" name="biblioteca_livro_capa" id="biblioteca_livro_capa" required /><br><br>
    <input type="text" name="biblioteca_autor_nome" placeholder="digite o nome completo do autor" required /><br>
    <label>Categoria(s):</label>
    <?php foreach($categorias as $c){
        extract($c);
    ?>
    <input type="checkbox" name="biblioteca_categoria_id[]" id="<?php echo $biblioteca_categoria_nome; ?>" value="<?php echo $biblioteca_categoria_id; ?>" />
    <label for="<?php echo $biblioteca_categoria_nome; ?>"><?php echo $biblioteca_categoria_nome; ?></label>
    <?php }; ?>
    <br><br>
    <button  type="submit" name="form_submit" class="form_submit">Solicitar</button>
</form>

<script src="<?php echo URL.'assets/js/script.js'; ?>"></script>