//creamos el modulo y le aplicamos la configuración
//var moduleApp = angular.module("moduleApp", ["ngRoute"]).config(configRoutes);
var moduleApp = angular.module('moduleApp', ['ui.router']);

moduleApp.config(function ($stateProvider,$urlRouterProvider) {

    var newTournamentState = {
        name: 'newTournament',
        url: '/newTournament',
        templateUrl: 'views/newTournament.html',
        controller: 'newTournamentController'
    }

    var saveTournamentState = {
        name: 'saveTournament',
        url: '/saveTournament',
        templateUrl: 'views/saveTournament.html',
        controller: 'saveTournamentController'
    }
    var championshipState = {
        name: 'championships',
        url: '/championships',
        templateUrl: 'views/championships.html',
        controller: 'championshipsController'
    }


    $stateProvider.state(newTournamentState);
    $stateProvider.state(saveTournamentState);
    $stateProvider.state(championshipState);
    $urlRouterProvider.otherwise('/newTournament');

});
