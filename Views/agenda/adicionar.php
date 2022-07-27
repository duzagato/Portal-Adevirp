<?php 
    $name = 'professor/'.$slug.'/agenda/adicionar/'.Helpers::strToSlug($dia).'/'.$aula
?>

<h2>Adicionar compromisso para a aula <?php echo $aula;?> de <?php echo $dia; ?></h2>
<a href="<?php echo URL.'professor/'.$slug.'/agenda/'; ?>">voltar</a>

<form method="post" name="<?php echo $name; ?>" id="agenda_add">
    <br><label for="educando_id">Educando: </label>
    <select name="educando_id" id="educando_id">
    <?php foreach($educandos as $e){
        extract($e);
    ?>
        <option value="<?php echo $usuario_id ;?>"><?php echo $usuario_nome.' '.$usuario_sobrenome; ?></option>
    <?php }; ?>
    </select><br>
    <br><input type="text" name="agenda_titulo" placeholder="Digite um título para a aula (opcional)" /><br>
    <button type="submit" name="form_submit" class="form_submit">Adicionar</button>
</form>

<script src="<?php echo URL.'assets/js/script.js'; ?>"></script>