function ChampSelectCtrl($stateProvider, UserDataService, API) {
    const vm = this;

    if (typeof UserDataService.getUserRegion() === 'undefined' || typeof UserDataService.getUserId() === 'undefined') {
        $stateProvider.go('Home');
    }

    let lastBanPosition = null;
    let lastPickPosition = null;
    let teamPick = null;
    vm.bans = {};
    vm.userPicks = [];

    API.getUserPicks({
        id: UserDataService.getUserId(),
        region: UserDataService.getUserRegion()
    }).success((data) => {
        vm.userPicks = data;
    }).error(() => {
        console.log('error');
    });
    
    API.getSuggestedBans().success((data) => {
        vm.bans = data;
    }).error(() => {
        console.log('error')
    });

    vm.teamsBans = new Array(6);
    vm.allyTeam = new Array(5);
    vm.enemyTeam = new Array(5);

    for(let i = 0; i < vm.teamsBans.length; i++) {
        if (i < 3) {
            vm.teamsBans[i] = {side: 'left'}
        } else {
            vm.teamsBans[i] = {side: 'right'}            
        }
    }
    
    for(let i = 0; i < vm.allyTeam.length; i++) {
        vm.allyTeam[i] = {
            user: false,
            role: '0',
            champion: null,
            championImage: null
        }
    }
    for(let i = 0; i < vm.enemyTeam.length; i++) {
        vm.enemyTeam[i] = {
            champion: null,
            championImage: null
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
        lastPickPosition = null;
        vm.showPicks = true;
    };

    vm.choosePick = function(side, position) {
        let userPick = false;
        if (side === 'ally') {
            if (vm.allyTeam[position].user === 'user') {
                userPick = {
                    id: UserDataService.getUserId(),
                    region: UserDataService.getUserRegion()
                };
            }
        }

        API.getPicksList({
            user: userPick,
            bans: vm.teamsBans,
            allyPicks: vm.allyTeam,
            enemyPicks: vm.enemyTeam
        }).success((data) => {
            vm.picks = data;
        }).error(() => {
            console.log('error');
        });

        teamPick = side;
        lastPickPosition = position;
        lastBanPosition = null;
        vm.showPicks = true;
    };

    vm.selectChampion = function(id) {
        let champion = getChampion(id);
        
        if (lastBanPosition !== null) {
            vm.teamsBans[lastBanPosition].champion = champion.champion;
            vm.teamsBans[lastBanPosition].image = champion.image;

            lastBanPosition = null;
        }

        if (lastPickPosition !== null) {
            if (teamPick === 'ally') {
                vm.allyTeam[lastPickPosition].champion = champion.champion;
                vm.allyTeam[lastPickPosition].championImage = champion.image;
            } else if (teamPick === 'enemy') {
                vm.enemyTeam[lastPickPosition].champion = champion.champion;
                vm.enemyTeam[lastPickPosition].championImage = champion.image;
            }
        }

        vm.showPicks = false;
        vm.championName = '';
    };

    function getChampion(id) {
        let champion =  vm.picks.filter(function(element) {
            if (element.id === id) {
                return element;
            }
        });

        return champion[0];
    }
}

ChampSelectCtrl.$inject = ['$state', 'UserDataService', 'API'];

export default {
    name: 'ChampSelectCtrl',
    fn: ChampSelectCtrl
};