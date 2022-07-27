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
				<a href="<?php echo URL.'impressao'; ?>">Impressão</a>
				<a href="<?php echo URL.'projetos'; ?>">Projetos</a>
				<a href="<?php echo URL.'agenda'; ?>">Agenda</a>
				<a href="<?php echo URL.'relatorios'; ?>">Relatórios</a>
				<a href="<?php echo URL.'usuarios'; ?>">Usuários</a>
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
