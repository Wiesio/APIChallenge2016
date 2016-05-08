function showPercents() {

  return {
    restrict: 'EA',
    scope: {
      showPercents: '@'
    },
    link: (scope, element, attrs) => {
      scope.$watch("showPercents", (newValue, oldValue) => {
        let percent = parseInt(newValue * 10000) / 100;
        element.text(percent);
      });
    }
  };
}

export default {
  name: 'showPercents',
  fn: showPercents
};
