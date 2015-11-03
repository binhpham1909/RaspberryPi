<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
?>
<ion-view view-title="<?php echo __tool_state?>" name="util_state-tab">
	<ion-content class="padding">
    <?php echo __you_dont_permission?>
    </ion-content>
</ion-view>
<?php
} else{
?>
<ion-view view-title="<?php echo __tool_state?>" name="util_state-tab">
	<ion-nav-buttons side="right">
		<button class="button button-positive button-clear icon-left ion-ios-trash-outline" ng-show="view.new_name" ng-click="add_del()">
		<?php echo __delete?>
		</button>
	</ion-nav-buttons>
	<ion-content class="padding">
    <form name="state" ng-submit="add_process()" class="list-inset" novalidate>
  	<ion-list class="list-inset margrin-top">
		<label class="item item-input" ng-class="{'has-errors':state.input.statename.$invalid&&!state.statename.$pristine, 'no-errors':state.input.statename.$valid}">
			<span class="input-label positive"><?php echo __state_name?></span>
			<input type="text" ng-keyup="auto.complete('state')" ng-model="input.statename" required ng-minlength='1'>
		</label>
	<ion-item class="assertive" ng-repeat="state in states" ng-click="auto.choice(state)">{{state.label}}</ion-item>
	<button type="submit" class="button button-block button-positive margrin-top" ng-show="state.$valid">
		{{view.button}}
	</button>
    </form>
  </ion-content>
</ion-view>
<?php }?>