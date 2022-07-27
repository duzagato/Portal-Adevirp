<h2>Adicionar Projeto</h2>
<a href="<?php echo URL.'projetos'; ?>">voltar</a>

<form method="post" name="projetos/adicionar" id="projeto_add">
    <br><label for="usuario_id">Criador: </label>
    <select name="usuario_id" id="usuario_id">
    <?php foreach($usuarios as $u){
        extract($u);
    ?>
        <option value="<?php echo $usuario_id ;?>"><?php echo $usuario_nome.' '.$usuario_sobrenome; ?></option>
    <?php }; ?>
    </select><br>
    <br><input type="text" name="projeto_nome" placeholder="Digite o nome do projeto" required /><br>
    <textarea name="projeto_descricao" id="" cols="30" rows="10" required></textarea><br><br>
    <button type="submit" name="form_submit" class="form_submit">Adicionar</button>
</form>

<script src="<?php echo URL.'assets/js/script.js'; ?>"></script>