<h2>Agendas</h2>

<h3>Professores</h3>
<table>
    <thead>
        <th>Professor</th>
        <th>Opções</th>
    </thead>

    <?php foreach($professores as $p){
        extract($p);
    ?>
    <tbody>
        <td><?php echo $usuario_nome.' '.$usuario_sobrenome; ?></td>
        <td><a href="<?php echo URL.'agenda/'.$usuario_slug; ?>">Ver Agenda</a></td>
    </tbody>
    <?php }; ?>
</table>