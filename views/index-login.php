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
    <link rel="stylesheet" href="/views/awes/css/font-awesome.min">
	<!-- Chrome, Firefox OS and Opera -->
	<meta name="theme-color" content="#000">
	<!-- Windows Phone -->
	<meta name="msapplication-navbutton-color" content="#000">
	<!-- iOS Safari -->
	<meta name="apple-mobile-web-app-status-bar-style" content="#000">
	<!-- 
	<style>body { opacity: 0; overflow-x: hidden; } html { background-color: #fff; }</style> -->

</head>
<style>

.alert {
	margin-top: -120px;
	margin-left: 70%;
	position: fixed;
	z-index: 999;
    padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
	width: auto;
    transition: 0.6s;
	margin-bottom: 15px;
}
.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
	font-weight: bold;
}
</style>
<script>
function cls(){
        var div = document.getElementsByClassName("alert")[0];
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
</script>
<body>
	
<?php if(isset($_SESSION["message"])):?>

	<div class="alert  noprint" >
  		<span class="closebtn"  onclick="cls();">&times;</span>  
  		<strong>Ошибка!!!</strong> <?php echo $_SESSION["message"];?>
	</div>
<?php unset($_SESSION["message"]); endif;?>


	<div class="login-form container-fluid col-lg-offset-5 col-lg-3 ">
	 <img src="/views/img/tsb.png" class="col-lg-4 col-md-4" style="margin: 20px; margin-left: 95px;" alt="">	
	<form action="user/cabinet" method="post" > 
		<select name="who" style="margin-left: 10px; padding-left: 5px; width:256px; height: 35px;">
			<option value="holder">Держатель</option>
			<option value="admin">Администратор</option>
			<option value="operator">Оператор</option>
		</select>
		<input type="text" id="login_id" size="30" placeholder="Логин" class="login-int" style="width: 255px; padding-left: 10px;" name="login"> 
		<input type="password" size="30" placeholder="Пароль" class="login-int" style="width: 255px; padding-left: 10px;" name="password">
		<input type="submit" value="Войти" class="login-int longbtn" style="width: 256px">
	</form>
	</div>	
	<link rel="stylesheet" href="/views/css/main.min.css">
	<script src="/views/js/scripts.min.js"></script>

</body>

</html>