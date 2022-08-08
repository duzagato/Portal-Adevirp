<h2>Adicionar Usuário</h2>

<form method="post" name="cadastrar" id="usuario_add">
    <input type="text" name="usuario_nome" placeholder="Digite o primeiro nome" required /><br>
    <input type="text" name="usuario_sobrenome" placeholder="Digite o sobrenome" required /><br>
    <input type="email" name="usuario_email" placeholder="Digite o e-mail" /><br>
    <input type="text" name="usuario_celular" placeholder="Digite o número de celular" required /><br>
    <label for="usuario_genero">Gênero: </label>
    <select name="usuario_genero" id="usuario_genero">
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
    </select><br>
    <label for="usuario_visao">Visão: </label>
    <select name="usuario_visao" id="usuario_visao">
        <option value="Baixa">Baixa</option>
        <option value="Cego">Cego</option>
        <option value="Normal">Normal</option>
    </select><br>
    <label for="tipo_id">Tipo: </label>
    <select name="tipo_id" id="tipo_id">
        <?php foreach($tipos as $t){
            extract($t);
        ?>
            <option value="<?php echo $tipo_id; ?>"><?php echo $tipo_nome;?></option>
        <?php }; ?>
    </select><br><br>
    <input type="text" name="usuario_apelido" placeholder="Digite um nome de usuário" /><br> 
    <input type="password" name="usuario_senha" placeholder="Digite uma senha com no mínimo 8 caracteres e no máximo 30 caracteres" /><br>
    <input type="password" name="usuario_csenha" placeholder="confirme a senha digitada" /><br><br>
    <button type="submit" name="form_submit" class="form_submit">Adicionar</button>
</form>

<script src="<?php echo URL.'assets/js/script.js'; ?>"></script>