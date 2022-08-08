<?php
    extract($usuario);
?>

<h2>Editar usuariormações do usuário: <?php echo $usuario_nome.' '.$usuario_sobrenome; ?></h2>
<a href="<?php echo URL.'usuarios'; ?>">voltar</a>

<form method="post" name="usuarios/editar/<?php echo $usuario_id; ?>" id="usuario_edit">
    <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>" />
    <input type="text" name="usuario_nome" value="<?php echo $usuario_nome ;?>" placeholder="Digite o primeiro nome do usuario" required /><br>
    <input type="text" name="usuario_sobrenome" value="<?php echo $usuario_sobrenome ;?>" placeholder="Digite o último nome do usuario" required /><br>
    <input type="email" name="usuario_email" value="<?php echo $usuario_email ;?>" placeholder="Digite o e-mail do usuario" /><br>
    <input type="text" name="usuario_celular" value="<?php echo $usuario_celular ;?>" placeholder="Digite o núm34oce3 d3lulq4 do usuario" required /><br>
    <label for="usuario_genero">Gênero: </label>
    <select name="usuario_genero" id="usuario_genero">
        <option value="<?php echo $usuario_genero; ?>"><?php echo $usuario_genero; ?></option>
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
    </select><br>
    <label for="usuario_visao">Visão: </label>
    <select name="usuario_visao" id="usuario_visao">
    <option value="<?php echo $usuario_visao; ?>"><?php echo $usuario_visao; ?></option>
        <option value="Baixa">Baixa</option>
        <option value="Cego">Cego</option>
        <option value="Normal">Normal</option>
    </select><br>
    <label for="tipo_id">Tipo: </label>
    <select name="tipo_id" id="tipo_id">
        <option value="<?php echo $tipo_id; ?>"><?php echo $tipo_nome; ?></option>
        <?php foreach($tipos as $t){
            if($t['tipo_nome'] != $tipo_nome){
        ?>
            <option value="<?php echo $t['tipo_id']; ?>"><?php echo $t['tipo_nome'];?></option>
        <?php }}; ?>
    </select><br><br>
    <input type="text" name="usuario_apelido" value="<?php echo $usuario_apelido; ?>" placeholder="Digite um nome de usuário" /><br> 
    <input type="password" name="usuario_senha" placeholder="Digite uma senha com no mínimo 8 caracteres e no máximo 30 caracteres" /><br>
    <input type="password" name="usuario_csenha" placeholder="confirme a senha digitada" /><br><br>
    <button type="submit" name="form_submit" class="form_submit">Editar</button>
</form>

<script src="<?php echo URL.'assets/js/script.js'; ?>"></script>