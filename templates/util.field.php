<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
?>
<ion-view view-title="<?php echo __tool_field?>" name="util_field-tab">
	<ion-content class="padding">
    <?php echo __you_dont_permission?>
    </ion-content>
</ion-view>
<?php
} else{
?>
<ion-view view-title="<?php echo __tool_field?>" name="util_field-tab">
	<ion-nav-buttons side="right">
		<button class="button button-positive button-clear icon-left ion-ios-trash-outline" ng-show="view.new_name" ng-click="add_del()">
		<?php echo __delete?>
		</button>
	</ion-nav-buttons>
	<ion-content class="padding">
    <form name="field" ng-submit="add_process()" class="list-inset" novalidate>
  	<ion-list class="list-inset margrin-top">
		<label class="item item-input" ng-class="{'has-errors':field.input.fieldname.$invalid&&!field.fieldname.$pristine, 'no-errors':field.input.fieldname.$valid}">
			<span class="input-label positive"><?php echo __field_name?></span>
			<input type="text" ng-keyup="auto.complete('field')" ng-model="input.fieldname" required ng-minlength='1'>
		</label>
		<ion-item class="assertive" ng-repeat="field in fields" ng-click="auto.choice(field)">{{field.label}}</ion-item>

		<label class="item item-input" ng-class="{'has-errors':field.input.username.$invalid&&!field.input.username.$pristine, 'no-errors':field.input.username.$valid}">
			<span class="input-label positive"><?php echo __user?></span>
			<input type="text" ng-keyup="auto.complete('user')" ng-model="input.username" required ng-minlength='1'>
		</label>
		<ion-item class="assertive" ng-repeat="user in users" ng-click="auto.choice(user)">{{user.label}}</ion-item>
	<button type="submit" class="button button-block button-positive margrin-top" ng-show="field.$valid">
		{{view.button}}
	</button>
    </form>
  </ion-content>
</ion-view>
<?php }?>