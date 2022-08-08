<h2>Últimos Relatórios</h2>
<table>
    <thead>
        <th>Educando</th>
        <th>Data do Atendimento</th>
        <th>Data de Envio do Relatório</th>
        <th>Opções</th>
    </thead>
    <?php
        foreach($ultimos_relatorios as $u){
            extract($u);
    ?>
        <tbody>
            <td><?php echo $usuario_nome.' '.$usuario_sobrenome; ?></td>
            <td><?php echo date('d/m/Y', $relatorio_atendimento_data);?></td>
            <td><?php echo date('d/m/Y', $relatorio_data); ?></td>
            <td>
                <?php
                    if($relatorio_presenca == 0){
                        echo '<span>Falta</span>';
                    }else{
                ?>
                <a href="<?php echo URL.'relatorios/visualizar/'.$relatorio_id; ?>">Ver</a>
                <?php }; ?>
            </td>
        </tbody>
    <?php }; ?>
</table>
<h2>Relatórios Pendentes</h2>
<table>
<thead>
    <th>Educando</th>
    <th>Data</th>
    <th>Ações</th>
</thead>
<?php
    foreach($agenda as $a){
        extract($a);
        $data = date('d-m-Y', $agenda_inc_data);
        $fim = date('d-m-Y', time());
        $i = 0; 

        while(strtotime($data) <= strtotime($fim)){
            if(!Database::query('SELECT relatorio_id FROM relatorio WHERE educando_id = :educando_id AND relatorio_atendimento_data = :data', array(':educando_id'=>$educando_id, ':data'=>$data))){
                
?>
    <tbody>
        <td><?php echo $usuario_nome.' '.$usuario_sobrenome; ?></td>
        <td><?php echo date('d/m/Y', strtotime($data));?></td>
        <td>
            <a href="<?php echo URL.substr(REQUEST, 1).'/preencher/'.$educando_id.'/'.strtotime($data); ?>">Preencher Relatório</a>
            <a href="<?php echo URL.substr(REQUEST, 1).'/falta/'.$educando_id.'/'.strtotime($data); ?>">Falta</a>
        </td>
    </tbody>
<?php
            }
            $data = date('d-m-Y', strtotime($data) + (60 * 60 * 24 * 7));
        }
    }
?>
</table>