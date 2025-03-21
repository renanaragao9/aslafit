<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Route\DashedRoute;

return function (RouteBuilder $routes): void {

    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $routes) {

        # Rotas autenticadas
        $routes->connect('/login', ['controller' => 'Auth', 'action' => 'login']);
        $routes->connect('/logout', ['controller' => 'Auth', 'action' => 'logout']);
        $routes->connect('/', ['controller' => 'Dashboard', 'action' => 'index']);
        $routes->connect('/reset-password', ['controller' => 'Auth', 'action' => 'resetPassword']);
        $routes->connect('/change-password/*', ['controller' => 'Auth', 'action' => 'changePassword']);

        # Rotas de usuários
        $routes->connect('/usuarios', ['controller' => 'Users', 'action' => 'index']);
        $routes->connect('/usuario/visualizar/:id', ['controller' => 'Users', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # Rotas de equipamentos
        $routes->connect('/equipamentos', ['controller' => 'Equipments', 'action' => 'index']);
        $routes->connect('/equipamentos/visualizar/:id', ['controller' => 'Equipments', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # trainingDivisions
        $routes->connect('/TrainingDivisions', ['controller' => 'TrainingDivisions', 'action' => 'index']);
        $routes->connect('/TrainingDivisions/visualizar/:id', ['controller' => 'TrainingDivisions', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # muscleGroups
        $routes->connect('/grupo-muscular', ['controller' => 'MuscleGroups', 'action' => 'index']);
        $routes->connect('/grupo-muscular/visualizar/:id', ['controller' => 'MuscleGroups', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # Rota de fallback
        $routes->fallbacks(DashedRoute::class);
    });

    $routes->prefix('Api', function (RouteBuilder $routes) {
        $routes->setExtensions(['json']);

        # Authenticated routes
        $routes->connect('/auth/login', ['controller' => 'Auth', 'action' => 'login']);
        $routes->connect('/auth/register', ['controller' => 'Auth', 'action' => 'register']);
        $routes->connect('/auth/logout', ['controller' => 'Auth', 'action' => 'logout']);
        $routes->fallbacks(DashedRoute::class);

        # Rotas de usuários API
        $routes->connect('/usuarios', ['controller' => 'Users', 'action' => 'fetchUsers', 'method' => 'GET']);
        $routes->connect('/usuario/:id', ['controller' => 'Users', 'action' => 'fetchUser', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/usuario-adicionar', ['controller' => 'Users', 'action' => 'addUser', 'method' => 'POST']);
        $routes->connect('/usuario-editar/:id', ['controller' => 'Users', 'action' => 'editUser', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/usuario-excluir/:id', ['controller' => 'Users', 'action' => 'deleteUser', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # Rotas de equipamentos API
        $routes->connect('/equipamentos', ['controller' => 'Equipments', 'action' => 'fetchEquipments', 'method' => 'GET']);
        $routes->connect('/equipamento/:id', ['controller' => 'Equipments', 'action' => 'fetchequipment', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/equipamento-adicionar', ['controller' => 'Equipments', 'action' => 'addEquipments', 'method' => 'POST']);
        $routes->connect('/equipamento-editar/:id', ['controller' => 'Equipments', 'action' => 'editEquipments', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/equipamento-excluir/:id', ['controller' => 'Equipments', 'action' => 'deleteEquipments', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # Rotas de divisões de treinamento API
        $routes->connect('/divisoes-treinamento', ['controller' => 'TrainingDivisions', 'action' => 'fetchTrainingDivisions', 'method' => 'GET']);
        $routes->connect('/divisao-treinamento/:id', ['controller' => 'TrainingDivisions', 'action' => 'fetchtrainingDivision', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/divisao-treinamento-adicionar', ['controller' => 'TrainingDivisions', 'action' => 'addTrainingDivisions', 'method' => 'POST']);
        $routes->connect('/divisao-treinamento-editar/:id', ['controller' => 'TrainingDivisions', 'action' => 'editTrainingDivisions', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/divisao-treinamento-excluir/:id', ['controller' => 'TrainingDivisions', 'action' => 'deleteTrainingDivisions', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # MuscleGroups routes API
        $routes->connect('/grupo-muscular', ['controller' => 'MuscleGroups', 'action' => 'fetchMuscleGroups', 'method' => 'GET']);
        $routes->connect('/grupo-muscular/:id', ['controller' => 'MuscleGroups', 'action' => 'fetchmuscleGroup', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/grupo-muscular-add', ['controller' => 'MuscleGroups', 'action' => 'addMuscleGroups', 'method' => 'POST']);
        $routes->connect('/grupo-muscular-edit/:id', ['controller' => 'MuscleGroups', 'action' => 'editMuscleGroups', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/grupo-muscular-delete/:id', ['controller' => 'MuscleGroups', 'action' => 'deleteMuscleGroups', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    });
};
