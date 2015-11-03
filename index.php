<?php 
require("config/lang.ini.php");
require("config/config.php"); 
session_start();
$header_title="Báo cáo tiêu hao";
if (!$_SESSION['user'])
{ 
    header("Location: login.tpl.php"); 
} else{
?>
<!DOCTYPE html>
<html ng-app="chemical">
<head>
    <meta charset="utf-8">
    <title>Chemical manager</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <link rel="stylesheet" href="lib/css/ionic.min.css" />
    <link rel="stylesheet" href="lib/css/ionicons.min.css" />
    <link rel="stylesheet" href="lib/css/style.css" />
    <script src="lib/js/ionic.bundle.min.js"></script>
    <script src="js/tabs.js"></script>
    <script src="js/chemical.js"></script>
    <script src="js/utility.js"></script>
    <script src="js/user.js"></script>
	<script src="js/service.js"></script>
</head>
<body>
<ion-nav-bar class="bar-light">
	<ion-nav-back-button>
    </ion-nav-back-button>
</ion-nav-bar>
<ion-nav-view></ion-nav-view>

<script id="templates/tabs.html" type="text/ng-template">
	<ion-tabs class="tabs-icon-top tabs-light">
	<!--Control tab-->
		<ion-tab title="<?php echo __chemical?>" icon-on="ion-ios-flask positive" icon-off="ion-ios-flask-outline positive" href="#/tab/chemical">
			<ion-nav-view name="chemical-tab"></ion-nav-view>
		</ion-tab>
		<ion-tab title="<?php echo __utility?>" icon-on="ion-ios-briefcase positive" icon-off="ion-ios-briefcase-outline positive" href="#/tab/utility">
			<ion-nav-view name="utility-tab"></ion-nav-view>
		</ion-tab>
		<ion-tab title="<?php echo __user?>" icon-on="ion-ios-person positive" icon-off="ion-ios-person-outline positive" href="#/tab/user">
			<ion-nav-view name="user-tab"></ion-nav-view>
		</ion-tab>
	</ion-tabs>
</script>

</body>

</html>
<?php }?>