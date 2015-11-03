<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
?>
<ion-view view-title="<?php echo __humi?>" name="status_humi-tab">
	<ion-content class="padding">
    <?php echo __you_dont_permission?>
    </ion-content>
</ion-view>
<?php
} else{
?>
<ion-view view-title="<?php echo __humi?>" name="status_humi-tab">
<ion-content class="padding">
	<ion-list>
		<ion-item class="item item-icon-left" ng-repeat="humi in humis">
			<i class="icon ion-ios-speedometer"></i>
			{{humi.name}}
			Min:{{humi.min_humi}}
			Max:{{humi.max_humi}}
			<span class="badge badge-assertive">{{humi.humi}}</span>
		</ion-item>
	</ion-list>
</ion-content>
</ion-view>
<?php }?>