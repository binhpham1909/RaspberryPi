angular.module('services', [])
.factory('CacheService', function($cacheFactory) {
    return $cacheFactory('CacheService');
})
.factory('CACHE', function(CacheService) {
    return {
        getVal: function(key) {
            var news = CacheService.get(key);
            if(news) {
                return news;
            }
            return null;
        },
        setVal: function(key, value) {
            CacheService.put(key, value);
        },
        clear: function(key) {
            CacheService.put(key, '');
        },
        remove: function(key) {
            CacheService.remove(key);
        },
        removeAll: function() {
            CacheService.removeAll();
        }
    };
})
.factory('LOGOUT', function($http) {
    return {
        logout: function() {
			return $http.post('process/login.php',{'action':'logout'});
        }
    };
})
.factory('DB', function($http) {
    return {
        autocomplete: function(table,key) {
            return $http.post('process/autocomplete.php',{'type':table, 'term':key});
        },
		fullinfo: function(data) {
            return $http.post('process/chemical.fullinfo.php',{
				'action':data.action,
				'id':data.contentid,
				'name':data.contentname,
				'chemical':data.chemicalid,
				'type':data.typeid,
				'manufactor':data.manufactorid,
				'provider':data.providerid,
				'units':data.unitsid,
				'purity':data.purityid,
				'store':data.storeid,
				'field':data.fieldid,
				'state':data.stateid});
        },
		chemical_import: function(data) {
            return $http.post('process/chemical.import.php',{
				'content':data.contentid,
				'weight':data.weight,
				'code':data.code,
				'lot':data.lot,
				'receive':data.receive,
				'expired':data.expired,
				'open_date':data.opens,
				'user_receive':data.user_receiveid,
				'user_open':data.user_openid,
				'description':data.desc
				});
        },
		toolChemical: function(data) {
            return $http.post('process/chemical.add.php',{
				'action':data.action,
				'id':data.id,
				'name':data.name,
				'type':data.typeid,
				'new_name':data.new_name,
				'properties':data.properties});
        },
		manufactor: function(data) {
            return $http.post('process/util.manufactor.php',{
				'action':data.action,
				'id':data.id,
				'name':data.name,
				'code':data.code,
				'address':data.address,
				'contact':data.contact});
        },
		units: function(data) {
            return $http.post('process/util.units.php',{
				'action':data.action,
				'id':data.id,
				'name':data.name,
				'symbol':data.symbol});
        },
		field: function(data) {
            return $http.post('process/util.field.php',{
				'action':data.action,
				'id':data.fieldid,
				'name':data.fieldname,
				'user':data.userid});
        },
		provider: function(data) {
            return $http.post('process/util.provider.php',{
				'action':data.action,
				'id':data.id,
				'name':data.name,
				'code':data.code,
				'address':data.address,
				'contact':data.contact});
        },
		purity: function(data) {
            return $http.post('process/util.purity.php',{
				'action':data.action,
				'id':data.id,
				'name':data.name});
        },
		store: function(data) {
            return $http.post('process/util.store.php',{
				'action':data.action,
				'id':data.id,
				'name':data.name});
        },
		state: function(data) {
            return $http.post('process/util.state.php',{
				'action':data.action,
				'id':data.stateid,
				'name':data.statename});
        },
		type: function(data) {
            return $http.post('process/util.type.php',{
				'action':data.action,
				'id':data.typeid,
				'name':data.typename,
				'description':data.description});
        },
		user_info: function(data) {
            return $http.post('process/user.info.php',{
				'action':data.action,
				'id':data.id,
				'name':data.name,
				'username':data.username,
				'password':data.password,
				'email':data.email,
				'phone':data.phone,
				'birthday':data.birthday,
				'joins':data.joins,
				'quit':data.quit,
				'school':data.school,
				'branch':data.branch,
				'position':data.position,
				'address':data.address});
        }
    };
})