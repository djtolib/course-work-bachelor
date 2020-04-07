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
<style>

.form-control {
  display: inline;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
       -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
          transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
}
.form-control:focus {
  border-color: #66afe9;
  outline: 0;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, .6);
}
.form-control::-moz-placeholder {
  color: #999;
  opacity: 1;
}
.form-control:-ms-input-placeholder {
  color: #999;
}
.form-control::-webkit-input-placeholder {
  color: #999;
}
.form-control::-ms-expand {
  background-color: transparent;
  border: 0;
}
.form-control[disabled],
.form-control[readonly],
fieldset[disabled] .form-control {
  background-color: #eee;
  opacity: 1;
}
.form-control[disabled],
fieldset[disabled] .form-control {
  cursor: not-allowed;
}
 

table {
	overflow:hidden;
	border:1px solid #d3d3d3;
	background:#fefefe;
	-moz-border-radius:5px; /* FF1+ */
	-webkit-border-radius:5px; /* Saf3-4 */
	border-radius:5px;
	-moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
	-webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.2);
}

th, td {padding:18px 28px 18px; text-align:center; }

th {padding-top:22px; text-shadow: 1px 1px 1px #fff; background:#e8eaeb;}

td {border-top:1px solid #e0e0e0; border-right:1px solid #e0e0e0;}

tr.odd-row td {background:#f6f6f6;}

td.first, th.first {text-align:left}

td.last {border-right:none;}


td {
	background: -moz-linear-gradient(100% 25% 90deg, #fefefe, #f9f9f9);
	background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f9f9f9), to(#fefefe));
}

tr.odd-row td {
	background: -moz-linear-gradient(100% 25% 90deg, #f6f6f6, #f1f1f1);
	background: -webkit-gradient(linear, 0% 0%, 0% 25%, from(#f1f1f1), to(#f6f6f6));
}

th {
	background: -moz-linear-gradient(100% 20% 90deg, #e8eaeb, #ededed);
	background: -webkit-gradient(linear, 0% 0%, 0% 20%, from(#ededed), to(#e8eaeb));
}

tr:first-child th.first {
	-moz-border-radius-topleft:5px;
	-webkit-border-top-left-radius:5px; /* Saf3-4 */
}

tr:first-child th.last {
	-moz-border-radius-topright:5px;
	-webkit-border-top-right-radius:5px; /* Saf3-4 */
}

tr:last-child td.first {
	-moz-border-radius-bottomleft:5px;
	-webkit-border-bottom-left-radius:5px; /* Saf3-4 */
}

tr:last-child td.last {
	-moz-border-radius-bottomright:5px;
	-webkit-border-bottom-right-radius:5px; /* Saf3-4 */
}

</style>
<body>

<div class="mnu_line container-fluid row" style="padding-bottom: 5.4px;">

<div class="col-sm-2 col-sm-offset-1  col-md-1 col-lg-1 col-lg-offset-2 col-md-offset-2 ">
	<img class="logo" src="/views/img/tsb.png" alt="LOGO" /></div>
<ul class="col-lg-5 col-md-5 col-sm-5 ">
	<li ><a href="/user/holder">Карты и операции</a></li>
	<li ><a href="/user/derzh">Выписка</a></li>
	<li class="active"><a href="/user/perevodi">Переводы</a></li>
</ul>
<div class="hello col-lg-4 col-lg-offset-8 col-md-offset-8 col-md-6 col-sm-offset-7e col-sm-6" style="
    margin-top: -53px;
">Приветствуем Вас, <?php echo $_SESSION["hname"];?><a href="/"><i class="fa fa-sign-out fa-3x" style="
    vertical-align: middle;
    margin-left: 30px;
"></i></a></div>
</div>

<!-- 
	<div class="col rep-menu col-lg-3 col-md-4 ">
			
				<a href="#" class="rep-item">Выписка по счету<br></a>
				
	</div> -->
	<div class="container-fluid">
		<div class=" col-lg-12 col-md-12 rep-page" style="
    margin: 0;
    margin-top: 10px;
    margin-bottom: 10px;
	overflow: scroll;
	max-height: 604px;
"> 


						<div class="row col-lg-12 col-md-12"> <!--begin ui -->
						
							<form action="/user/perevodi" method="post"> 
							<select name="card_id" id="sel_card"  class="form-control" >
												<?php foreach($cards as $card):?>
													<option <?php echo "value=\"".$card["id"]."\"";?>>
														<?php echo $card["type"]." ".$card["number"]?>
													</option>
												<?php endforeach;?>
												</select>
							<span>&nbsp;C:</span>
							<input type="date" name="bdate" value="2017-09-01"  class="form-control">
							<span>&nbsp;До:</span>
							<input type="date" name="edate" value="2017-12-01" class="form-control">
							&nbsp;<input type="submit" class="longbtn" value="сформировать" style="width: 160px; font-size: 12pt;"></form>
							
						</div>	<!--end ui --><br><br> 
						<?php echo $res;?>
							
						
		</div>
		
		
	</div>
	
	<div class="footer col col-md-12 col-sm-12">&copy; OAO "Тоджиксодиротбанк" 2017</div>
	
	<link rel="stylesheet" href="/views/css/main.min.css">
	<script src="/views/js/scripts.min.js"></script>
</body>
<style>
td, th {
    padding: 10px;
}
</style>
</html>