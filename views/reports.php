<!DOCTYPE html>
<html lang="ru">

<head>
	<style type="text/css">

	</style>

	<meta charset="utf-8">

	<title>Тоджиксодиротбанк</title>
	<meta name="description" content="">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<meta property="og:image" content="path/to/image.jpg">
	<link rel="shortcut icon" href="img/" type="image/x-icon">
	<link rel="apple-touch-icon" href="img/favicon/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png">
     <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#000">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#000">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#000">
	<!-- 
	<style>body { opacity: 0; overflow-x: hidden; } html { background-color: #fff; }</style> -->
	<link rel="stylesheet" href="/views/awes/css/font-awesome.css">
</head>
<style>
.reptable 
{
	margin-top: 15px;
	
}
td 
{
	display: table-cell;
	padding: 10px;
}
.rep-item 
{
	text-decoration: none;
	
	color: black;
}
.rep-tem:hover 
{
	text-decoration: none;
}
.active 
{
	font-weight: bolder;
	color: #1180b3;
}
</style>

<body><div class="mnu_line container-fluid row" style="padding-bottom: 5.4px;">
		<div class="col-sm-2 col-sm-offset-1  col-md-2 col-lg-2 col-md-offset-2 ">
			<img class="logo" src="/views/img/tsb.png" alt="LOGO" /></div>
		<div class="hello col-lg-4 col-lg-offset-8 col-md-offset-8 col-md-6 col-sm-offset-7e col-sm-6" style="
    margin-top: -53px;
">Приветствуем Вас, Администратор!!!<a href="/"><i class="fa fa-sign-out fa-3x" style="
    vertical-align: middle;
    margin-left: 30px;
"></i></a></div>
	</div>

	<div class="container">
		<div class="row rep-page">
			<div class="col rep-menu col-lg-3 col-md-4 ">
				
					<a href="/user/reptran" onclick="seta(0);" class="rep-item <?php echo $reptype == "reptran"?"active":""?>">
					Транзакционный отчёт</a><br>
					<a href="/user/million" onclick="seta(1);" class="rep-item <?php echo $reptype == "million"?"active":""?>">ТОП 10 миллионеров среди держателей</a><br>
					<a href="/user/fees" onclick="seta(2);" class="rep-item <?php echo $reptype == "fees"?"active":""?>">Доходы от комиссий</a><br>
					<a href="/user/repcards" onclick="seta(3);" class="rep-item <?php echo $reptype == "repcards"?"active":""?>">Количество выпущенных карт</a><br>
					<a href="/user/tsp" onclick="seta(4);" class="rep-item <?php echo $reptype == "tsp"?"active":""?>">Неработающие ТСП</a><br>
					<a href="/user/transfers" onclick="seta(5);" class="rep-item <?php echo $reptype == "transfers"?"active":""?>">Переводы</a><br>
					<a href="/user/oldcards" onclick="seta(6);" class="rep-item <?php echo $reptype == "oldcards"?"active":""?>">Просроченные карты</a><br>
					<a href="/user/hot" onclick="seta(7);" class="rep-item <?php echo $reptype == "hot"?"active":""?>">"Горячие" точки в стране</a><br>
					<a href="/user/atms" onclick="seta(8);" class="rep-item <?php echo $reptype == "atms"?"active":""?>">Банкоматы с низким балансом</a><br>
			</div>
			<div id="rep_frm">
					<div class="rep-form col-lg-9 col-md-8">
						
						<?php if($reptype == "reptran"):?>
							<form action="/user/reptran" method="post">
							<span>С:</span>
							<input type="date" value="2017-09-01" name="bdate">
							<span>До:</span>
							<input type="date" value="2017-11-24" name="edate">
						<?php endif;?>
						<?php if($reptype == "million"):?>
							<form action="/user/million" method="post">
						<?php endif;?>
						<?php if($reptype == "fees"):?>
							<form action="/user/fees" method="post">
						<?php endif;?>
						<?php if($reptype == "repcards"):?>
							<form action="/user/repcards" method="post">
						<?php endif;?>
						<?php if($reptype == "tsp"):?>
							<form action="/user/tsp" method="post">
						<?php endif;?>
						<?php if($reptype == "transfers"):?>
							<form action="/user/transfers" method="post">
							<span>С:</span>
							<input type="date" value="2017-01-01" name="bdate">
							<span>До:</span>
							<input type="date" value="2017-11-24" name="edate">
						<?php endif;?>
						<?php if($reptype == "oldcards"):?>
							<form action="/user/oldcards" method="post">
						<?php endif;?>
						<?php if($reptype == "hot"):?>
							<form action="/user/hot" method="post">
						<?php endif;?>
						<?php if($reptype == "atms"):?>
							<form action="/user/atms" method="post">
						<?php endif; ?>
						<input type="text" hidden value="yes" name="post">
						<input type="submit" class="longbtn" style="width: 160px; font-size: 12pt;" value="сформировать">
						</form>
						<?php echo $res; ?>																
					</div>
			</div>
		</div>
	</div>
	
	<div class="footer col-md-12 col-sm-12">&copy; OAO "Тоджиксодиротбанк" 2017</div>
	<link rel="stylesheet" href="/views/css/main.min.css">
	<script src="/views/js/scripts.min.js"></script>

</body>

</html>