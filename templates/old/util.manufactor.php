<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
?>
<ion-view view-title="<?php echo __tool_manufactor?>" name="manufactor-tab">
	<ion-content class="padding">
    <?php echo __you_dont_permission?>
    </ion-content>
</ion-view>
<?php
} else{
?>
<ion-view view-title="<?php echo __tool_manufactor?>" name="manufactor-tab">
	<ion-nav-buttons side="right">
		<button class="button button-positive button-clear icon-left ion-ios-trash-outline" ng-show="view.new_name" ng-click="add_del()">
		<?php echo __delete?>
		</button>
	</ion-nav-buttons>
	<ion-content class="padding">
    <form name="manufactor" ng-submit="add_process()" class="list-inset" novalidate>
  	<ion-list class="list-inset margrin-top">
		<label class="item item-input" ng-class="{'has-errors':manufactor.input.name.$invalid&&!manufactor.name.$pristine, 'no-errors':manufactor.input.name.$valid}">
			<span class="input-label positive"><?php echo __manufactor_name?></span>
			<input type="text" ng-keyup="auto.complete('manufactor')" ng-model="input.name" required ng-minlength='1'>
		</label>
		<ion-item class="assertive" ng-repeat="manufactor in manufactors" ng-click="auto.choice(manufactor)">{{manufactor.label}}</ion-item>
		<label class="item item-input">
			<span class="input-label positive"><?php echo __manufactor_code?></span>
			<input type="text" ng-model="input.code">
		</label>
		<label class="item item-input">
			<span class="input-label positive"><?php echo __address?></span>
			<input type="text" ng-model="input.address">
		</label>
		<label class="item item-input">
			<span class="input-label positive"><?php echo __contact?></span>
			<input type="text" ng-model="input.contact">
		</label>
	<button type="submit" class="button button-block button-positive margrin-top" ng-show="manufactor.$valid">
		{{view.button}}
	</button>
    </form>
  </ion-content>
</ion-view>
<?php }?>