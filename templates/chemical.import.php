<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
    header("Location: login.tpl.php"); 
} else{
?>
<ion-view view-title="<?php echo __import?>" name="chemical_import-tab">
	<ion-content class="padding">
    <form name="import" ng-submit="add_process()" class="list-inset" novalidate>
	<label class="item item-input">
		<span class="input-label"><?php echo(__name)?></span>
		<input type="text" placeholder="<?php echo(__name)?>" ng-model="input.contentname" ng-keyup="auto.complete('content','content')" required>
	</label>
	<ion-item class="assertive" ng-repeat="content in contents" ng-click="auto.choice(content)">{{content.label}}</ion-item>
	
	<label class="item item-input">
		<span class="input-label"><?php echo(__code)?></span>
		<input type="text" placeholder="<?php echo(__code)?>" ng-model="input.code" required>
	</label>

	<label class="item item-input">
		<span class="input-label"><?php echo(__lot)?></span>
		<input type="text" placeholder="<?php echo(__lot)?>" ng-model="input.lot" required>
	</label>

	<label class="item item-input">
		<span class="input-label"><?php echo(__weight)?></span>
		<input type="number" placeholder="<?php echo(__weight)?>" ng-model="input.weight" required>
	</label>

	<label class="item item-input">
		<span class="input-label"><?php echo(__user_receive)?></span>
		<input type="text" placeholder="<?php echo(__user_receive)?>" ng-model="input.user_receivername" ng-keyup="auto.complete('user_receiver','user')" required>
	</label>
	<ion-item class="assertive" ng-repeat="user_receiver in user_receivers" ng-click="auto.choice(user_receiver)">{{user_receiver.label}}</ion-item>
	
	<label class="item item-input">
		<span class="input-label"><?php echo(__receive_date)?></span>
		<input type="date" placeholder="<?php echo(__receive_date)?>" ng-model="input.receive" required>
	</label>
	
	<label class="item item-input">
		<span class="input-label"><?php echo(__expired_date)?></span>
		<input type="date" placeholder="<?php echo(__expired_date)?>" ng-model="input.expired">
	</label>
	
	<label class="item item-input">
		<span class="input-label"><?php echo(__user_open)?></span>
		<input type="text" placeholder="<?php echo(__user_open)?>" ng-model="input.user_openname" ng-keyup="auto.complete('user_open','user')">
	</label>
	<ion-item class="assertive" ng-repeat="user_open in user_opens" ng-click="auto.choice(user_open)">{{user_open.label}}</ion-item>
	
	<label class="item item-input">
		<span class="input-label"><?php echo(__open_date)?></span>
		<input type="date" placeholder="<?php echo(__open_date)?>" ng-model="input.opens">
	</label>
	
	<label class="item item-input">
		<span class="input-label"><?php echo(__lb_description_hc)?></span>
		<input type="text" placeholder="<?php echo(__lb_description_hc)?>" ng-model="input.desc">
	</label>
 
 	<button type="submit" class="button button-block button-positive margrin-top" ng-show="view.complete&&import.$valid">
		{{view.button}}
	</button>
  </form>
  </ion-content>
</ion-view>
<?php }?>