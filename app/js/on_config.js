function OnConfig($stateProvider, $locationProvider, $urlRouterProvider) {
  'ngInject';

  $locationProvider.html5Mode(true);

  $stateProvider
  .state('Home', {
    url: '/',
    controller: 'HomeCtrl as home',
    templateUrl: 'home.html',
    title: 'Home'
  })
  .state('ChampSelect', {
    url: '/champSelect',
    controller: 'ChampSelectCtrl as champ',
    templateUrl: 'champ-select.html',
    title: 'Champions Select'
  });

  $urlRouterProvider.otherwise('/');

}

export default OnConfig;
