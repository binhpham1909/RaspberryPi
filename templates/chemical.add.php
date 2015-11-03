<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
?>
<ion-view view-title="<?php echo __tool_chemical?>" name="chemical_add-tab">
	<ion-content class="padding">
    <?php echo __you_dont_permission?>
    </ion-content>
</ion-view>
<?php
} else{
?>
<ion-view view-title="<?php echo __tool_chemical?>" name="chemical_add-tab">
	<ion-nav-buttons side="right">
		<button class="button button-positive button-clear icon-left ion-ios-trash-outline" ng-show="view.new_name" ng-click="add_del()">
		<?php echo __delete?>
		</button>
	</ion-nav-buttons>
	<ion-content class="padding">
    <form name="chemical" ng-submit="add_process()" class="list-inset" novalidate>
  	<ion-list class="list-inset margrin-top">
		<label class="item item-input item-select" ng-class="{'has-errors':chemical.input.name.$invalid&&!chemical.name.$pristine, 'no-errors':chemical.input.name.$valid}">
			<span class="input-label positive"><?php echo __chemical_name?></span>
			<input type="text" ng-keyup="auto.complete('chemical')" ng-model="input.name" required ng-minlength='1'>
			<select ng-model="input.typeid" required>
				<option selected value=''><?php echo __type?></option>
				<?php
				$sql="SELECT * FROM pkn_type WHERE (name='standard') OR (name='chemical')";
				$sql_query = mysql_query($sql);
				while ($row = mysql_fetch_assoc($sql_query)){
					echo "<option value='{$row['id']}'>{$row['description']}</option>";
				}
				?>
			</select>
		</label>
		<ion-item class="assertive" ng-repeat="chemical in chemicals" ng-click="auto.choice(chemical)">{{chemical.label}}</ion-item>
		<label class="item item-input">
			<span class="input-label positive"><?php echo __properties?></span>
			<input type="text" ng-model="input.properties">
		</label>
		<label class="item item-input" ng-show="view.new_name">
			<span class="input-label positive"><?php echo __new_name?></span>
			<input type="text" ng-model="input.new_name">
		</label>
	<button type="submit" class="button button-block button-positive margrin-top" ng-show="chemical.$valid">
		{{view.button}}
	</button>
    </form>
  </ion-content>
</ion-view>
<?php }?>