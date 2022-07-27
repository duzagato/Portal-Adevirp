<h2>Entrar</h2>
<form method="post" name="user_login" autocomplete="off">
    <input type="text" name="user_nickname" placeholder="digite o nome de usuário" autofocus required /><br>
    <input type="password" name="user_password" placeholder="digite sua senha" required /><br>
    <input type="checkbox" name="conected" id="conected" value="true" />
    <br><br>
    <input type="hidden" name="form_validation[user]" value="login" />
    <button type="submit" name="form_submit">Entrar</button>
</form>
<br><br>
<h2>Criar novo usuário</h2>

<form method="post" name="user_login" autocomplete="off">
    <div class="alerts">
        <?php
            if(isset($user_add) && !empty($user_add)){
                echo '<span>'.$user_add.'</span>';
            }
        ?>
    </div>
    <input type="text" name="user_first_name" placeholder="Digite o seu primeiro nome" required /><br>
    <input type="text" name="user_last_name" placeholder="Digite o seu sobrenome" required /><br>
    <input type="text" name="user_nickname" placeholder="Digite um nome de usuário" required /><br>
    <input type="email" name="user_email" placeholder="Digite um e-mail válido" required /><br>
    <input type="text" name="user_phone" placeholder="Digite o seu número de celular com o DDD" /><br>
    <input type="password" name="user_password" placeholder="digite sua senha" required /><br>
    <input type="password" name="user_cpassword" placeholder="confirme a senha digitada" required /><br>
    <select name="type_id" id="">
        <?php foreach($types as $t){; ?>
            <option value="<?php echo $t['type_id']; ?>"><?php echo $t['type_name']; ?></option>
        <?php }; ?>
    </select>
    <br><br>
    <input type="hidden" name="form_validation[user]" value="add" />
    <button type="submit" name="form_submit">Cadastrar</button>
</form>