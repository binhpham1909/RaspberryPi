// Include dependency: ngCordova
myapp=angular.module('hbiot', ['ionic','services']);

myapp.config(function($stateProvider, $urlRouterProvider){
	$stateProvider
	// Master tabs
    .state('tabs', {
      url: "/tab",
      abstract: true,
      templateUrl: "templates/tabs.html"
    })

	///////////////////////
	//    Tab trang thai   //
	///////////////////////

    .state('tabs.status', {
      url: "/status",
      views: {
        'status-tab': {
          templateUrl: "templates/t.status.php",
          controller: 'status'
        }
      }
    })
    .state('tabs.status_temp', {
      url: "/status.temp",
      views: {
        'status-tab': {
          templateUrl: "templates/t.status.temp.php",
          controller: 'status_temp'
        }
      }
    })
	.state('tabs.status_humi', {
      url: "/status.humi",
      views: {
        'status-tab': {
          templateUrl: "templates/t.status.humi.php",
          controller: 'status_humi'
        }
      }
    })
	///////////////////////
	// Tab cong cu khac  //
	///////////////////////
    .state('tabs.setup', {
      url: "/setup",
      views: {
        'setup-tab': {
          templateUrl: "templates/t.setup.php",
          controller: 'setup'
        }
      }
    })
 

	///////////////////////
	//    Tab thiet bi    //
	///////////////////////
    .state('tabs.device', {
      url: "/device",
      views: {
        'device-tab': {
          templateUrl: "templates/t.device.php",
          controller: 'device'
        }
      }
    })

	$urlRouterProvider.otherwise("/tab/status");
})