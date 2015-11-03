<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
?>
<ion-view view-title="<?php echo __temp?>" name="status_temp-tab">
	<ion-content class="padding">
    <?php echo __you_dont_permission?>
    </ion-content>
</ion-view>
<?php
} else{
?>
<ion-view view-title="<?php echo __temp?>" name="status_temp-tab">
<ion-content class="padding">
	<ion-list>
		<ion-item class="item item-icon-left" ng-repeat="temp in temps">
			<i class="icon ion-ios-speedometer"></i>
			{{temp.name}}
			Min:{{temp.min_temp}}
			Max:{{temp.max_temp}}
			<span class="badge badge-assertive">{{temp.temp}}</span>
		</ion-item>
	</ion-list>
</ion-content>
</ion-view>
<?php }?>