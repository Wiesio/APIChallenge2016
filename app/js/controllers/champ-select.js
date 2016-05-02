function ChampSelectCtrl($stateProvider, UserDataService, API) {
    const vm = this;

    if (typeof UserDataService.getUserRegion() === 'undefined' || typeof UserDataService.getUserId() === 'undefined') {
        $stateProvider.go('Home');
    }

    let lastBanPosition = null;
    vm.bans = {};

    API.getSuggestedBans().success((data) => {
        vm.bans = data;
    }).error(() => {
        console.log('error')
    });

    vm.teamsBans = new Array(6);
    
    for(let i = 0; i < vm.teamsBans.length; i++) {
        if (i < 3) {
            vm.teamsBans[i] = {side: 'left'}
        } else {
            vm.teamsBans[i] = {side: 'right'}            
        }
    }

    vm.chooseBan = function(side, position) {
        API.getBansList({
            bans: vm.teamsBans
        }).success((data) => {
            vm.picks = data;
        }).error(() => {
            console.log('error');
        });
        
        if (side === 'right') {
            position = position + 3;
        }

        lastBanPosition = position;
        vm.showPicks = true;
    };

    vm.selectChampion = function(index) {
        let champion = vm.picks[index];
        if (lastBanPosition !== null) {
            vm.teamsBans[lastBanPosition].champion = champion.champion;
            vm.teamsBans[lastBanPosition].image = champion.image;

            lastBanPosition = null;
        }

        vm.showPicks = false;
    };
}

ChampSelectCtrl.$inject = ['$state', 'UserDataService', 'API'];

export default {
    name: 'ChampSelectCtrl',
    fn: ChampSelectCtrl
};