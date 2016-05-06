function HomeCtrl($stateProvider, UserDataService, API) {

  // ViewModel
  const vm = this;

  vm.form = {};
  vm.regions = [];
  vm.alerts = [];

  API.getRegions().success((data) => {
    vm.regions = data;
    vm.form.region = String(vm.regions[0].id);
  }).error((data) => {
    if (typeof data === 'object') {
      vm.alerts = [{ type: 'alert', msg: data.error }];
    } else {
      vm.alerts = [{ type: 'alert', msg: 'Sorry, there was an error.' }];
    }
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
    }).error((data) => {
      if (typeof data === 'object') {
        vm.alerts = [{ type: 'alert', msg: data.error }];
      } else {
        vm.alerts = [{ type: 'alert', msg: 'Sorry, there was an error.' }];
      }
    });
  }
}

HomeCtrl.$inject = ['$state', 'UserDataService', 'API'];

export default {
  name: 'HomeCtrl',
  fn: HomeCtrl
};
