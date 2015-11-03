<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
?>
<ion-view view-title="<?php echo __user_password?>" name="user_password-tab">
	<ion-content class="padding">
    <?php echo __you_dont_permission?>
    </ion-content>
</ion-view>
<?php
} else{
?>
<ion-view view-title="<?php echo __user_password?>" name="user_password-tab">
	<ion-content class="padding">
    <form name="user" ng-submit="change_process()" class="list-inset" novalidate>
  	<ion-list class="list-inset margrin-top">
		<label class="item item-input" ng-class="{'has-errors':user.input.name.$invalid&&!user.input.name.$pristine, 'no-errors':user.input.name.$valid}">
			<span class="input-label positive"><?php echo __fullname?></span>
			<input type="text" ng-keyup="auto.complete('user')" ng-model="input.name" required ng-minlength='1'>
		</label>
		<ion-item class="assertive" ng-repeat="user in users" ng-click="auto.choice(user)">{{user.label}}</ion-item>
			
		<label class="item item-input" ng-class="{'has-errors':user.input.password.$invalid&&!user.input.password.$pristine, 'no-errors':user.input.password.$valid}">
			<span class="input-label positive"><?php echo __new_password?></span>
			<input type="password" ng-model="input.password" required ng-minlength='6'>
		</label>

		<label class="item item-input">
			<span class="input-label positive"><?php echo __re_new_password?></span>
			<input type="password" ng-model="input.repassword" required ng-minlength='6'>
		</label>

	<button type="submit" class="button button-block button-positive margrin-top" ng-show="user.$valid">
		{{view.button}}
	</button>
    </form>
  </ion-content>
</ion-view>
<?php }?>