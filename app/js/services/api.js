function API($http) {
  'ngInject';

  const service = {};
  const apiPath = 'http://localhost/APIChallenge2016/response/';

  service.getUserData = function(userData) {
    return $http.post(apiPath + 'getUser.json', userData);
  };
  service.getSuggestedBans = function() {
    return $http.get(apiPath + 'getBans.json');
  };
  service.getBansList = function(data) {
    return $http.post(apiPath + 'getBans.json', data);
  };
  service.getPicksList = function(data) {
    return $http.post(apiPath + 'getPicks.json', data);
  };
  service.getUserPicks = function(data) {
    return $http.post(apiPath + 'getUserPicks.json', data);
  };

  return service;
}

export default {
  name: 'API',
  fn: API
};
