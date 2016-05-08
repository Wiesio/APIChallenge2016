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
    vm.alerts = [];

    API.getUserPicks({
        id: UserDataService.getUserId(),
        region: UserDataService.getUserRegion()
    }).success((data) => {
        vm.userPicks = data;
        vm.alerts = [];
    }).error((data) => {
        if (typeof data === 'object') {
            vm.alerts = [{ type: 'alert', msg: data.error }];
        } else {
            vm.alerts = [{ type: 'alert', msg: 'Sorry, there was an error.' }];
        }
    });
    
    API.getSuggestedBans({
        id: UserDataService.getUserId(),
        region: UserDataService.getUserRegion()
    }).success((data) => {
        vm.bans = data;
        vm.alerts = [];
    }).error((data) => {
        if (typeof data === 'object') {
            vm.alerts = [{ type: 'alert', msg: data.error }];
        } else {
            vm.alerts = [{ type: 'alert', msg: 'Sorry, there was an error.' }];
        }
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
            title: null,
            image: null
        }
    }
    for(let i = 0; i < vm.enemyTeam.length; i++) {
        vm.enemyTeam[i] = {
            champion: null,
            title: null,
            image: null
        }
    }

    vm.chooseBan = function(side, position) {
        let bans = [];

        for(let i = 0; i < vm.teamsBans.length; i++) {
            let ban = vm.teamsBans[i];
            if (typeof ban.id !== 'undefined') {
                bans.push(ban.id);
            }
        }

        API.getBansList({
            user: {
                id: UserDataService.getUserId(),
                region: UserDataService.getUserRegion()
            },
            bans: bans
        }).success((data) => {
            vm.picks = data;
            vm.alerts = [];
        }).error((data) => {
            if (typeof data === 'object') {
                vm.alerts = [{ type: 'alert', msg: data.error }];
            } else {
                vm.alerts = [{ type: 'alert', msg: 'Sorry, there was an error.' }];
            }
        });
        
        if (side === 'right') {
            position = position + 3;
        }

        lastBanPosition = position;
        lastPickPosition = null;
        vm.showPicks = true;
    };

    vm.choosePick = function(side, position) {
        let bans = [];
        let allyPicks = [];
        let enemyPicks = [];

        for(let i = 0; i < vm.teamsBans.length; i++) {
            let ban = vm.teamsBans[i];
            if (typeof ban.id !== 'undefined') {
                bans.push(ban.id);
            }
        }

        for(let i = 0; i < vm.allyTeam.length; i++) {
            let pick = vm.allyTeam[i];
            if (typeof pick.id !== 'undefined') {
                allyPicks.push(pick.id);
            }
        }

        for(let i = 0; i < vm.enemyTeam.length; i++) {
            let pick = vm.enemyTeam[i];
            if (typeof pick.id !== 'undefined') {
                enemyPicks.push(pick.id);
            }
        }

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
            region: UserDataService.getUserRegion(),
            user: userPick,
            bans: bans,
            allyPicks: allyPicks,
            enemyPicks: enemyPicks
        }).success((data) => {
            vm.picks = data;
            vm.alerts = [];
        }).error((data) => {
            if (typeof data === 'object') {
                vm.alerts = [{ type: 'alert', msg: data.error }];
            } else {
                vm.alerts = [{ type: 'alert', msg: 'Sorry, there was an error.' }];
            }
        });

        teamPick = side;
        lastPickPosition = position;
        lastBanPosition = null;
        vm.showPicks = true;
    };

    vm.selectChampion = function(id) {
        let champion = getChampion(id);
        
        if (lastBanPosition !== null) {
            vm.teamsBans[lastBanPosition].id = champion.id;
            vm.teamsBans[lastBanPosition].champion = champion.champion;
            vm.teamsBans[lastBanPosition].image = champion.image;

            lastBanPosition = null;
        }

        if (lastPickPosition !== null) {
            if (teamPick === 'ally') {
                vm.allyTeam[lastPickPosition].id = champion.id;
                vm.allyTeam[lastPickPosition].champion = champion.champion;
                vm.allyTeam[lastPickPosition].title = champion.title;
                vm.allyTeam[lastPickPosition].image = champion.image;
            } else if (teamPick === 'enemy') {
                vm.enemyTeam[lastPickPosition].id = champion.id;
                vm.enemyTeam[lastPickPosition].champion = champion.champion;
                vm.enemyTeam[lastPickPosition].title = champion.title;
                vm.enemyTeam[lastPickPosition].image = champion.image;
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