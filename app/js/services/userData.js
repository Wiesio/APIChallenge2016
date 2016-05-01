function UserDataService() {
  'ngInject';

  var userData = {};

  var setUserId = function(id) {
    userData.id = id
  };

  var getUserId = function() {
    return userData.id;
  };

  var setUserRegion = function(region) {
    userData.region = region
  };

  var getUserRegion = function() {
    return userData.region;
  };

  return {
    setUserId: setUserId,
    getUserId: getUserId,
    setUserRegion: setUserRegion,
    getUserRegion: getUserRegion
  };
}

export default {
  name: 'UserDataService',
  fn: UserDataService
};
