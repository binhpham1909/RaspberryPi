myapp
.controller('utility', function($state,$scope,$ionicPopup,CACHE,DB) {})
.controller('units', function($scope,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.unitss=[];
	$scope.input.action="add";
	$scope.view.button="Tạo mới";
	$scope.auto=[];
	$scope.auto.complete=function(name){
		if(CACHE.getVal('id')==null){$scope.view.button="Tạo mới";}
		DB.autocomplete('units',$scope.input.name).then(function(result) {
			if($scope.input.name==undefined){
				$scope.unitss=[];
				CACHE.clear('id');
				$scope.view.new_name=false;
			}else{
				console.log(JSON.stringify(result));
				$scope.unitss=result.data;
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
			$scope.view.button="Thay đổi";
			$scope.view.new_name=true;
		}else{
			$scope.input.action="add";
			$scope.view.button="Tạo mới";
			$scope.view.new_name=false;
		}
		$scope.unitss=[];
	}
	$scope.add_process=function(){
		$scope.input.id=CACHE.getVal('id');
		DB.units($scope.input).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.input.symbol='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
	$scope.add_del=function(){
		var send=[];
		send.id=CACHE.getVal('id');
		send.action='del';
		DB.units(send).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.input.symbol='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
})
.controller('manufactor', function($scope,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.manufactors=[];
	$scope.input.action="add";
	$scope.view.button="Tạo mới";
	$scope.auto=[];
	$scope.auto.complete=function(name){
		if(CACHE.getVal('id')==null){$scope.view.button="Tạo mới";}
		DB.autocomplete('manufactor',$scope.input.name).then(function(result) {
			if($scope.input.name==undefined){
				$scope.manufactors=[];
				CACHE.clear('id');
				$scope.view.new_name=false;
			}else{
				console.log(JSON.stringify(result));
				$scope.manufactors=result.data;
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
			$scope.view.button="Thay đổi";
			$scope.view.new_name=true;
		}else{
			$scope.input.action="add";
			$scope.view.button="Tạo mới";
			$scope.view.new_name=false;
		}
		$scope.manufactors=[];
	}
	$scope.add_process=function(){
		$scope.input.id=CACHE.getVal('id');
		DB.manufactor($scope.input).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.input.code='';
				$scope.input.address='';
				$scope.input.contact='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
	$scope.add_del=function(){
		var send=[];
		send.id=CACHE.getVal('id');
		send.action='del';
		DB.manufactor(send).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.input.code='';
				$scope.input.address='';
				$scope.input.contact='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
})
.controller('provider', function($scope,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.providers=[];
	$scope.input.action="add";
	$scope.view.button="Tạo mới";
	$scope.auto=[];
	$scope.auto.complete=function(name){
		if(CACHE.getVal('id')==null){$scope.view.button="Tạo mới";}
		DB.autocomplete('provider',$scope.input.name).then(function(result) {
			if($scope.input.name==undefined){
				$scope.providers=[];
				$scope.view.new_name=false;
				CACHE.clear('id');
			}else{
				console.log(JSON.stringify(result));
				$scope.providers=result.data;
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
			$scope.view.button="Thay đổi";
			$scope.view.new_name=true;
		}else{
			$scope.input.action="add";
			$scope.view.button="Tạo mới";
			$scope.view.new_name=false;
		}
		$scope.providers=[];
	}
	$scope.add_process=function(){
		$scope.input.id=CACHE.getVal('id');
		DB.provider($scope.input).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.input.code='';
				$scope.input.address='';
				$scope.input.contact='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
	$scope.add_del=function(){
		var send=[];
		send.id=CACHE.getVal('id');
		send.action='del';
		DB.provider(send).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.input.code='';
				$scope.input.address='';
				$scope.input.contact='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
})
.controller('purity', function($scope,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.puritys=[];
	$scope.input.action="add";
	$scope.view.button="Tạo mới";
	$scope.auto=[];
	$scope.auto.complete=function(name){
		if(CACHE.getVal('id')==null){$scope.view.button="Tạo mới";}
		DB.autocomplete('purity',$scope.input.name).then(function(result) {
			if($scope.input.name==undefined){
				$scope.puritys=[];
				CACHE.clear('id');
				$scope.view.new_name=false;
			}else{
				console.log(JSON.stringify(result));
				$scope.puritys=result.data;
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
			$scope.view.button="Thay đổi";
			$scope.view.new_name=true;
		}else{
			$scope.input.action="add";
			$scope.view.new_name=false;
		}
		$scope.puritys=[];
	}
	$scope.add_process=function(){
		$scope.input.id=CACHE.getVal('id');
		DB.purity($scope.input).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
	$scope.add_del=function(){
		var send=[];
		send.id=CACHE.getVal('id');
		send.action='del';
		DB.purity(send).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
})
.controller('store', function($scope,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.stores=[];
	$scope.input.action="add";
	$scope.view.button="Tạo mới";
	$scope.auto=[];
	$scope.auto.complete=function(name){
		if(CACHE.getVal('id')==null){$scope.view.button="Tạo mới";}
		DB.autocomplete('store',$scope.input.name).then(function(result) {
			if($scope.input.name==undefined){
				$scope.stores=[];
				CACHE.clear('id');
				$scope.view.new_name=false;
			}else{
				console.log(JSON.stringify(result));
				$scope.stores=result.data;
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
			$scope.view.button="Thay đổi";
			$scope.view.new_name=true;
		}else{
			$scope.input.action="add";
			$scope.view.new_name=false;
		}
		$scope.stores=[];
	}
	$scope.add_process=function(){
		$scope.input.id=CACHE.getVal('id');
		DB.store($scope.input).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
	$scope.add_del=function(){
		var send=[];
		send.id=CACHE.getVal('id');
		send.action='del';
		DB.store(send).then(function(result){
			$ionicPopup.alert({
				title: 'Kết quả',
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
})
.controller('util_field', function($scope,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.fields=[];
	$scope.users=[];
	$scope.input.action="add";
	$scope.view.button="Tạo mới";
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
				console.log(JSON.stringify(result));
				$scope[items]=result.data;
			}
		},function(err) {
			console.log(JSON.stringify(err));
		});
	};
	$scope.auto.choice=function(callback){
		var name=CACHE.getVal('auto')+'name';
		var id=CACHE.getVal('auto')+'id';
		var items=CACHE.getVal('auto')+'s';
		if(CACHE.getVal('auto')=='field'){
			$scope.input[name]=callback.name;
			CACHE.setVal(id,callback.id);
			$scope.input['username']=callback.username;
			CACHE.setVal('userid',callback.userid);			
		}else{
			$scope.input[name]=callback.name;
			CACHE.setVal(id,callback.id);
		}
		if(CACHE.getVal('fieldid')!=null){
			$scope.input.action="edit";
			$scope.view.button="Thay đổi";
			$scope.view.new_name=true;
		}else{
			$scope.input.action="add";
			$scope.view.button="Tạo mới";
			$scope.view.new_name=false;
		}
		$scope[items]=[];
	}
	$scope.add_process=function(){
		$scope.input.fieldid=CACHE.getVal('fieldid');
		$scope.input.userid=CACHE.getVal('userid');
		DB.field($scope.input).then(function(result){
			$ionicPopup.alert({title: result.data.status,template: result.data.message});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.fieldname='';
				CACHE.clear('fieldid');
				$scope.input.username='';
				CACHE.clear('userid');
				$scope.view.new_name=false;
			}
		})
	}
	$scope.add_del=function(){
		var send=[];
		send.fieldid=CACHE.getVal('fieldid');
		send.action='del';
		DB.field(send).then(function(result){
			$ionicPopup.alert({title: result.data.status,template: result.data.message});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.fieldname='';
				CACHE.clear('fieldid');
				$scope.input.username='';
				CACHE.clear('userid');
				$scope.view.new_name=false;
			}
		})
	}
})
.controller('util_state', function($scope,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.input.action="add";
	$scope.view.button="Tạo mới";
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
				console.log(JSON.stringify(result));
				$scope[items]=result.data;
			}
		},function(err) {
			console.log(JSON.stringify(err));
		});
	};
	$scope.auto.choice=function(callback){
		var name=CACHE.getVal('auto')+'name';
		var id=CACHE.getVal('auto')+'id';
		var items=CACHE.getVal('auto')+'s';
		$scope.input[name]=callback.name;
		CACHE.setVal(id,callback.id);
		if(CACHE.getVal('stateid')!=null){
			$scope.input.action="edit";
			$scope.view.button="Thay đổi";
			$scope.view.new_name=true;
		}else{
			$scope.input.action="add";
			$scope.view.button="Tạo mới";
			$scope.view.new_name=false;
		}
		$scope[items]=[];
	}
	$scope.add_process=function(){
		$scope.input.stateid=CACHE.getVal('stateid');
		DB.state($scope.input).then(function(result){
			$ionicPopup.alert({title: result.data.status,template: result.data.message});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.statename='';
				CACHE.clear('stateid');
				$scope.view.new_name=false;
			}
		})
	}
	$scope.add_del=function(){
		var send=[];
		send.stateid=CACHE.getVal('stateid');
		send.action='del';
		DB.state(send).then(function(result){
			$ionicPopup.alert({title: result.data.status,template: result.data.message});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.statename='';
				CACHE.clear('stateid');
				$scope.view.new_name=false;
			}
		})
	}
})
.controller('util_type', function($scope,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.input.action="add";
	$scope.view.button="Tạo mới";
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
				console.log(JSON.stringify(result));
				$scope[items]=result.data;
			}
		},function(err) {
			console.log(JSON.stringify(err));
		});
	};
	$scope.auto.choice=function(callback){
		var name=CACHE.getVal('auto')+'name';
		var id=CACHE.getVal('auto')+'id';
		var items=CACHE.getVal('auto')+'s';
		$scope.input[name]=callback.name;
		$scope.input['description']=callback.description;
		CACHE.setVal(id,callback.id);
		if(CACHE.getVal('typeid')!=null){
			$scope.input.action="edit";
			$scope.view.button="Thay đổi";
			$scope.view.new_name=true;
		}else{
			$scope.input.action="add";
			$scope.view.button="Tạo mới";
			$scope.view.new_name=false;
		}
		$scope[items]=[];
	}
	$scope.add_process=function(){
		$scope.input.stateid=CACHE.getVal('stateid');
		DB.type($scope.input).then(function(result){
			$ionicPopup.alert({title: result.data.status,template: result.data.message});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.typename='';
				$scope.input.description='';
				CACHE.clear('typeid');
				$scope.view.new_name=false;
			}
		})
	}
	$scope.add_del=function(){
		var send=[];
		send.stateid=CACHE.getVal('typeid');
		send.action='del';
		DB.type(send).then(function(result){
			$ionicPopup.alert({title: result.data.status,template: result.data.message});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.typename='';
				$scope.input.description='';
				CACHE.clear('typeid');
				$scope.view.new_name=false;
			}
		})
	}
})