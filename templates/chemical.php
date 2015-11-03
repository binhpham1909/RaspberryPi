<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
    header("Location: login.tpl.php"); 
} else{
?>
<ion-view view-title="<?php echo __chemical_manager?>" name="chemical-view">
	<ion-content class="padding">
  	<ion-list class="">
		<ion-item class="item-icon-left" href="#/tab/chemical_import"><i class="icon ion-ios-download-outline"></i><?php echo __import?></ion-item>
		<ion-item class="item-icon-left" href="#/tab/used"><i class="icon ion-ios-upload-outline"></i><?php echo __used?></ion-item>
		<ion-item class="item-icon-left" href="#/tab/chemical_fullinfo"><i class="icon ion-ios-information-outline"></i><?php echo __chemical_info?></ion-item>
		<ion-item class="item-icon-left" href="#/tab/chemical_add"><i class="icon ion-ios-plus-outline"></i><?php echo __tool_chemical?></ion-item>
	<ion-list>
  </ion-content>
</ion-view>
<?php }?>