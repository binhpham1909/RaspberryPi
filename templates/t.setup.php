<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
    header("Location: login.tpl.php"); 
} else{
?>
<ion-view view-title="<?php echo __status?>" name="setup-view">
	<ion-content class="padding">
  	<ion-list class="">
		
	<ion-list>
  </ion-content>
</ion-view>
<?php }?>