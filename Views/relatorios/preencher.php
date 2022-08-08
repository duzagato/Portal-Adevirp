<h2>Preencher Relatório</h2>

<form id="relatorio_add" method="post" name="relatorios/joao-pedro/preencher/<?php echo $educando_id;?>/<?php echo $data; ?>">
    <label for="relatorio_descricao">Descrição do atendimento: </label><br>
    <textarea name="relatorio_descricao" id="atendimento_descricao" cols="30" rows="10" require></textarea><br><br>
    <button type="submit" name="form_submit" class="form_submit">Enviar</button>
</form>

<script src="<?php echo URL.'assets/js/script.js'; ?>"></script>