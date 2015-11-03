<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
    header("Location: login.tpl.php"); 
} else{
?>
<ion-view view-title="<?php echo __utility?>" name="utility-tab">
	<ion-content class="padding">
  	<ion-list>
		<ion-item class="item-icon-left" href="#/tab/units"><i class="balance icon ion-ios-pricetags"></i><?php echo __unit?></ion-item>
		<ion-item class="item-icon-left" href="#/tab/manufactor"><i class="icon ion-ios-world"></i><?php echo __tool_manufactor?></ion-item>
		<ion-item class="item-icon-left" href="#/tab/provider"><i class="icon ion-ios-cart"></i><?php echo __tool_provider?></ion-item>
		<ion-item class="item-icon-left" href="#/tab/purity"><i class="icon ion-ios-paw-outline"></i><?php echo __tool_purity?></ion-item>
		<ion-item class="item-icon-left" href="#/tab/store"><i class="icon ion-ios-filing-outline"></i><?php echo __tool_store?></ion-item>
		<ion-item class="item-icon-left" href="#/tab/util_field"><i class="icon ion-ios-people-outline"></i><?php echo __tool_field?></ion-item>
		<ion-item class="item-icon-left" href="#/tab/util_state"><i class="icon ion-ios-ionic-outline"></i><?php echo __tool_state?></ion-item>
		<ion-item class="item-icon-left" href="#/tab/util_type"><i class="icon ion-social-buffer-outline"></i><?php echo __tool_type?></ion-item>
	<ion-list>
  </ion-content>
</ion-view>
<?php }?>