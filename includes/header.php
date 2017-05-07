<!doctype html>
<html lang="en">
<header>
	<meata charest="utf-8">
	<title>Restaurant Reviews</title>
	<link rel="stylesheet"  type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="sass/style.css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</header>
<body>
	
<nav class="navbar navbar-inverse navbar-fixed-top" >
	
		<div class="container">
			
			<div class="navbar-header">
					<button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#myNavbar" >
				
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
				<img src="images/Logo.png" id="logo"></img>
				<a class="navbar-brand" href="index.php?p=home">Restarant Reviews</a>
			</div>
			<div id="myNavbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
                    <li <?php if($_GET['p']=='home') {echo 'class="active"';} ?>><a href="index.php?p=home">Home</a></li>
                    <li <?php if($_GET['p']=='list') {echo 'class="active"';} ?>><a href="index.php?p=list" >Restaurant</a></li>
                	<li <?php if($_GET['p']=='reviews') {echo 'class="active"';} ?>><a href="index.php?p=reviews" >MyReviews</a></li>
                	<li  <?php if($_GET['p']=='editprofile') {echo 'class="active"';} ?>><a href="index.php?p=editprofile"  >Editprofile</a></li>
                    <li <?php if($_GET['p']=='viewprofile') {echo 'class="active"';} ?>><a href="index.php?p=viewprofile" >Viewprofile</a></li>
               </ul>
                <ul class="nav navbar-nav navbar-right">
                        <?php if($_SESSION['loggedin']){ ?>
                    <li><a href="index.php?p=logout"  ><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                        <?php }else{ ?>
        		    <li <?php if($_GET['p']=='login') {echo 'class="active"';} ?>><a href="index.php?p=login"  ><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
                        <li <?php if($_GET['p']=='register') {echo 'class="active"';} ?>><a href="index.php?p=register"  ><span class="glyphicon glyphicon-user"></span>Register</a></li>
                        <?php } ?>
                </ul>

			</div>
			
		</div>
	</nav>
	<div style="height:50px;width:100%;"></div>