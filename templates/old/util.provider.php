<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
?>
<ion-view view-title="<?php echo __tool_provider?>" name="provider-tab">
	<ion-content class="padding">
    <?php echo __you_dont_permission?>
    </ion-content>
</ion-view>
<?php
} else{
?>
<ion-view view-title="<?php echo __tool_provider?>" name="provider-tab">
	<ion-nav-buttons side="right">
		<button class="button button-positive button-clear icon-left ion-ios-trash-outline" ng-show="view.new_name" ng-click="add_del()">
		<?php echo __delete?>
		</button>
	</ion-nav-buttons>
	<ion-content class="padding">
    <form name="provider" ng-submit="add_process()" class="list-inset" novalidate>
  	<ion-list class="list-inset margrin-top">
		<label class="item item-input" ng-class="{'has-errors':provider.input.name.$invalid&&!provider.name.$pristine, 'no-errors':provider.input.name.$valid}">
			<span class="input-label positive"><?php echo __provider_name?></span>
			<input type="text" ng-keyup="auto.complete('provider')" ng-model="input.name" required ng-minlength='1'>
		</label>
		<ion-item class="assertive" ng-repeat="provider in providers" ng-click="auto.choice(provider)">{{provider.label}}</ion-item>
		<label class="item item-input">
			<span class="input-label positive"><?php echo __provider_code?></span>
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
	<button type="submit" class="button button-block button-positive margrin-top" ng-show="provider.$valid">
		{{view.button}}
	</button>
    </form>
  </ion-content>
</ion-view>
<?php }?>