<?php
    extract($projeto);
?>

<h2>Editar informações do projeto: <?php echo $projeto_nome; ?></h2>
<a href="<?php echo URL.'projetos'; ?>">voltar</a>

<form method="post" name="projetos/editar/<?php echo $projeto_id; ?>" id="projeto_edit">
    <label for="usuario_id">Criador: </label>
    <select name="usuario_id" id="usuario_id">
        <option value="<?php echo $usuario_id ;?>"><?php echo $usuario_nome.' '.$usuario_sobrenome; ?></option>
    <?php foreach($usuarios as $u){
        if($u['usuario_nome'].' '.$u['usuario_sobrenome'] != $usuario_nome.' '.$usuario_sobrenome){
    ?>
        <option value="<?php echo $u['usuario_id'] ;?>"><?php echo $u['usuario_nome'].' '.$u['usuario_sobrenome']; ?></option>
    <?php }}; ?>
    </select><br>
    <br><input type="text" name="projeto_nome" value="<?php echo $projeto_nome; ?>" placeholder="Digite o nome do projeto" required /><br>
    <textarea name="projeto_descricao" id="" cols="30" rows="10" required>
        <?php echo $projeto_nome; ?>
    </textarea><br><br>
    <button type="submit" name="form_submit" class="form_submit">Editar</button>
</form>

<script src="<?php echo URL.'assets/js/script.js'; ?>"></script>