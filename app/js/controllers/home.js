function HomeCtrl($stateProvider, UserDataService, API) {

  // ViewModel
  const vm = this;

  vm.form = {};
  vm.regions = [
    {
      id: 1,
      name: 'EUNE'
    },
    {
      id: 2,
      name: 'EUW'
    }
  ];

  vm.form.region = String(vm.regions[0].id);
  vm.form.name = '';

  vm.searchSummoner = function(form) {
    API.getUserData({
      name: form.name,
      region: form.region
    }).success((data) => {
      UserDataService.setUserId(data.user);
      UserDataService.setUserRegion(data.region);

      $stateProvider.go('ChampSelect');
    }).error(() => {
      console.log('error');
    });
  }
}

HomeCtrl.$inject = ['$state', 'UserDataService', 'API'];

export default {
  name: 'HomeCtrl',
  fn: HomeCtrl
};
