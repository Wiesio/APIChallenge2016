function ChampSelectCtrl(UserDataService) {
    const vm = this;

    console.log(UserDataService.getUserRegion())
    vm.region = UserDataService.getUserRegion();
}

ChampSelectCtrl.$inject = ['UserDataService'];

export default {
    name: 'ChampSelectCtrl',
    fn: ChampSelectCtrl
};