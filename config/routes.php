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

        $routes->connect('/perfis', ['controller' => 'Roles', 'action' => 'index']);
        $routes->connect('/perfil/visualizar/:id', ['controller' => 'Roles', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # Rotas de equipamentos
        $routes->connect('/equipamentos', ['controller' => 'Equipments', 'action' => 'index']);
        $routes->connect('/equipamentos/visualizar/:id', ['controller' => 'Equipments', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # trainingDivisions
        $routes->connect('/divisao-de-treinamento', ['controller' => 'TrainingDivisions', 'action' => 'index']);
        $routes->connect('/divisao-de-treinamento/visualizar/:id', ['controller' => 'TrainingDivisions', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # muscleGroups
        $routes->connect('/grupo-muscular', ['controller' => 'MuscleGroups', 'action' => 'index']);
        $routes->connect('/grupo-muscular/visualizar/:id', ['controller' => 'MuscleGroups', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # foodTypes routes
        $routes->connect('/tipo-alimentos', ['controller' => 'FoodTypes', 'action' => 'index']);
        $routes->connect('/tipo-alimento/visualizar/:id', ['controller' => 'FoodTypes', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # foods routes
        $routes->connect('/alimentos', ['controller' => 'Foods', 'action' => 'index']);
        $routes->connect('/alimento/visualizar/:id', ['controller' => 'Foods', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # itemTypes routes
        $routes->connect('/tipo-item', ['controller' => 'ItemTypes', 'action' => 'index']);
        $routes->connect('/tipo-item/visualizar/:id', ['controller' => 'ItemTypes', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # mealTypes routes
        $routes->connect('/tipo-refeicoes', ['controller' => 'MealTypes', 'action' => 'index']);
        $routes->connect('/tipo-refeicao/visualizar/:id', ['controller' => 'MealTypes', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        $routes->connect('/forma-pagamentos', ['controller' => 'FormPayments', 'action' => 'index']);
        $routes->connect('/forma-pagamento/visualizar/:id', ['controller' => 'FormPayments', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # positions routes
        $routes->connect('/cargos', ['controller' => 'Positions', 'action' => 'index']);
        $routes->connect('/cargo/visualizar/:id', ['controller' => 'Positions', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # storageLocations routes
        $routes->connect('/locais-armazenamento', ['controller' => 'StorageLocations', 'action' => 'index']);
        $routes->connect('/local-armazenamento/visualizar/:id', ['controller' => 'StorageLocations', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # suppliers routes
        $routes->connect('/fornecedores', ['controller' => 'Suppliers', 'action' => 'index']);
        $routes->connect('/fornecedor/visualizar/:id', ['controller' => 'Suppliers', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # planTypes routes
        $routes->connect('/tipo-planos', ['controller' => 'PlanTypes', 'action' => 'index']);
        $routes->connect('/tipo-plano/visualizar/:id', ['controller' => 'PlanTypes', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # exercises routes
        $routes->connect('/exercicios', ['controller' => 'Exercises', 'action' => 'index']);
        $routes->connect('/exercicio/visualizar/:id', ['controller' => 'Exercises', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # students routes
        $routes->connect('/alunos', ['controller' => 'Students', 'action' => 'index']);
        $routes->connect('/aluno/visualizar/:id', ['controller' => 'Students', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # collaborators routes
        $routes->connect('/colaboradores', ['controller' => 'Collaborators', 'action' => 'index']);
        $routes->connect('/colaborador/visualizar/:id', ['controller' => 'Collaborators', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # rotas de registros de trabalho
        $routes->connect('/registros-trabalho', ['controller' => 'WorkLogs', 'action' => 'index']);
        $routes->connect('/registro-trabalho/visualizar/:id', ['controller' => 'WorkLogs', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # fichas routes
        $routes->connect('/fichas', ['controller' => 'Fichas', 'action' => 'index']);
        $routes->connect('/ficha/visualizar/:id', ['controller' => 'Fichas', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # assessments routes
        $routes->connect('/avaliacoes', ['controller' => 'Assessments', 'action' => 'index']);
        $routes->connect('/avaliacao/visualizar/:id', ['controller' => 'Assessments', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);

        # dietPlans routes
        $routes->connect('/planos-alimentares', ['controller' => 'DietPlans', 'action' => 'index']);
        $routes->connect('/plano-alimentar/visualizar/:id', ['controller' => 'DietPlans', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/plano-alimentar/criar/:id', ['controller' => 'DietPlans', 'action' => 'create'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/plano-alimentar/editar/:id', ['controller' => 'DietPlans', 'action' => 'update'], ['pass' => ['id'], 'id' => '\d+']);

        # exerciseTrainingDivision routes
        $routes->connect('/ficha-exercicios', ['controller' => 'ExerciseTrainingDivision', 'action' => 'index']);
        $routes->connect('/ficha-exercicio/visualizar/:id', ['controller' => 'ExerciseTrainingDivision', 'action' => 'view'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ficha-exercicio/criar/:id', ['controller' => 'ExerciseTrainingDivision', 'action' => 'create'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ficha-exercicio/editar/:id', ['controller' => 'ExerciseTrainingDivision', 'action' => 'update'], ['pass' => ['id'], 'id' => '\d+']);

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
        $routes->connect('/grupo-muscular-adicionar', ['controller' => 'MuscleGroups', 'action' => 'addMuscleGroups', 'method' => 'POST']);
        $routes->connect('/grupo-muscular-editar/:id', ['controller' => 'MuscleGroups', 'action' => 'editMuscleGroups', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/grupo-muscular-excluir/:id', ['controller' => 'MuscleGroups', 'action' => 'deleteMuscleGroups', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # FoodTypes routes API
        $routes->connect('/tipo-alimentos', ['controller' => 'FoodTypes', 'action' => 'fetchFoodTypes', 'method' => 'GET']);
        $routes->connect('/tipo-alimento/:id', ['controller' => 'FoodTypes', 'action' => 'fetchfoodType', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/tipo-alimento-adicionar', ['controller' => 'FoodTypes', 'action' => 'addFoodTypes', 'method' => 'POST']);
        $routes->connect('/tipo-alimento-editar/:id', ['controller' => 'FoodTypes', 'action' => 'editFoodTypes', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/tipo-alimento-excluir/:id', ['controller' => 'FoodTypes', 'action' => 'deleteFoodTypes', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # Foods routes API
        $routes->connect('/alimentos', ['controller' => 'Foods', 'action' => 'fetchFoods', 'method' => 'GET']);
        $routes->connect('/alimento/:id', ['controller' => 'Foods', 'action' => 'fetchfood', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/alimento-adicionar', ['controller' => 'Foods', 'action' => 'addFoods', 'method' => 'POST']);
        $routes->connect('/alimento-editar/:id', ['controller' => 'Foods', 'action' => 'editFoods', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/alimento-excluir/:id', ['controller' => 'Foods', 'action' => 'deleteFoods', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # ItemTypes routes API
        $routes->connect('/tipo-itens', ['controller' => 'ItemTypes', 'action' => 'fetchItemTypes', 'method' => 'GET']);
        $routes->connect('/tipo-item/:id', ['controller' => 'ItemTypes', 'action' => 'fetchitemType', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/tipo-item-adicionar', ['controller' => 'ItemTypes', 'action' => 'addItemTypes', 'method' => 'POST']);
        $routes->connect('/tipo-item-editar/:id', ['controller' => 'ItemTypes', 'action' => 'editItemTypes', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/tipo-item-excluir/:id', ['controller' => 'ItemTypes', 'action' => 'deleteItemTypes', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # MealTypes routes API
        $routes->connect('/tipos-refeicao', ['controller' => 'MealTypes', 'action' => 'fetchMealTypes', 'method' => 'GET']);
        $routes->connect('/tipo-refeicao/:id', ['controller' => 'MealTypes', 'action' => 'fetchmealType', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/tipo-refeicao-adicionar', ['controller' => 'MealTypes', 'action' => 'addMealTypes', 'method' => 'POST']);
        $routes->connect('/tipo-refeicao-editar/:id', ['controller' => 'MealTypes', 'action' => 'editMealTypes', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/tipo-refeicao-excluir/:id', ['controller' => 'MealTypes', 'action' => 'deleteMealTypes', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # FormPayments routes API
        $routes->connect('/forma-pagamentos', ['controller' => 'FormPayments', 'action' => 'fetchFormPayments', 'method' => 'GET']);
        $routes->connect('/forma-pagamento/:id', ['controller' => 'FormPayments', 'action' => 'fetchformPayment', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/forma-pagamento-adicionar', ['controller' => 'FormPayments', 'action' => 'addFormPayments', 'method' => 'POST']);
        $routes->connect('/forma-pagamento-editar/:id', ['controller' => 'FormPayments', 'action' => 'editFormPayments', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/forma-pagamento-excluir/:id', ['controller' => 'FormPayments', 'action' => 'deleteFormPayments', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # Positions routes API
        $routes->connect('/cargos', ['controller' => 'Positions', 'action' => 'fetchPositions', 'method' => 'GET']);
        $routes->connect('/cargo/:id', ['controller' => 'Positions', 'action' => 'fetchposition', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/cargo-adicionar', ['controller' => 'Positions', 'action' => 'addPositions', 'method' => 'POST']);
        $routes->connect('/cargo-editar/:id', ['controller' => 'Positions', 'action' => 'editPositions', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/cargo-excluir/:id', ['controller' => 'Positions', 'action' => 'deletePositions', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # StorageLocations routes API
        $routes->connect('/locais-armazenamento', ['controller' => 'StorageLocations', 'action' => 'fetchStorageLocations', 'method' => 'GET']);
        $routes->connect('/local-armazenamento/:id', ['controller' => 'StorageLocations', 'action' => 'fetchstorageLocation', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/local-armazenamento-adicionar', ['controller' => 'StorageLocations', 'action' => 'addStorageLocations', 'method' => 'POST']);
        $routes->connect('/local-armazenamento-editar/:id', ['controller' => 'StorageLocations', 'action' => 'editStorageLocations', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/local-armazenamento-excluir/:id', ['controller' => 'StorageLocations', 'action' => 'deleteStorageLocations', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # Suppliers routes API
        $routes->connect('/fornecedores', ['controller' => 'Suppliers', 'action' => 'fetchSuppliers', 'method' => 'GET']);
        $routes->connect('/fornecedor/:id', ['controller' => 'Suppliers', 'action' => 'fetchsupplier', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/fornecedor-adicionar', ['controller' => 'Suppliers', 'action' => 'addSuppliers', 'method' => 'POST']);
        $routes->connect('/fornecedor-editar/:id', ['controller' => 'Suppliers', 'action' => 'editSuppliers', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/fornecedor-excluir/:id', ['controller' => 'Suppliers', 'action' => 'deleteSuppliers', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # PlanTypes routes API
        $routes->connect('/tipo-planos', ['controller' => 'PlanTypes', 'action' => 'fetchPlanTypes', 'method' => 'GET']);
        $routes->connect('/tipo-plano/:id', ['controller' => 'PlanTypes', 'action' => 'fetchplanType', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/tipo-plano-adicionar', ['controller' => 'PlanTypes', 'action' => 'addPlanTypes', 'method' => 'POST']);
        $routes->connect('/tipo-plano-editar/:id', ['controller' => 'PlanTypes', 'action' => 'editPlanTypes', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/tipo-plano-excluir/:id', ['controller' => 'PlanTypes', 'action' => 'deletePlanTypes', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # Exercises routes API
        $routes->connect('/exercicios', ['controller' => 'Exercises', 'action' => 'fetchExercises', 'method' => 'GET']);
        $routes->connect('/exercicio/:id', ['controller' => 'Exercises', 'action' => 'fetchexercise', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/exercicio-adicionar', ['controller' => 'Exercises', 'action' => 'addExercises', 'method' => 'POST']);
        $routes->connect('/exercicio-editar/:id', ['controller' => 'Exercises', 'action' => 'editExercises', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/exercicio-excluir/:id', ['controller' => 'Exercises', 'action' => 'deleteExercises', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # Collaborators routes API
        $routes->connect('/colaboradores', ['controller' => 'Collaborators', 'action' => 'fetchCollaborators', 'method' => 'GET']);
        $routes->connect('/colaborador/:id', ['controller' => 'Collaborators', 'action' => 'fetchcollaborator', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/colaborador-adicionar', ['controller' => 'Collaborators', 'action' => 'addCollaborators', 'method' => 'POST']);
        $routes->connect('/colaborador-editar/:id', ['controller' => 'Collaborators', 'action' => 'editCollaborators', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/colaborador-excluir/:id', ['controller' => 'Collaborators', 'action' => 'deleteCollaborators', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # Students routes API
        $routes->connect('/alunos', ['controller' => 'Students', 'action' => 'fetchStudents', 'method' => 'GET']);
        $routes->connect('/aluno/:id', ['controller' => 'Students', 'action' => 'fetchstudent', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/aluno-adicionar', ['controller' => 'Students', 'action' => 'addStudents', 'method' => 'POST']);
        $routes->connect('/aluno-editar/:id', ['controller' => 'Students', 'action' => 'editStudents', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/aluno-excluir/:id', ['controller' => 'Students', 'action' => 'deleteStudents', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # WorkLogs routes API
        $routes->connect('/registros-trabalho', ['controller' => 'WorkLogs', 'action' => 'fetchWorkLogs', 'method' => 'GET']);
        $routes->connect('/registro-trabalho/:id', ['controller' => 'WorkLogs', 'action' => 'fetchworkLog', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/registro-trabalho-adicionar', ['controller' => 'WorkLogs', 'action' => 'addWorkLogs', 'method' => 'POST']);
        $routes->connect('/registro-trabalho-editar/:id', ['controller' => 'WorkLogs', 'action' => 'editWorkLogs', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/registro-trabalho-excluir/:id', ['controller' => 'WorkLogs', 'action' => 'deleteWorkLogs', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # Fichas routes API
        $routes->connect('/fichas', ['controller' => 'Fichas', 'action' => 'fetchFichas', 'method' => 'GET']);
        $routes->connect('/ficha/:id', ['controller' => 'Fichas', 'action' => 'fetchficha', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ficha-adicionar', ['controller' => 'Fichas', 'action' => 'addFichas', 'method' => 'POST']);
        $routes->connect('/ficha-editar/:id', ['controller' => 'Fichas', 'action' => 'editFichas', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ficha-excluir/:id', ['controller' => 'Fichas', 'action' => 'deleteFichas', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # Assessments routes API
        $routes->connect('/avaliacoes', ['controller' => 'Assessments', 'action' => 'fetchAssessments', 'method' => 'GET']);
        $routes->connect('/avaliacao/:id', ['controller' => 'Assessments', 'action' => 'fetchassessment', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/avaliacao-adicionar', ['controller' => 'Assessments', 'action' => 'addAssessments', 'method' => 'POST']);
        $routes->connect('/avaliacao-editar/:id', ['controller' => 'Assessments', 'action' => 'editAssessments', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/avaliacao-excluir/:id', ['controller' => 'Assessments', 'action' => 'deleteAssessments', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # DietPlans routes API
        $routes->connect('/planos-alimentares', ['controller' => 'DietPlans', 'action' => 'fetchDietPlans', 'method' => 'GET']);
        $routes->connect('/plano-alimentar/:id', ['controller' => 'DietPlans', 'action' => 'fetchdietPlan', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/plano-alimentar-adicionar', ['controller' => 'DietPlans', 'action' => 'addDietPlans', 'method' => 'POST']);
        $routes->connect('/plano-alimentar-editar/:id', ['controller' => 'DietPlans', 'action' => 'editDietPlans', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/plano-alimentar-excluir/:id', ['controller' => 'DietPlans', 'action' => 'deleteDietPlans', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);

        # ExerciseTrainingDivision routes API
        $routes->connect('/ficha-exercicios', ['controller' => 'ExerciseTrainingDivision', 'action' => 'fetchExerciseTrainingDivisions', 'method' => 'GET']);
        $routes->connect('/ficha-exercicio/:id', ['controller' => 'ExerciseTrainingDivision', 'action' => 'fetchexerciseTrainingDivision', 'method' => 'GET'], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ficha-exercicio-adicionar', ['controller' => 'ExerciseTrainingDivision', 'action' => 'addExerciseTrainingDivision', 'method' => 'POST']);
        $routes->connect('/ficha-exercicio-editar/:id', ['controller' => 'ExerciseTrainingDivision', 'action' => 'editExerciseTrainingDivision', 'method' => ['PUT', 'PATCH']], ['pass' => ['id'], 'id' => '\d+']);
        $routes->connect('/ficha-exercicio-excluir/:id', ['controller' => 'ExerciseTrainingDivision', 'action' => 'deleteExerciseTrainingDivision', 'method' => 'DELETE'], ['pass' => ['id'], 'id' => '\d+']);
    });
};
