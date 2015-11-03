<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
?>
<ion-view view-title="<?php echo __user_info?>" name="user_info-tab">
	<ion-content class="padding">
    <?php echo __you_dont_permission?>
    </ion-content>
</ion-view>
<?php
} else{
?>
<ion-view view-title="<?php echo __user_info?>" name="user_info-tab">
	<ion-nav-buttons side="right">
		<button class="button button-positive button-clear icon-left ion-ios-trash-outline" ng-show="view.new_name" ng-click="add_del()">
		<?php echo __delete?>
		</button>
	</ion-nav-buttons>
	<ion-content class="padding">
    <form name="user" ng-submit="add_process()" class="list-inset" novalidate>
  	<ion-list class="list-inset margrin-top">
		<label class="item item-input" ng-class="{'has-errors':user.input.name.$invalid&&!user.input.name.$pristine, 'no-errors':user.input.name.$valid}">
			<span class="input-label positive"><?php echo __fullname?></span>
			<input type="text" ng-keyup="auto.complete('user')" ng-model="input.name" required ng-minlength='1'>
		</label>
		<ion-item class="assertive" ng-repeat="user in users" ng-click="auto.choice(user)">{{user.label}}</ion-item>
		
		<label class="item item-input" ng-class="{'has-errors':user.input.username.$invalid&&!user.input.username.$pristine, 'no-errors':user.input.username.$valid}">
			<span class="input-label positive"><?php echo __username?></span>
			<input type="text" ng-model="input.username" required ng-minlength='6'>
		</label>	
		
		<label class="item item-input" ng-class="{'has-errors':user.input.password.$invalid&&!user.input.password.$pristine, 'no-errors':user.input.password.$valid}">
			<span class="input-label positive"><?php echo __password?></span>
			<input type="password" ng-model="input.password" ng-required="!view.new_name" ng-disabled="view.new_name" ng-minlength='6'>
		</label>

		<label class="item item-input">
			<span class="input-label positive"><?php echo __email?></span>
			<input type="text" ng-model="input.email">
		</label>		

		<label class="item item-input">
			<span class="input-label positive"><?php echo __phone?></span>
			<input type="text" ng-model="input.phone">
		</label>		

		<label class="item item-input">
			<span class="input-label positive"><?php echo __birthday?></span>
			<input type="date" ng-model="input.birthday">
		</label>	

		<label class="item item-input">
			<span class="input-label positive"><?php echo __join_day?></span>
			<input type="date" ng-model="input.joins">
		</label>	

		<label class="item item-input">
			<span class="input-label positive"><?php echo __quit_day?></span>
			<input type="date" ng-model="input.quit">
		</label>

		<label class="item item-input">
			<span class="input-label positive"><?php echo __school?></span>
			<input type="text" ng-model="input.school">
		</label>

		<label class="item item-input">
			<span class="input-label positive"><?php echo __branch?></span>
			<input type="text" ng-model="input.branch">
		</label>

		<label class="item item-input">
			<span class="input-label positive"><?php echo __position?></span>
			<input type="text" ng-model="input.position">
		</label>
		
		<label class="item item-input">
			<span class="input-label positive"><?php echo __address?></span>
			<input type="text" ng-model="input.address">
		</label>

	<button type="submit" class="button button-block button-positive margrin-top" ng-show="user.$valid">
		{{view.button}}
	</button>
    </form>
  </ion-content>
</ion-view>
<?php }?>