myapp
.controller('user', function($scope,$ionicHistory,$ionicPopup,CACHE) {
})
.controller('user_info', function($scope,$ionicHistory,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.users=[];
	$scope.input.action="add";
	$scope.input.birthday=new Date(1950,1,1);
	$scope.input.joins=new Date(1950,1,1);
	$scope.input.quit=new Date(1950,1,1);
	$scope.input.require=true;
	$scope.view.button="Tạo mới";
	$scope.auto=[];
	$scope.auto.complete=function(name){
		if(CACHE.getVal('id')==null){$scope.view.button="Tạo mới";}
		DB.autocomplete('user',$scope.input.name).then(function(result) {
			if($scope.input.name==undefined){
				$scope.users=[];
				CACHE.clear('id');
				$scope.view.new_name=false;
			}else{
				console.log(JSON.stringify(result));
				$scope.users=result.data;
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
		$scope.users=[];
	}
	$scope.add_process=function(){
		$scope.input.id=CACHE.getVal('id');
		DB.user_info($scope.input).then(function(result){
			$ionicPopup.alert({
				title: result.data.status,
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.input.username='';
				$scope.input.password='';
				$scope.input.email='';
				$scope.input.phone='';
				$scope.input.birthday='';
				$scope.input.joins='';
				$scope.input.quit='';
				$scope.input.school='';
				$scope.input.branch='';
				$scope.input.position='';
				$scope.input.address='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
	$scope.add_del=function(){
		var send=[];
		send.id=CACHE.getVal('id');
		send.action='del';
		DB.user_info(send).then(function(result){
			$ionicPopup.alert({
				title: result.data.status,
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.action="add";
				$scope.input.name='';
				$scope.input.username='';
				$scope.input.password='';
				$scope.input.email='';
				$scope.input.phone='';
				$scope.input.birthday='';
				$scope.input.joins='';
				$scope.input.quit='';
				$scope.input.school='';
				$scope.input.branch='';
				$scope.input.position='';
				$scope.input.address='';
				$scope.view.new_name=false;
				CACHE.clear('id');
			}
		})
	}
})
.controller('user_password', function($scope,$ionicHistory,$ionicPopup,CACHE,DB) {
	$scope.input={};
	$scope.view={};
	$scope.users=[];
	$scope.input.password='';
	$scope.input.repassword='';
	$scope.view.button="Thay đổi";
	$scope.auto=[];
	$scope.auto.complete=function(name){
		if(CACHE.getVal('id')==null){$scope.view.button="Tạo mới";}
		DB.autocomplete('user',$scope.input.name).then(function(result) {
			if($scope.input.name==undefined){
				$scope.users=[];
				CACHE.clear('id');
			}else{
				console.log(JSON.stringify(result));
				$scope.users=result.data;
			}
		},function(err) {
			console.log(JSON.stringify(err));
		});
	};
	$scope.auto.choice=function(callback){
		$scope.input=callback;
		CACHE.setVal('id',callback.id);
		$scope.users=[];
	}
	$scope.change_process=function(){
		$scope.input.id=CACHE.getVal('id');
		if($scope.input.password!=$scope.input.repassword){
			$ionicPopup.alert({
				title: 'Chú ý',
				template: 'Mật khẩu nhập lại không khớp'
			});
		}else{
		$scope.input.action='change_pass';
		DB.user_info($scope.input).then(function(result){
			$ionicPopup.alert({
				title: result.data.status,
				template: result.data.message
			});
			if(result.data.result=="ok"){
				$scope.input.name='';
				$scope.input.password='';
				$scope.input.repassword='';
				CACHE.clear('id');
			}
		})		
		}
	}
})