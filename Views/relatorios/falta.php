<?php
    extract($educando);
    echo '<h2>'.$usuario_nome.' '.$usuario_sobrenome.' esteve ausente no dia '.date('d/m/Y', $data).'?</h2>';
?>

<a href="<?php echo URL.'relatorios/'.$_SESSION['ADEVIRP_SLUG'].'/cfalta/'.$usuario_id.'/'.$data; ?>">Sim</a>
<a href="<?php echo URL.'relatorios/'.$_SESSION['ADEVIRP_SLUG']; ?>">Não</a>