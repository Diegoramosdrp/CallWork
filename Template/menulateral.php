<?php
$menu = paginasPermitidas(basename($_SERVER ['PHP_SELF']), $_SESSION['a']['permissao_id'], 0);
?>

<div class="well menu-height"> 
    <ul class="nav nav-stacked" id="sidebar">
        <?php foreach ($menu as $m => $permissao):?>
        <?php foreach ($permissao as $p):?>
        <?php if ($p == $_SESSION['a']['permissao_id'] && $m != 'DetalhesChamado.php'):?>
        <li><a href="./<?php echo $m; ?>"><?php echo reset($permissao);?></a></li>
        <?php endif;?>
        <?php endforeach;?>
        <?php endforeach;?>
    </ul>
</div>
