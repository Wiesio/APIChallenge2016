function HomeCtrl($stateProvider, UserDataService, API) {

  // ViewModel
  const vm = this;

  vm.form = {};
  vm.regions = [];

  API.getRegions().success((data) => {
    vm.regions = data;
    vm.form.region = String(vm.regions[0].id);
  }).error(() => {
    console.log('error');
  });

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
