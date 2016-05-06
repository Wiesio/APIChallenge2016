function API($http) {
  'ngInject';

  const service = {};
  const apiPath = 'http://localhost/APIChallenge2016/response/';

  // Get regions
  service.getRegions = function() {
    return $http.get(apiPath + 'getRegions.json');
  };
  // Get user data like id, region
  service.getUserData = function(userData) {
    return $http.post(apiPath + 'getUser.json', userData);
  };
  // Get most popular bans
  service.getSuggestedBans = function() {
    return $http.get(apiPath + 'getBans.json');
  };
  // Get champions for ban
  service.getBansList = function(data) {
    return $http.post(apiPath + 'getBans.json', data);
  };
  // Get picks
  service.getPicksList = function(data) {
    return $http.post(apiPath + 'getPicks.json', data);
  };
  // Get most user's most popular champions
  service.getUserPicks = function(data) {
    return $http.post(apiPath + 'getUserPicks.json', data);
  };

  return service;
}

export default {
  name: 'API',
  fn: API
};
