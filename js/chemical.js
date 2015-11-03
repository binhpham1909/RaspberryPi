myapp
.controller('used', function($state,$scope,$ionicHistory,$ionicPopup,CACHE,LOGOUT,$http) {
	$scope.table="content";
	$scope.input={};
	$scope.contents=[];
	$scope.multicomplete=function(tables){
		$http.post('process/autocomplete.php',{'type':tables, 'term':$scope.input.name})
		.then(function(result) {
			if($scope.input.name==""){
				$scope.contents=[];
			}else{
				$scope.contents=result.data;
			}
		},function(err) {
			console.log(JSON.stringify(err));
		});
	};
	$scope.precal=function(){
		$http.post('process/chemical.used.php',{'action':'check', 'id':CACHE.getVal('id'), 'table':$scope.table, 'weight':$scope.input.weight})
		.then(function(result) {
			$scope.items=result.data;
		},function(err) {
			
		});
	};
	$scope.autoselect=function(callback,name){
		console.log(JSON.stringify(callback));
		$scope.input.name=callback.name;
		CACHE.setVal('id',callback.id);
//		CACHE.sets('username',us.usname);
//		CACHE.sets('password',us.uspassword);
		$scope.contents=[];
	}
	$scope.logout=function(){
		LOGOUT.logout().then(
			function(re){
				if(re.data.result=="ok"){
					window.location.replace('login.tpl.php');
				}
			},function(err){
			});;
	}

})
.controller('chemical', function($scope,$ionicHistory,$ionicPopup,CACHE) {
})
.controller('chemical_fullinfo', function($state,$scope,$ionicHistory,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.fields=[];
	$scope.users=[];
	$scope.input.action="add";
	$scope.view.button="Tạo mới";
	$scope.view.complete=false;
	$scope.auto=[];
	$scope.auto.complete=function(name){
		CACHE.setVal('auto',name);
		if(CACHE.getVal('fieldid')==null){$scope.view.button="Tạo mới";}
		var name=CACHE.getVal('auto')+'name';
		var id=CACHE.getVal('auto')+'id';
		var items=CACHE.getVal('auto')+'s';
		DB.autocomplete(CACHE.getVal('auto'),$scope.input[name]).then(function(result) {
			if($scope.input[name]==undefined){
				$scope[items]=[];
				$scope.view.new_name=false;
				CACHE.clear(id);
			}else{
//				console.log(JSON.stringify(result));
				$scope[items]=result.data;
			}
		},function(err) {
			console.log(JSON.stringify(err));
		});
		$scope.check_complete();
	};
	$scope.auto.choice=function(callback){
		var name=CACHE.getVal('auto')+'name';
		var id=CACHE.getVal('auto')+'id';
		var items=CACHE.getVal('auto')+'s';
		if(CACHE.getVal('auto')=='content'){
			$scope.input=callback;
			CACHE.setVal('contentid',callback.contentid);
			CACHE.setVal('chemicalid',callback.chemicalid);
			CACHE.setVal('typeid',callback.typeid);
			CACHE.setVal('unitsid',callback.unitsid);
			CACHE.setVal('fieldid',callback.fieldid);
			CACHE.setVal('manufactorid',callback.manufactorid);
			CACHE.setVal('providerid',callback.providerid);
			CACHE.setVal('purityid',callback.purityid);
			CACHE.setVal('stateid',callback.stateid);
			CACHE.setVal('storeid',callback.storeid);
		}else{
			$scope.input[name]=callback.name;
			CACHE.setVal(id,callback.id);
		}
		if(CACHE.getVal('contentid')!=null){
			$scope.input.action="edit";
			$scope.view.button="Thay đổi";
			$scope.view.new_name=true;
		}else{
			$scope.input.action="add";
			$scope.view.button="Tạo mới";
			$scope.view.new_name=false;
		}
		$scope[items]=[];
		$scope.check_complete();	
	}
	$scope.check_complete=function(){
		if(($scope.input.contentname!='')
			&&(CACHE.getVal('storeid')!=null)
			&&(CACHE.getVal('chemicalid')!=null)
			&&(CACHE.getVal('typeid')!=null)
			&&(CACHE.getVal('unitsid')!=null)
			&&(CACHE.getVal('fieldid')!=null)
			&&(CACHE.getVal('manufactorid')!=null)
			&&(CACHE.getVal('providerid')!=null)
			&&(CACHE.getVal('purityid')!=null)
			&&(CACHE.getVal('stateid')!=null)
			){
			$scope.view.complete=true;
		}else{
			$scope.view.complete= false;
		}
		console.log($scope.input.contentname);
		console.log($scope.input.contentid);
		console.log('storeid : '+CACHE.getVal('storeid'));
		console.log('chemicalid : '+CACHE.getVal('chemicalid'));
		console.log('typeid : '+CACHE.getVal('typeid'));
		console.log('unitsid : '+CACHE.getVal('unitsid'));
		console.log('fieldid : '+CACHE.getVal('fieldid'));
		console.log('manufactorid : '+CACHE.getVal('manufactorid'));
		console.log('providerid : '+CACHE.getVal('providerid'));
		console.log('purityid : '+CACHE.getVal('purityid'));
		console.log('stateid : '+CACHE.getVal('stateid'));
		console.log('complete : '+$scope.view.complete);
	}
	$scope.add_process=function(){
		$scope.input.contentid=CACHE.getVal('contentid');
		$scope.input.chemicalid=CACHE.getVal('chemicalid');
		$scope.input.typeid=CACHE.getVal('typeid');
		$scope.input.unitsid=CACHE.getVal('unitsid');
		$scope.input.fieldid=CACHE.getVal('fieldid');
		$scope.input.manufactorid=CACHE.getVal('manufactorid');
		$scope.input.providerid=CACHE.getVal('providerid');
		$scope.input.purityid=CACHE.getVal('purityid');
		$scope.input.stateid=CACHE.getVal('stateid');
		$scope.input.storeid=CACHE.getVal('storeid');
		DB.fullinfo($scope.input).then(function(result){
			$ionicPopup.alert({title: result.data.status,template: result.data.message});
			if(result.data.result=="ok"){
				$scope.input.contentname='';
				$scope.input.chemicalname='';
				$scope.input.typename='';
				$scope.input.unitsname='';
				$scope.input.fieldname='';
				$scope.input.manufactorname='';
				$scope.input.providername='';
				$scope.input.purityname='';
				$scope.input.statename='';
				$scope.input.storename='';		
				CACHE.clear('contentid');
				CACHE.clear('chemicalid');
				CACHE.clear('typeid');
				CACHE.clear('unitsid');
				CACHE.clear('fieldid');
				CACHE.clear('manufactorid');
				CACHE.clear('providerid');
				CACHE.clear('purityid');
				CACHE.clear('stateid');
				CACHE.clear('storeid');
				$scope.view.new_name=false;
			}
		})
	}
	$scope.add_del=function(){
		var send=[];
		send.contentid=CACHE.getVal('contentid');
		send.action='del';
		DB.fullinfo(send).then(function(result){
			$ionicPopup.alert({title: result.data.status,template: result.data.message});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.contentname='';
				$scope.input.chemicalname='';
				$scope.input.typename='';
				$scope.input.unitsname='';
				$scope.input.fieldname='';
				$scope.input.manufactorname='';
				$scope.input.providername='';
				$scope.input.purityname='';
				$scope.input.statename='';
				$scope.input.storename='';		
				CACHE.clear('contentid');
				CACHE.clear('chemicalid');
				CACHE.clear('typeid');
				CACHE.clear('unitsid');
				CACHE.clear('fieldid');
				CACHE.clear('manufactorid');
				CACHE.clear('providerid');
				CACHE.clear('purityid');
				CACHE.clear('stateid');
				CACHE.clear('storeid');
				$scope.view.new_name=false;
			}
		})
	}
})
.controller('chemical_import', function($state,$scope,$ionicHistory,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.view.button="Thêm mới";
	$scope.view.complete=false;
	$scope.auto=[];
	$scope.auto.complete=function(name,table){
		CACHE.setVal('auto',name);
		if(CACHE.getVal('fieldid')==null){$scope.view.button="Tạo mới";}
		var name=CACHE.getVal('auto')+'name';
		var id=CACHE.getVal('auto')+'id';
		var items=CACHE.getVal('auto')+'s';
		DB.autocomplete(table,$scope.input[name]).then(function(result) {
			if($scope.input[name]==undefined){
				$scope[items]=[];
				CACHE.clear(id);
			}else{
//				console.log(JSON.stringify(result));
				$scope[items]=result.data;
			}
		},function(err) {
			console.log(JSON.stringify(err));
		});
		$scope.check_complete();
	};
	$scope.auto.choice=function(callback){
		var name=CACHE.getVal('auto')+'name';
		var id=CACHE.getVal('auto')+'id';
		var items=CACHE.getVal('auto')+'s';
		$scope.input[name]=callback.name;
		CACHE.setVal(id,callback.id);
		$scope[items]=[];
		$scope.check_complete();	
	}
	$scope.check_complete=function(){
		if(($scope.input.contentname!='')&&(CACHE.getVal('user_receiver')!=null)){
			$scope.view.complete=true;
		}else{
			$scope.view.complete= false;
		}
	}
	$scope.add_process=function(){
		$scope.input.contentid=CACHE.getVal('contentid');
		$scope.input.user_receiverid=CACHE.getVal('user_receiverid');
		$scope.input.user_openid=CACHE.getVal('user_openid');
		DB.chemical_import($scope.input).then(function(result){
			$ionicPopup.alert({title: result.data.status,template: result.data.message});
			if(result.data.result=="ok"){
				$scope.input.contentname='';
				$scope.input.user_receivername='';
				$scope.input.user_openname='';
				CACHE.clear('contentid');
				CACHE.clear('user_receiverid');
				CACHE.clear('user_openid');
			}
		})
	}
})
.controller('chemical_add', function($scope,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.chemicals=[];
	$scope.input.action="add";
	$scope.view.new_name=false;
	$scope.view.button="Tạo mới";
	$scope.auto=[];
	$scope.auto.complete=function(name){
		DB.autocomplete('chemical',$scope.input.name).then(function(result) {
			if($scope.input.name==undefined){
				$scope.chemicals=[];
				CACHE.clear('id');
			}else{
				console.log(JSON.stringify(result));
				$scope.chemicals=result.data;
			}
		},function(err) {
			console.log(JSON.stringify(err));
		});
	};
	$scope.auto.choice=function(callback){
		$scope.input=callback;
		CACHE.setVal('id',callback.id);
		if(CACHE.getVal('id')!=null){
			$scope.input.action="edit";
			$scope.view.button="Đổi tên";
			$scope.view.new_name=true;
		}else{
			$scope.input.action="add";
			$scope.view.button="Tạo mới";
			$scope.view.new_name=false;
		}
		$scope.chemicals=[];
	}
	$scope.add_process=function(){
		$scope.input.id=CACHE.getVal('id');
		if($scope.input.new_name==undefined){$scope.input.new_name=$scope.input.name}
		DB.toolChemical($scope.input).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name="";
				$scope.input.new_name="";
				$scope.input.id=null;
				$scope.input.typeid="";
				$scope.input.properties="";
				CACHE.clear('id');
			}
		})
	}
	$scope.add_del=function(){
		var send=[];
		send.id=CACHE.getVal('id');
		send.action='del';
		DB.toolChemical(send).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name="";
				$scope.input.new_name="";
				$scope.input.id=null;
				$scope.input.typeid="";
				$scope.input.properties="";
				CACHE.clear('id');
			}
		})
	}
})