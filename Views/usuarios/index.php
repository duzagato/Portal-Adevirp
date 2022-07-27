<h2>Usuários</h2>

<a href="<?php echo URL.'usuarios/adicionar'; ?>">Adicionar Usuário</a>

<table>
    <thead>
        <th>#</th>
        <th>Nome</th>
        <th>Apelido</th>
        <th>E-Mail</th>
        <th>Celular</th>
        <th>Tipo</th>
        <th>Opções</th>
    </thead>

    <?php 
        foreach($usuarios as $c){
            extract($c);
    ?>
    <tbody>
        <td><?php echo $usuario_id; ?></td>
        <td>
            <?php
                if($tipo_nome === 'Administrador'){
                    echo $usuario_nome.' '.$usuario_sobrenome;
                }else{
                    $slug = Helpers::strToSlug($tipo_nome).'/'.$usuario_slug;
            ?>
            <a href="<?php echo $slug;?>">
                <?php
                    echo $usuario_nome.' '.$usuario_sobrenome;
                ?>
            </a>
            <?php }; ?>
        </td>
        <td><?php echo $usuario_apelido; ?></td>
        <td><?php echo $usuario_email; ?></td>
        <td><?php echo $usuario_celular; ?></td>
        <td><?php echo $tipo_nome; ?></td>
        <td>
            <?php if($tipo_nome != 'Administrador'){; ?>
                <a href="<?php echo URL.'usuarios/editar/'.$usuario_id; ?>">Editar</a>
                <a href="<?php echo URL.'usuarios/excluir/'.$usuario_id; ?>">Excluir</a>
            <?php }; ?>
        </td>
    </tbody>

    <?php }; ?>
</table>