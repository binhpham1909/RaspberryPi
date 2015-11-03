// Include dependency: ngCordova
myapp=angular.module('chemical', ['ionic','services']);

myapp.config(function($stateProvider, $urlRouterProvider){
	$stateProvider
	// Master tabs
    .state('tabs', {
      url: "/tab",
      abstract: true,
      templateUrl: "templates/tabs.html"
    })

	///////////////////////
	//    Tab Hoa chat   //
	///////////////////////


    .state('tabs.chemical', {
      url: "/chemical",
      views: {
        'chemical-tab': {
          templateUrl: "templates/chemical.php",
          controller: 'chemical'
        }
      }
    })
    .state('tabs.used', {
      url: "/used",
      views: {
        'chemical-tab': {
          templateUrl: "templates/chemical.used.php",
          controller: 'used'
        }
      }
    })

	.state('tabs.chemical_add', {
      url: "/chemical_add",
      views: {
        'chemical-tab': {
          templateUrl: "templates/chemical.add.php",
          controller: 'chemical_add'
        }
      }
    })
    .state('tabs.chemical_fullinfo', {
      url: "/chemical_fullinfo",
      views: {
        'chemical-tab': {
          templateUrl: "templates/chemical.fullinfo.php",
          controller: 'chemical_fullinfo'
        }
      }
    })
    .state('tabs.chemical_import', {
      url: "/chemical_import",
      views: {
        'chemical-tab': {
          templateUrl: "templates/chemical.import.php",
          controller: 'chemical_import'
        }
      }
    })
	///////////////////////
	// Tab cong cu khac  //
	///////////////////////
    .state('tabs.utility', {
      url: "/utility",
      views: {
        'utility-tab': {
          templateUrl: "templates/utility.php",
          controller: 'utility'
        }
      }
    })
    .state('tabs.units', {
      url: "/units",
      views: {
        'utility-tab': {
          templateUrl: "templates/util.units.php",
          controller: 'units'
        }
      }
    })
	.state('tabs.manufactor', {
      url: "/manufactor",
      views: {
        'utility-tab': {
          templateUrl: "templates/util.manufactor.php",
          controller: 'manufactor'
        }
      }
    })
	.state('tabs.provider', {
      url: "/provider",
      views: {
        'utility-tab': {
          templateUrl: "templates/util.provider.php",
          controller: 'provider'
        }
      }
    })
	.state('tabs.purity', {
      url: "/purity",
      views: {
        'utility-tab': {
          templateUrl: "templates/util.purity.php",
          controller: 'purity'
        }
      }
    })
	.state('tabs.store', {
      url: "/store",
      views: {
        'utility-tab': {
          templateUrl: "templates/util.store.php",
          controller: 'store'
        }
      }
    })
	.state('tabs.field', {
      url: "/util_field",
      views: {
        'utility-tab': {
          templateUrl: "templates/util.field.php",
          controller: 'util_field'
        }
      }
    })
	.state('tabs.state', {
      url: "/util_state",
      views: {
        'utility-tab': {
          templateUrl: "templates/util.state.php",
          controller: 'util_state'
        }
      }
    })
	.state('tabs.type', {
      url: "/util_type",
      views: {
        'utility-tab': {
          templateUrl: "templates/util.type.php",
          controller: 'util_type'
        }
      }
    })

	///////////////////////
	//    Tab nhân sự    //
	///////////////////////
    .state('tabs.user', {
      url: "/user",
      views: {
        'user-tab': {
          templateUrl: "templates/user.php",
          controller: 'user'
        }
      }
    })
	.state('tabs.user_info', {
      url: "/user_info",
      views: {
        'user-tab': {
          templateUrl: "templates/user.info.php",
          controller: 'user_info'
        }
      }
    })
	.state('tabs.user_password', {
      url: "/user_password",
      views: {
        'user-tab': {
          templateUrl: "templates/user.password.php",
          controller: 'user_password'
        }
      }
    })
	$urlRouterProvider.otherwise("/tab/chemical");
})