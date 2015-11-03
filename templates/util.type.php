<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
?>
<ion-view view-title="<?php echo __tool_type?>" name="util_type-tab">
	<ion-content class="padding">
    <?php echo __you_dont_permission?>
    </ion-content>
</ion-view>
<?php
} else{
?>
<ion-view view-title="<?php echo __tool_type?>" name="util_type-tab">
	<ion-nav-buttons side="right">
		<button class="button button-positive button-clear icon-left ion-ios-trash-outline" ng-show="view.new_name" ng-click="add_del()">
		<?php echo __delete?>
		</button>
	</ion-nav-buttons>
	<ion-content class="padding">
    <form name="type" ng-submit="add_process()" class="list-inset" novalidate>
  	<ion-list class="list-inset margrin-top">
		<label class="item item-input" ng-class="{'has-errors':type.input.typename.$invalid&&!type.typename.$pristine, 'no-errors':type.input.typename.$valid}">
			<span class="input-label positive"><?php echo __type_name?></span>
			<input type="text" ng-keyup="auto.complete('type')" ng-model="input.typename" required ng-minlength='1'>
		</label>
		<ion-item class="assertive" ng-repeat="type in types" ng-click="auto.choice(type)">{{type.label}}</ion-item>
		<label class="item item-input" ng-class="{'has-errors':type.input.description.$invalid&&!type.description.$pristine, 'no-errors':type.input.description.$valid}">
			<span class="input-label positive"><?php echo __type_description?></span>
			<input type="text" ng-keyup="auto.complete('type')" ng-model="input.description" required ng-minlength='1'>
		</label>
	<button type="submit" class="button button-block button-positive margrin-top" ng-show="type.$valid">
		{{view.button}}
	</button>
    </form>
  </ion-content>
</ion-view>
<?php }?>