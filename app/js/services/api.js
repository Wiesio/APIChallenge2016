function API($http) {
  'ngInject';

  const service = {};
  const apiPath = 'http://localhost/APIChallenge2016/response/';

  service.getUserData = function(userData) {
      return $http.post(apiPath + 'getUser.php', userData);
  };

  return service;
}

export default {
  name: 'API',
  fn: API
};
