<?php
require_once(__DIR__ . "/php/require_all.php");

define("premier", 1);
define("deuxieme", 2);
define("troisieme", 3);
define("quatrieme", 4);

$class = "";

?>


<html>
<head>
    <?php require_once(__DIR__ . "/inc/head.php"); ?>
</head>
<body ng-app="myApp">

<?php require_once(__DIR__ . "/inc/nav.php"); ?>

<section ng-controller="list_courses">

    <header>
        <h1>Liste des cours</h1>
    </header>

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col" ng-click="sortBy('bloc')">Bloc</th>
            <th scope="col" ng-click="sortBy('nom')">Nom du cours</th>
            <th scope="col" ng-click="sortBy('type')">Type de cours</th>
            <th scope="col" ng-click="sortBy('heure_debut')">Heure de début</th>
            <th scope="col" ng-click="sortBy('heure_fin')">Heure de fin</th>
            <th scope="col">Indus</th>
            <th scope="col">Réseau</th>
            <th scope="col">Gestion</th>
            <th scope="col">Voir</th>
        </tr>
        </thead>
        <tbody>


        <tr class="table" ng-repeat="row in rows">
            <th scope="row">{{ row.bloc }}</th>
            <th scope="row">{{ row.nom }}</th>
            <th scope="row">{{ row.type }}</th>
            <th scope="row">{{ row.heure_debut }}</th>
            <th scope="row">{{ row.heure_fin }}</th>
            <th scope="row">{{ row.indus }}</th>
            <th scope="row">{{ row.reseau }}</th>
            <th scope="row">{{ row.gestion }}</th>
            <th scope="row"><a class="btn btn-outline-secondary"  data-course-id="{{ row.id }}">Ajouter</a></th>
        </tr>

        </tbody>
    </table>
</section>



<script>


        var app = angular.module('myApp', []);

        // pour ajax ajouter apres le $scope, un $http pour dire que je veux utiliser ça
        // $scope.$on("nomDeLevenement", functionALancer);

        app.controller('list_courses', ['$scope', 'orderByFilter', function($scope, orderBy) {

            $scope.rows = JSON.parse('<?php echo(Cours::getAllCourses()); ?>');

            $scope.propertyName = 'bloc';
            $scope.reverse = true;
            $scope.rows = orderBy($scope.rows, $scope.propertyName, $scope.reverse);

            $scope.sortBy = function(propertyName) {
                $scope.reverse = (propertyName !== null && $scope.propertyName === propertyName) ? !$scope.reverse : false;
                                                                          // ce qui est après le ? est executé
                $scope.propertyName = propertyName;
                $scope.rows = orderBy($scope.rows, $scope.propertyName, $scope.reverse);
            };
        }]);


</script>
</body>
</html>
