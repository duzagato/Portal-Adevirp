<h2>Entrar</h2>
<form method="post" name="login" id="usuario_login" autocomplete="off">
    <input type="text" name="usuario_apelido" placeholder="digite o nome de usuário" autofocus required /><br>
    <input type="password" name="usuario_senha" placeholder="digite sua senha" required /><br>
    <input type="checkbox" name="manter_conectado" id="manter_conectado" value="true" />
    <label for="manter_conectado">Manter conectado</label>
    <br><br>
    <button type="submit" name="form_submit">Entrar</button>
</form>
<br><br> 
<?php Controller::loadView('usuarios/adicionar', array('tipos'=>$tipos)); ?>