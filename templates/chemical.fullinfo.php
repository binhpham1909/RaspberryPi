<?php 
require("../config/lang.ini.php");
require("../config/config.php"); 
session_start();
if (!$_SESSION['user'])
{ 
    header("Location: login.tpl.php"); 
} else{
?>
<ion-view view-title="<?php echo __chemical_info?>" name="chemical_fullinfo-tab">
	<ion-nav-buttons side="right">
		<button class="button button-positive button-clear icon-left ion-ios-trash-outline" ng-show="view.new_name" ng-click="add_del()">
		<?php echo __delete?>
		</button>
	</ion-nav-buttons>
	<ion-content class="padding">
    <form name="content" ng-submit="add_process()" class="list-inset" novalidate>
	<label class="item item-input">
		<span class="input-label"><?php echo(__name)?></span>
		<input type="text" placeholder="<?php echo(__name)?>" ng-model="input.contentname" ng-keyup="auto.complete('content')" required>
	</label>
	<ion-item class="assertive" ng-repeat="content in contents" ng-click="auto.choice(content)">{{content.label}}</ion-item>
	
  	<label class="item item-input item-select">
    	<span class="input-label"><?php echo(__chemical_name)?></span>
    	<input type="text" placeholder="<?php echo(__chemical_name)?>" ng-keyup="auto.complete('chemical')" ng-model="input.chemicalname" required">
        <select id="type" ng-model="input.typeid" required>
        <option selected value=''><?php echo(__type)?></option>
        <?php
		$sql2="SELECT * FROM pkn_type WHERE name ='chemical' OR name='standard'";
		$sql_query2 = mysql_query($sql2);
		while ($row2 = mysql_fetch_assoc($sql_query2))
		{
			echo "<option value='{$row2['id']}'>{$row2['description']}</option>";
		}
		?>
        </select>
	</label>
	<ion-item class="assertive" ng-repeat="chemical in chemicals" ng-click="auto.choice(chemical)">{{chemical.label}}</ion-item>
	
	<label class="item item-input item-select">
    <span class="input-label"><?php echo(__unit)?></span>
        <select id="units" ng-model="input.unitsid" required>
        <option selected value=''><?php echo(__unit)?></option>
        <?php
		$sql1="SELECT * FROM pkn_units";
		$sql_query1 = mysql_query($sql1);
		while ($row1 = mysql_fetch_assoc($sql_query1))
		{
			echo "<option value='{$row1['id']}'>{$row1['symbol']}</option>";
		}
		?>
        </select>
	</label>
	
	<label class="item item-input">
		<span class="input-label"><?php echo(__used_for)?></span>
		<input type="text" placeholder="<?php echo(__used_for)?>" ng-model="input.fieldname" ng-keyup="auto.complete('field')" required>
	</label>
	<ion-item class="assertive" ng-repeat="field in fields" ng-click="auto.choice(field)">{{field.label}}</ion-item>
  
  <label class="item item-input">
    <span class="input-label"><?php echo(__lb_hangsx_hc)?></span>
    <input type="text" placeholder="<?php echo(__lb_hangsx_hc)?>" ng-model="input.manufactorname" ng-keyup="auto.complete('manufactor')" required>
  </label>
  <ion-item class="assertive" ng-repeat="manufactor in manufactors" ng-click="auto.choice(manufactor)">{{manufactor.label}}</ion-item>
  
  <label class="item item-input">
    <span class="input-label"><?php echo(__lb_nhacc_hc)?></span>
    <input type="text" placeholder="<?php echo(__lb_nhacc_hc)?>" ng-model="input.providername" ng-keyup="auto.complete('provider')" required>
  </label>
  <ion-item class="assertive" ng-repeat="provider in providers" ng-click="auto.choice(provider)">{{provider.label}}</ion-item>
  
  <label class="item item-input item-select item-select">
    <span class="input-label"><?php echo(__lb_purity_hc)?></span>
    <input type="text" placeholder="<?php echo(__lb_purity_hc)?>" ng-model="input.purityname" ng-keyup="auto.complete('purity')" required>
	<select id="state" ng-model="input.stateid" required>
		<option selected value=''><?php echo(__state)?></option>
        <?php
		$sql3="SELECT * FROM pkn_state";
		$sql_query3 = mysql_query($sql3);
		while ($row3 = mysql_fetch_assoc($sql_query3))
		{
			echo "<option value='{$row3['id']}'>{$row3['name']}</option>";
		}
		?>
	</select>
  </label>
  <ion-item class="assertive" ng-repeat="purity in puritys" ng-click="auto.choice(purity)">{{purity.label}}</ion-item>
  
  <label class="item item-input">
    <span class="input-label"><?php echo(__store)?></span>
    <input type="text" placeholder="<?php echo(__store)?>" ng-model="input.storename" ng-keyup="auto.complete('store')" required>
  </label>
  <ion-item class="assertive" ng-repeat="store in stores" ng-click="auto.choice(store)">{{store.label}}</ion-item>
  
	<button type="submit" class="button button-block button-positive margrin-top" ng-show="view.complete">
		{{view.button}}
	</button>
    </form>
  </ion-content>
</ion-view>
<?php }?>