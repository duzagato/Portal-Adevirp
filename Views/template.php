<?php extract($usuario); ?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Estrutura MVC</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<style>
			*{margin:0; padding:0; box-sizing:border-box;}
			table{width:99vs;}
			th, td{padding:20px; text-align:center;}
		</style>
	</head>

	<body>
		<header>
			<nav>
				<div class="principal">
					<a href="">Atividades</a>
					<a href="">Downloads</a>
					<a href="">Biblioteca</a>
					<a href="">Rádio</a>
					<a href="">Podcasts</a>
					<a href=""></a>
					<a href=""></a>
				</div>
				<div class="usuario">
					<span><?php echo $usuario_nome.' '.$usuario_sobrenome;?></span>
					<a href="<?php echo URL.'agenda';?>">Minha Agenda</a>
					<a href="<?php echo URL.'relatorios/';?>">Meus Relatórios</a>
					<a href=""></a>
					<a href=""></a>
					<a href=""></a>
				</div>
				<div class="admin">
					<span>Administração: </span>
					<a href="<?php echo URL.'admin/biblioteca'; ?>">Biblioteca</a>
					<a href="<?php echo URL.'admin/impressoes'; ?>">Impressões</a>
					<a href="<?php echo URL.'admin/projetos'; ?>">Projetos</a>
					<a href="<?php echo URL.'admin/agendas'; ?>">Agenda</a>
					<a href="<?php echo URL.'admin/relatorios'; ?>">Relatórios</a>
					<a href="<?php echo URL.'admin/usuarios'; ?>">Usuários</a>
				</div>
				<a href="<?php echo URL.'sair'; ?>">Sair</a>
			</nav>
		</header>

		<section style="padding: 10px; margin:20px auto;">
			<?php self::loadView($viewName, $viewData); ?>
		</section>

		<footer>
			
		</footer>


		<script src="<?php echo URL.'assets/js/script.js'; ?>"></script>
	</body>
</html>
