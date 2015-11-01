var app = angular.module('app');

app.controller('AuthController', function ($auth, $state, $http, $rootScope, $scope) {

    $scope.newUser = {};
    $scope.loginError = false;
    $scope.loginErrorText = '';

    $scope.githubLogin = function () {
        $auth.authenticate('github')
            .then(function(response) {
                $window.localStorage.currentUser = JSON.stringify(response.data.user);
                $rootScope.currentUser = JSON.parse($window.localStorage.currentUser);
            })
            .catch(function(response) {
                console.log(response.data);
            });
    };

    $scope.login = function () {

        $auth.login().then(function () {

            return $http.get('api/authenticate/user');

        }, function (error) {
            $scope.loginError = true;
            $scope.loginErrorText = error.data.error;

        }).then(function (response) {
            $rootScope.currentUser = response.data.user;
            $scope.loginError = false;
            $scope.loginErrorText = '';

            $state.go('todo');
        });
    };
});

