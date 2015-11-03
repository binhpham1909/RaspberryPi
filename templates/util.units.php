<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
?>
<ion-view view-title="<?php echo __tool_units?>" name="units-tab">
	<ion-content class="padding">
    <?php echo __you_dont_permission?>
    </ion-content>
</ion-view>
<?php
} else{
?>
<ion-view view-title="<?php echo __tool_units?>" name="units-tab">
	<ion-nav-buttons side="right">
		<button class="button button-positive button-clear icon-left ion-ios-trash-outline" ng-show="view.new_name" ng-click="add_del()">
		<?php echo __delete?>
		</button>
	</ion-nav-buttons>
	<ion-content class="padding">
    <form name="units" ng-submit="add_process()" class="list-inset" novalidate>
  	<ion-list class="list-inset margrin-top">
		<label class="item item-input" ng-class="{'has-errors':units.input.name.$invalid&&!units.name.$pristine, 'no-errors':units.input.name.$valid}">
			<span class="input-label positive"><?php echo __name?></span>
			<input type="text" ng-keyup="auto.complete('units')" ng-model="input.name" required ng-minlength='1'>
		</label>
		<ion-item class="assertive" ng-repeat="units in unitss" ng-click="auto.choice(units)">{{units.label}}</ion-item>
		<label class="item item-input" ng-class="{'has-errors':units.input.name.$invalid&&!units.name.$pristine, 'no-errors':units.input.name.$valid}">
			<span class="input-label positive"><?php echo __symbol?></span>
			<input type="text" ng-model="input.symbol" required ng-minlength='1'>
		</label>
	<button type="submit" class="button button-block button-positive margrin-top" ng-show="units.$valid">
		{{view.button}}
	</button>
    </form>
  </ion-content>
</ion-view>
<?php }?>