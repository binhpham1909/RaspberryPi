<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
    header("Location: login.tpl.php"); 
} else{
?>
<ion-view view-title="<?php echo __user?>" name="user-view">
	<ion-content class="padding">
  	<ion-list class="">
		<ion-item class="item-icon-left" href="#/tab/user_info"><i class="icon ion-ios-person-outline"></i><?php echo __user_info?></ion-item>
		<ion-item class="item-icon-left" href="#/tab/user_password"><i class="icon ion-ios-locked-outline"></i><?php echo __user_password?></ion-item>
	<ion-list>
  </ion-content>
</ion-view>
<?php }?>