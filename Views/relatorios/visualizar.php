<?php extract($relatorio); ?>
<h2>Relatório de: <?php echo $usuario_nome.' '.$usuario_sobrenome; ?></h2>
<p><b>Data do Atendimento: </b><?php echo $relatorio_atendimento_data;?></p>
<p><b>Data do Relatório: </b><?php echo $relatorio_data;?></p>
<p><b>Descrição do Atendimento: </b><?php echo $relatorio_descricao; ?></p>