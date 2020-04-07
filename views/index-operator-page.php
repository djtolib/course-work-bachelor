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

</head>
<!-- <script  src="/ui/external/jquery/jquery.js"></script>
<script  src="/ui/jquery-ui.js"></script> -->
<script src="/ui/jquery-3.2.1.min.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/ui/jquery-ui.css">
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/views/css/print.css" media="print" rel="stylesheet">
<link rel="stylesheet" href="/views/awes/css/font-awesome.css">

<script src="/views/js/scripts.min.js"></script>
<script src="/ui/jquery-ui.js" ></script>
<script>
	function pay_ch(pay_sys)
	{
		sel = document.getElementById("cardt");
		if(pay_sys == "visa")
		sel.innerHTML="<option value=\"Electron\">Electron</option>"+
			"<option value=\"Classic\">Classic</option>"+
			"<option value=\"Gold\">Gold</option>";
		else 
		sel.innerHTML="<option value=\"Maestro\">Maestro</option>"+
			"<option value=\"Standard\">Standard</option>"+
			"<option value=\"Gold\">Gold</option>";

	}
	
	function fst_ch(txt)
	{
		
		$.post("/user/tolatin",{name:txt},function(data){
			document.getElementById("emfst").value=data;
			});
	}
	function snd_ch(txt)
	{
		
		$.post("/user/tolatin",{name:txt},function(data){
			document.getElementById("emsnd").value=data;
			});
	}
	function sms(txt)
	{

		$.post("/user/livesr",{name:txt},function(data){
		var a = data.split(","); 
			$( "#sms_who" ).autocomplete({
			source: a
			});


		});
	}
	function inter(txt)
	{

		$.post("/user/livesr",{name:txt},function(data){
		var a = data.split(","); 
			$( "#inter_who" ).autocomplete({
			source: a
			});


		});
	}

function cls(){
        var div = document.getElementsByClassName("alert")[0];
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
function printform(){
        var div = document.getElementsByClassName("print-form")[0];
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
function usrcards(txt)
{
	$.post("/user/givec",{name:txt},function(data){
		var sel = document.getElementById("sms_card");
		sel.innerHTML = data;
	});		
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
<body>

<?php if(isset($_SESSION["message"])):?>
	<div class="alert success noprint" >
  		<span class="closebtn"  onclick="cls();">&times;</span>  
  		<strong>Поздравляем!!!</strong> <?php echo $_SESSION["message"];?>
	</div>
<?php unset($_SESSION["message"]); endif;?>


<div class="mnu_line container-fluid row noprint" style="padding-bottom: 5.4px;">
<div class="col-sm-2 col-sm-offset-1  col-md-2 col-lg-2 col-md-offset-2 ">
	<img class="logo" src="/views/img/tsb.png" alt="LOGO" /></div>
<div class="hello noprint col-lg-4 col-lg-offset-8 col-md-offset-8 col-md-6 col-sm-offset-7 col-sm-6" style="
    margin-top: -53px;
">
	Приветствуем Вас, Оператор <a href="/"><i class="fa fa-sign-out fa-3x" style="
    vertical-align: middle;
    margin-left: 30px;
"></i></a></div>
	 
</div>


<?php if(isset($_SESSION["iholder"])):?>
<div class="sms alert col-md-offset-4 print-form col-md-4" style="position: absolute; color: black;">
<div class="closebtn noprint" style="color: grey; font-size: 28pt;" onclick="printform()">&times;</div>
	<table align="center" >
		<tr><td colspan="2" align="center"><img src="/views/img/TSB.png" width="48" height="48" alt=""></td></tr>
		<tr> <td colspan="2" align="center" ><div class="print_name">ТОДЖИКСОДИРОТБАНК</div></td></tr>
            <tr>
                <td align="left">Держатель:&nbsp;&nbsp;&nbsp;&nbsp;</td><td align="left"><?php echo $_SESSION["iholder"];?></td>
            </tr>
            <tr>
                <td align="left">Логин:</td><td align="left"><?php echo $_SESSION["ilogin"];?></td>
            </tr>
            <tr>
                <td align="left">Пароль:</td><td align="left"><?php echo $_SESSION["ipasswd"];?></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><button onclick="window.print();" class="longbtn noprint">Распечатать</button></td>
            </tr>
        </table>
                  
    </div>
<?php unset($_SESSION["iholder"]); endif;?>


</div>
	<div class="container noprint">
		<div class="row" style="margin-top: 20px">
		<div class="col-lg-5 col-md-6">
				<div class="sms">
				<form action="/user/smsreg" method="post">
					<table>
						<tr>
							<td colspan="2" align="center" style="color: #1180B3; font-weight: bold; font-size:14pt">Подключение услуги SMS</td>
						</tr>
						<tr>
							<td>Кому:</td> 
							<td class="form-group " autocomplate="off">
								<input   oninput="sms(this.value);" size="45" onblur="usrcards(this.value);" class="txt-input form-control ui-autocomplete-input" name="sms_who" id="sms_who"></td>
						</tr>
						<tr>
							<td>Карта:</td> <td> 
								<select name="sms_card" class="form-control"  id="sms_card" >

								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="right"><input type="submit" class="longbtn" value="Подключить"></td>
						</tr>
					</table>
				</form>
				</div> 
			<div class="sms">
				<form action="/user/bank" method="post">
					<table>
						<tr>
							<td colspan="2" align="center" style="color: #1180B3; font-weight: bold; font-size:14pt">Подключение интернет-банкинга</td>
						</tr>
						<tr>
							<td>Кому:&nbsp;</td> <td><input type="text" size="45" oninput="inter(this.value);" class="txt-input form-control ui-autocomplete-input" id="inter_who" name="int"></td>
						</tr>
						
						<tr>
							<td colspan="2" align="right"><input type="submit" class="longbtn" value="Подключить"></td>
						</tr>
					</table>
				</form>
				</div> 	
		</div>
		
			<div class="register  container-fluid col-lg-offset-2 col-lg-5 col-md-6 ">

				<form action="/user/operator/regis" method="post">
					<table>
						<tr>
							<td colspan="2" align="center" style="color: #1180B3; font-weight: bold; font-size:14pt">Регистрация новой карты</td>
						</tr>
						<tr>
							<td>Платежная система:</td>
							<td><select name="paysys" class="form-control" onchange="pay_ch(this.value);">
			<option value="visa">VISA</option>
			<option value="mastercard">MASTERCARD</option>
		</select></td>
						</tr>
						<tr>
							<td>Тип продукта:</td>
							<td><select name="type" id="cardt" class="form-control"  >
									<option value="Electron">Electron</option>
									<option value="Classic">Classic</option>
									<option value="Gold">Gold</option>
							</select></td>
						</tr>
						<tr>
							<td>Валюта:</td>
							<td><select name="curr" class="form-control" >
			<option value="8">Сомони</option>
			<option value="1">Доллар</option>
			<option value="2">Евро</option>
		</select></td>
						</tr>
						<tr>
							<td>Первоначальный взнос:</td>
							<td><input type="number" step="0.01" size="30" class="txt-input form-control" name="balance"> </td>
						</tr>
						<tr>
							<td>Фамилия:</td>
							<td><input type="text" size="30" oninput="fst_ch(this.value);" class="txt-input form-control"  name="firsname"> </td>
						</tr>
						<tr>
							<td>Имя:</td>
							<td><input type="text" size="30" oninput="snd_ch(this.value);" class="txt-input form-control" name="name"> </td>
						</tr>
						<tr>
							<td>Отчество:</td>
							<td><input type="text" size="30" class="txt-input form-control" name="lastname"> </td>
						</tr>

						<tr>
							<td>Эмбоссируемая Фамилия:</td>
							<td><input type="text" size="30" class="txt-input form-control" name="emfirst" id="emfst"></td>
						</tr>
						<tr>
							<td>Эмбоссируемое имя:</td>
							<td><input type="text" size="30" class="txt-input form-control"  name="emsecond" id="emsnd"></td>
						</tr>

						<tr>
							<td>Пол:</td>
							<td align="left"><select name="gender" class="form-control">
							<option value="male">Мужской</option>
							<option value="female">Женский</option>
							
						</select></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td><input type="email" size="30" class="txt-input form-control" name="mail"></td>
						</tr>

						<tr>
							<td>Телефон:</td>
							<td><input type="text" size="30" class="txt-input form-control" name="tel"></td>
						</tr>

						<tr>
							<td>Телефонный пароль:</td>
							<td><input type="text" size="30" class="txt-input form-control" name="telpar"></td>
						</tr>


						<tr>
							<td>Страна:</td>
							<td><input type="text" size="30" class="txt-input form-control" name="country"></td>
						</tr>
						<tr>
							<td>Адрес:</td>
							<td><input type="text" size="30" class="txt-input form-control" name="address"></td>
						</tr>
						<tr>
							<td>Дата рождения:</td>
							<td><input type="date" class="txt-input form-control" size="30" name="dater"></td>
						</tr>
						<tr>
							<td>Серия и номер паспорта:</td>
							<td><input type="text" size="30" class="txt-input form-control" name="passport"></td>
						</tr>
						<tr>
							<td colspan="2" align="right" ><input style="width: 54.6%" type="submit" class="longbtn" value="Зарегистрировать"></td>
						</tr>
					</table>
				</form>
			</div>
			
		
		</div>
	</div>


		
	<div class="footer noprint col-md-12 col-sm-12">&copy; OAO "Тоджиксодиротбанк" 2017</div>
			<link rel="stylesheet" href="/views/css/main.min.css">
			

</body>

</html>