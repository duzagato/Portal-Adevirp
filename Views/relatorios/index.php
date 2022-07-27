<h2>Relatórios</h2>

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
        <td><a href="<?php echo URL.'relatorios/'.$usuario_slug; ?>">Ver Relatórios</a></td>
        <td><a href="<?php echo URL.'relatorios/'.$usuario_slug.'/pendentes'; ?>">Relatórios Pendentes</a></td>
    </tbody>
    <?php }; ?>
</table>