<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
    header("Location: login.tpl.php"); 
} else{
?>
<ion-view view-title="<?php echo __used?>" name="login-view">
    	<ion-nav-buttons side="right">
		<button class="button" ng-click="logout()">
		LOGOUT
		</button>
	</ion-nav-buttons>
	<ion-content class="padding">
  	<ion-list class="list-inset">
  		<ion-radio ng-model="$parent.table" ng-value="'content'"><?php echo __used_by_chemical?></ion-radio>
		<ion-radio ng-model="$parent.table" ng-value="'solution'"><?php echo __used_for_mix?></ion-radio>
	<ion-list>
	<ion-list class="list-inset margrin-top">
	<ion-list>
  	<ion-list class="list-inset margrin-top">
		<label class="item item-input">
			<span class="input-label positive"><?php echo __name_of_chemical_mix?></span>
			<input type="text" ng-keyup="multicomplete(table)" ng-model="input.name">
		</label>
		<ion-item ng-repeat="chemical in chemicals" ng-click="autoselect(chemical,'name')">
			{{content.name}}
		</ion-item>
		<label class="item item-input">
			<span class="input-label positive"><?php echo __weight_used?></span>
			<input type="number" ng-keyup="precal()" ng-model="input.weight">
		</label>
		<label class="item item-input">
			<span class="input-label positive"><?php echo __used_for?></span>
			<input type="text">
		</label>
		<label class="item item-input positive">
			<span class="input-label positive"><?php echo __used_date?></span>
			<input type="date">
		</label>
	<ion-list>
  	<ion-list class="list-inset margrin-top">
		<ion-item ng-repeat="item in items">
			{{item.name}} : {{item.weight}} ({{item.units}})
		</ion-item>
	<ion-list>
	<button class="button button-block button-positive margrin-top" ng-show="0">
		Save
	</button>
  </ion-content>
</ion-view>
<?php }?>