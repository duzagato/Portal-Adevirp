<?php extract($projetos); ?>
<h2>Projetos</h2>

<a href="<?php echo URL.'projetos/adicionar'; ?>">Adicionar Projeto</a>

<table>
    <thead>
        <th>#</th>
        <th>Nome do Projeto</th>
        <th>Criador</th>
        <th>Data de criação</th>
        <th>Opções</th>
    </thead>

    <?php 
        $c = 0;
        foreach($projetos as $p){
            $c++;
            extract($p);
    ?>
    <tbody>
        <td><?php echo $c; ?></td>
        <td><?php echo $projeto_nome; ?></td>
        <td><?php echo $usuario_nome.' '.$usuario_sobrenome; ?></td>
        <td><?php echo $projeto_data; ?></td>
        <td>
            <a href="<?php echo URL.'projetos/editar/'.$projeto_id; ?>">Editar</a>
            <a href="<?php echo URL.'projetos/excluir/'.$projeto_id; ?>">Excluir</a>
        </td>
    </tbody>

    <?php }; ?>
</table>