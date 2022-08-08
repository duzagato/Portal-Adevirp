<?php extract($professor); ?>
<h2>Agenda de <?php echo $usuario_nome.' '.$usuario_sobrenome; ?></h2>
<table>
    <thead>
        <th>Aula</th>
        <th>Segunda-Feira</th>
        <th>Terça-Feira</th>
        <th>Quarta-Feira</th>
        <th>Quinta-Feira</th>
        <th>Sexta-Feira</th>
    </thead>

    <?php
        for($i = 1; $i <= 8; $i++){
    ?>
        <tbody>
            <td>Aula <?php echo $i.': '.Helpers::getLessonTime()[$i]; ?></td>
            <?php for($d = 1; $d <= 5; $d++){; ?>
                <td>
                    <span>
                    <?php
                        foreach($agenda as $a){
                            extract($a);
                            if(Helpers::getDaysNumberBySlug()[$agenda_dia] == $d && $agenda_aula == $i){
                                echo $usuario_nome.' '.$usuario_sobrenome;

                                if($agenda_titulo != ''){
                                    echo ' ('.$agenda_titulo.')';
                                }

                                echo ' <a href="'.URL.'agenda/excluir/'.$agenda_id.'">x</a>';

                                echo '<br>';
                            }
                        }
                    ?>
                    </span>
                    <a href="<?php echo URL.'agenda/'.$usuario_slug.'/adicionar/'.Helpers::strToSlug(Helpers::getDaysByNumber()[$d]).'/'.$i ;?>">Adicionar</a>
                </td>
            <?php }; ?>
        </tbody>
    <?php }; ?>
</table>