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
<script>
function calc()
{
	idj = document.getElementById("sel_card").value;
	summj = document.getElementById("summ").value;
	currj = document.getElementById("curr").value;
	$.post("/user/calc",{curr:currj,id:idj,summ:summj},function(data){
		document.getElementById("sps").innerHTML = "&nbsp;&nbsp;"+data;
		document.getElementById("ammount").value = data.substr(1,data.length - 4);
		document.getElementById("amm_curr").value =data.substr(-3);
	});
	
}

function calccash()
{
	idj = document.getElementById("cash_card").value;
	summj = document.getElementById("cash_amm").value;
	currj = document.getElementById("cash_curr").value;
	$.post("/user/cash",{curr:currj,id:idj,summ:summj},function(data){
		document.getElementById("cash_sps").innerHTML = "&nbsp;&nbsp;"+data;
		document.getElementById("cash_val").value = data;	
	});
	
}
function cls(){
        var div = document.getElementsByClassName("alert")[0];
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
</script>
<style>

.alert {
	margin-top: 60px;
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
.print-form
{
	z-index: 999;
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

<body onload="calc()">
 
<?php if(isset($_SESSION["message"])):?>
	<div class="alert success noprint" >
  		<span class="closebtn"  onclick="cls();">&times;</span>  
  		<strong>Поздравляем!!!</strong> <?php echo $_SESSION["message"];?>
	</div>
<?php unset($_SESSION["message"]); endif;?>

<div class="mnu_line container-fluid row" style="padding-bottom: 5.4px;">

<div class="col-sm-2 col-sm-offset-1  col-md-1 col-lg-1 col-lg-offset-2 col-md-offset-2 ">
	<img class="logo" src="/views/img/tsb.png" alt="LOGO" /></div>
<ul class="col-lg-5 col-md-5 col-sm-5 ">
	<li class="active"><a href="/user/holder">Карты и операции</a></li>
	<li ><a href="/user/derzh">Выписка</a></li>
	<li><a href="/user/perevodi">Переводы</a></li>
</ul>
<div class="hello col-lg-4 col-lg-offset-8 col-md-offset-8 col-md-6 col-sm-offset-7e col-sm-6" style="
    margin-top: -53px;
">Приветствуем Вас, <?php echo $_SESSION["hname"];?><a href="/"><i class="fa fa-sign-out fa-3x" style="
    vertical-align: middle;
    margin-left: 30px;
"></i></a></div>
</div>

	<div class="container">
		<div class="row" style="margin-top: 20px">
			<div class="col-lg-5 col-md-6">
			<?php $i = 1; foreach($cards as $card):?>
				<div class="sms">
					<table class="card-tab">
						<th colspan="2" align="center" class="zagolovok">Карта №<?php echo $i?></th>
						<tr>
							<td>Тип карты:</td>
							<td><?php echo $card["type"]?></td>
						</tr>
						<tr>
							<td>Номер карты:</td>
							<td><?php echo $card["number"]?></td>
						</tr>
						<tr>
							<td>Дата активации:</td>
							<td><?php echo $card["activated"]?></td>
						</tr>
						<tr>
							<td>Действует до:</td>
							<td><?php echo $card["exp_date"]?></td>
						</tr>
						<tr>
							<td>Статус:</td>
							<td <?php echo $card["state"]=="Активный"?"class=\"ok\"":"class=\"exp\""?>>
							<?php echo $card["state"]?></td>
						</tr>
						<tr>
							<td>Баланс:</td>
							<td><?php echo $card["balance"]." ". $card["curr"];?></td>
						</tr>
					</table>

				</div>
				<?php $i++; endforeach;?>
			</div>

			<div class="container-fluid col-lg-offset-1 col-lg-6 col-md-6 ">
				<div class="sms" style="width: auto">
					<form action="/user/transfer" method="post">
					<table>
						<th class="zagolovok" colspan="2" align="center">Перевод</th>
						<tr><td>Карта: </td>
						<td>
							<select name="card_id" id="sel_card" onchange="calc()"  style=" width: 303px;
    height: 35px;
    margin-bottom: 10px;
    font-size: 11pt;" >
							<?php foreach($cards as $card):?>
								<option <?php echo "value=\"".$card["id"]."\"";?>>
									<?php echo $card["type"]." ".$card["number"]?>
								</option>
							<?php $i++; endforeach;?>
							</select>
						</td></tr>
						<tr>
							<td>Сумма:</td>
							<td  align="left"><input type="number" step="0.01"  oninput="calc();" id="summ" name="summ" value="1"></td>
						</tr>
					<tr><td>Валюта: </td>
						<td  align="left">
							<select name="curr" id="curr" onchange="calc()" style=" height: 35px; margin-bottom: 10px">
								<option value="8">TJS</option>
								<option value="1">USD</option>
								<option value="2">EUR</option>
							</select>
						</td>
						</tr>
					<tr>
						<td>Списывается:</td>
						<input type="text" hidden id="ammount" name="ammount">
						<input type="text" hidden id="amm_curr" name ="amm_curr">
						<td align="left" id="sps"> &nbsp;&nbsp;</td>
					</tr>
					<tr>
							<td>Получатель:</td>
							<td  align="left"><input type="text" size="17" min="1" name="receiver" ></td>
						</tr>
					<tr>
						<td colspan="2" align="right"><input type="submit" value="Перевести" class="longbtn"></td>
					</tr>
					</table>
					</form>
				</div>
				
				<div class="sms" style="width: auto">
					<form action="/user/snyatie" method="post">
					<table >
						<th class="zagolovok" colspan="2" align="center">Снятие денег</th>
						<tr><td>Карта: </td>
						<td>
						<select name="cash_cid" id="cash_card" onchange="calccash()"  style=" width: 303px;
    height: 35px;
    margin-bottom: 10px;
    font-size: 11pt;" >
							<?php foreach($cards as $card):?>
								<option <?php echo "value=\"".$card["id"]."\"";?>>
									<?php echo $card["type"]." ".$card["number"]?>
								</option>
							<?php endforeach;?>
							</select>
						</td></tr>
						<tr>

							<td>Сумма:</td>
							<td  align="left"><input type="number" step="0.01" oninput="calccash()" min="1" id="cash_amm" name="cash_amm"  value="1"></td>
						</tr>
					<tr><td>Валюта: </td>
						<td  align="left">
							<select id="cash_curr" name="cash_curr" onchange="calccash()" style=" height: 35px; margin-bottom: 10px">
								<option value="8">TJS</option>
								<option value="1">USD</option>
								<option value="2">EUR</option>
							</select>
						</td>
						</tr>
					<tr>
						<td>Списывается:</td> <input hidden name="sps" id="cash_val">
						<td align="left" id="cash_sps"></td>
					</tr>
					
					<tr>
						<td colspan="2" align="right"><input type="submit" value="Снять" class="longbtn"></td>
					</tr>
					</table>
				</form>
				</div>

			</div>



		</div>
	</div>



	<div class="footer col-md-12 col-sm-12">&copy; OAO "Тоджиксодиротбанк" 2017</div>
	<link rel="stylesheet" href="/views/css/main.min.css">
	<script src="/views/js/scripts.min.js"></script>

</body>

</html>