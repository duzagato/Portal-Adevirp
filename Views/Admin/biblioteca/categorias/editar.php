<h2>Editar Categoria</h2>
<form method="post" name="admin/categorias/editar/<?php echo $id; ?>">
    <input type="text" name="biblioteca_categoria_nome" value="<?php echo $biblioteca_categoria_nome;?>" placeholder="digite o nome da categoria" required /><br></br>
    <button type="submit" name="form_submit" class="form_submit">Adicionar</button>
</form>

<script src="<?php echo URL.'assets/js/script.js'; ?>"></script>