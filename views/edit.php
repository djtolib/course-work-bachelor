<!DOCTYPE HTML>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<title>About - Zerotype Website Template</title>
	<link rel="stylesheet" href="/views/css/style.css" type="text/css">
</head>
<body>
	<div id="header">
		<div>
			<div class="logo">
				<a href="index.html">Zero Type</a>
			</div>
			<ul id="navigation">
				<li>
					<a href="index.html">Home</a>
				</li>
				<li>
					<a href="features.html">Features</a>
				</li>
				<li>
					<a href="news.html">News</a>
				</li>
				<li class="active">
					<a href="about.html">About</a>
				</li>
				<li>
					<a href="contact.html">Contact</a>
				</li>
			</ul>
		</div>
	</div>
	<div id="contents">
		<div id="about">
			<h1>User Modification</h1>
             <?php 
                if(isset($errors) && $errors != false)
                foreach($errors as $err)
                        {
                            echo "<li>$err</li>";    
                        }
            ?>
            <form action="#" method="post" style="list-style:none;">
                <li><input type="email" name="email" value="<?php echo $user["email"]?>" /></li>
                <li><input type="text" name="name" value="<?php echo $user["name"]?>" /></li>
                <li><input type="password" name="password" value="<?php echo $user["email"]?>"/></li>
                <li><button type="submit" class="btn">Sign in</button></li>
            </form>
			
		</div>
	</div>
	<div id="footer">
		<div class="clearfix">
			<div id="connect">
				<a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" class="facebook"></a><a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" class="googleplus"></a><a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" class="twitter"></a><a href="http://www.freewebsitetemplates.com/misc/contact/" target="_blank" class="tumbler"></a>
			</div>
			<p>
				© 2023 Zerotype. All Rights Reserved.
			</p>
		</div>
	</div>
</body>
</html>