<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class PermissionsSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            // Comando para roda o seed: bin/cake migrations seed --seed PermissionsSeed

            // Dashboard Seeder
            ['name' => 'Dashboard/index', 'description' => 'Listar', 'group' => 'Dashboard'],

            #Users Seeder
            ['name' => 'users/index', 'description' => 'Visualizar', 'group' => 'Users'],
            ['name' => 'users/add', 'description' => 'Criar', 'group' => 'Users'],
            ['name' => 'users/edit', 'description' => 'Editar', 'group' => 'Users'],
            ['name' => 'users/delete', 'description' => 'Deletar', 'group' => 'Users'],

            // Roles Seeder
            ['name' => 'roles/index', 'description' => 'Listar', 'group' => 'Perfil'],
            ['name' => 'roles/add', 'description' => 'Criar', 'group' => 'Perfil'],
            ['name' => 'roles/edit', 'description' => 'Editar', 'group' => 'Perfil'],
            ['name' => 'roles/delete', 'description' => 'Deletar', 'group' => 'Perfil'],

            #Equipments Seeder
            ['name' => 'Equipments/index', 'description' => 'Visualizar', 'group' => 'Equipments'],
            ['name' => 'Equipments/add', 'description' => 'Criar', 'group' => 'Equipments'],
            ['name' => 'Equipments/edit', 'description' => 'Editar', 'group' => 'Equipments'],
            ['name' => 'Equipments/delete', 'description' => 'Deletar', 'group' => 'Equipments'],

            #TrainingDivisions Seeder
            ['name' => 'TrainingDivisions/index', 'description' => 'Visualizar', 'group' => 'TrainingDivisions'],
            ['name' => 'TrainingDivisions/add', 'description' => 'Criar', 'group' => 'TrainingDivisions'],
            ['name' => 'TrainingDivisions/edit', 'description' => 'Editar', 'group' => 'TrainingDivisions'],
            ['name' => 'TrainingDivisions/delete', 'description' => 'Deletar', 'group' => 'TrainingDivisions'],

            #MuscleGroups Seeder
            ['name' => 'MuscleGroups/index', 'description' => 'Visualizar', 'group' => 'MuscleGroups'],
            ['name' => 'MuscleGroups/add', 'description' => 'Criar', 'group' => 'MuscleGroups'],
            ['name' => 'MuscleGroups/edit', 'description' => 'Editar', 'group' => 'MuscleGroups'],
            ['name' => 'MuscleGroups/delete', 'description' => 'Deletar', 'group' => 'MuscleGroups'],

            #Addresses Seeder
            ['name' => 'Addresses/index', 'description' => 'Visualizar', 'group' => 'Addresses'],
            ['name' => 'Addresses/add', 'description' => 'Criar', 'group' => 'Addresses'],
            ['name' => 'Addresses/edit', 'description' => 'Editar', 'group' => 'Addresses'],
            ['name' => 'Addresses/delete', 'description' => 'Deletar', 'group' => 'Addresses'],

            #Documents Seeder
            ['name' => 'Documents/index', 'description' => 'Visualizar', 'group' => 'Documents'],
            ['name' => 'Documents/add', 'description' => 'Criar', 'group' => 'Documents'],
            ['name' => 'Documents/edit', 'description' => 'Editar', 'group' => 'Documents'],
            ['name' => 'Documents/delete', 'description' => 'Deletar', 'group' => 'Documents'],

            #Contacts Seeder
            ['name' => 'Contacts/index', 'description' => 'Visualizar', 'group' => 'Contacts'],
            ['name' => 'Contacts/add', 'description' => 'Criar', 'group' => 'Contacts'],
            ['name' => 'Contacts/edit', 'description' => 'Editar', 'group' => 'Contacts'],
            ['name' => 'Contacts/delete', 'description' => 'Deletar', 'group' => 'Contacts'],

            #Foods Seeder
            ['name' => 'Foods/index', 'description' => 'Visualizar', 'group' => 'Foods'],
            ['name' => 'Foods/add', 'description' => 'Criar', 'group' => 'Foods'],
            ['name' => 'Foods/edit', 'description' => 'Editar', 'group' => 'Foods'],
            ['name' => 'Foods/delete', 'description' => 'Deletar', 'group' => 'Foods'],

            #ItemTypes Seeder
            ['name' => 'ItemTypes/index', 'description' => 'Visualizar', 'group' => 'ItemTypes'],
            ['name' => 'ItemTypes/add', 'description' => 'Criar', 'group' => 'ItemTypes'],
            ['name' => 'ItemTypes/edit', 'description' => 'Editar', 'group' => 'ItemTypes'],
            ['name' => 'ItemTypes/delete', 'description' => 'Deletar', 'group' => 'ItemTypes'],

            #MealTypes Seeder
            ['name' => 'MealTypes/index', 'description' => 'Visualizar', 'group' => 'MealTypes'],
            ['name' => 'MealTypes/add', 'description' => 'Criar', 'group' => 'MealTypes'],
            ['name' => 'MealTypes/edit', 'description' => 'Editar', 'group' => 'MealTypes'],
            ['name' => 'MealTypes/delete', 'description' => 'Deletar', 'group' => 'MealTypes'],

            #FormPayments Seeder
            ['name' => 'FormPayments/index', 'description' => 'Visualizar', 'group' => 'FormPayments'],
            ['name' => 'FormPayments/add', 'description' => 'Criar', 'group' => 'FormPayments'],
            ['name' => 'FormPayments/edit', 'description' => 'Editar', 'group' => 'FormPayments'],
            ['name' => 'FormPayments/delete', 'description' => 'Deletar', 'group' => 'FormPayments'],

            #Positions Seeder
            ['name' => 'Positions/index', 'description' => 'Visualizar', 'group' => 'Positions'],
            ['name' => 'Positions/add', 'description' => 'Criar', 'group' => 'Positions'],
            ['name' => 'Positions/edit', 'description' => 'Editar', 'group' => 'Positions'],
            ['name' => 'Positions/delete', 'description' => 'Deletar', 'group' => 'Positions'],

            #StorageLocations Seeder
            ['name' => 'StorageLocations/index', 'description' => 'Visualizar', 'group' => 'StorageLocations'],
            ['name' => 'StorageLocations/add', 'description' => 'Criar', 'group' => 'StorageLocations'],
            ['name' => 'StorageLocations/edit', 'description' => 'Editar', 'group' => 'StorageLocations'],
            ['name' => 'StorageLocations/delete', 'description' => 'Deletar', 'group' => 'StorageLocations'],

            #Suppliers Seeder
            ['name' => 'Suppliers/index', 'description' => 'Visualizar', 'group' => 'Suppliers'],
            ['name' => 'Suppliers/add', 'description' => 'Criar', 'group' => 'Suppliers'],
            ['name' => 'Suppliers/edit', 'description' => 'Editar', 'group' => 'Suppliers'],
            ['name' => 'Suppliers/delete', 'description' => 'Deletar', 'group' => 'Suppliers'],

            #PlanTypes Seeder
            ['name' => 'PlanTypes/index', 'description' => 'Visualizar', 'group' => 'PlanTypes'],
            ['name' => 'PlanTypes/add', 'description' => 'Criar', 'group' => 'PlanTypes'],
            ['name' => 'PlanTypes/edit', 'description' => 'Editar', 'group' => 'PlanTypes'],
            ['name' => 'PlanTypes/delete', 'description' => 'Deletar', 'group' => 'PlanTypes'],

            #Exercises Seeder
            ['name' => 'Exercises/index', 'description' => 'Visualizar', 'group' => 'Exercises'],
            ['name' => 'Exercises/add', 'description' => 'Criar', 'group' => 'Exercises'],
            ['name' => 'Exercises/edit', 'description' => 'Editar', 'group' => 'Exercises'],
            ['name' => 'Exercises/delete', 'description' => 'Deletar', 'group' => 'Exercises'],

            #Collaborators Seeder
            ['name' => 'Collaborators/index', 'description' => 'Visualizar', 'group' => 'Collaborators'],
            ['name' => 'Collaborators/add', 'description' => 'Criar', 'group' => 'Collaborators'],
            ['name' => 'Collaborators/edit', 'description' => 'Editar', 'group' => 'Collaborators'],
            ['name' => 'Collaborators/delete', 'description' => 'Deletar', 'group' => 'Collaborators'],

            #Students Seeder
            ['name' => 'Students/index', 'description' => 'Visualizar', 'group' => 'Students'],
            ['name' => 'Students/add', 'description' => 'Criar', 'group' => 'Students'],
            ['name' => 'Students/edit', 'description' => 'Editar', 'group' => 'Students'],
            ['name' => 'Students/delete', 'description' => 'Deletar', 'group' => 'Students'],

            #WorkLogs Seeder
            ['name' => 'WorkLogs/index', 'description' => 'Visualizar', 'group' => 'WorkLogs'],
            ['name' => 'WorkLogs/add', 'description' => 'Criar', 'group' => 'WorkLogs'],
            ['name' => 'WorkLogs/edit', 'description' => 'Editar', 'group' => 'WorkLogs'],
            ['name' => 'WorkLogs/delete', 'description' => 'Deletar', 'group' => 'WorkLogs'],

            #Fichas Seeder
            ['name' => 'Fichas/index', 'description' => 'Visualizar', 'group' => 'Fichas'],
            ['name' => 'Fichas/add', 'description' => 'Criar', 'group' => 'Fichas'],
            ['name' => 'Fichas/edit', 'description' => 'Editar', 'group' => 'Fichas'],
            ['name' => 'Fichas/delete', 'description' => 'Deletar', 'group' => 'Fichas'],

            #Assessments Seeder
            ['name' => 'Assessments/index', 'description' => 'Visualizar', 'group' => 'Assessments'],
            ['name' => 'Assessments/add', 'description' => 'Criar', 'group' => 'Assessments'],
            ['name' => 'Assessments/edit', 'description' => 'Editar', 'group' => 'Assessments'],
            ['name' => 'Assessments/delete', 'description' => 'Deletar', 'group' => 'Assessments'],

            #DietPlans Seeder
            ['name' => 'DietPlans/index', 'description' => 'Visualizar', 'group' => 'DietPlans'],
            ['name' => 'DietPlans/add', 'description' => 'Criar', 'group' => 'DietPlans'],
            ['name' => 'DietPlans/edit', 'description' => 'Editar', 'group' => 'DietPlans'],
            ['name' => 'DietPlans/delete', 'description' => 'Deletar', 'group' => 'DietPlans'],

            #ExerciseTrainingDivision Seeder
            ['name' => 'ExerciseTrainingDivision/index', 'description' => 'Visualizar', 'group' => 'ExerciseTrainingDivision'],
            ['name' => 'ExerciseTrainingDivision/add', 'description' => 'Criar', 'group' => 'ExerciseTrainingDivision'],
            ['name' => 'ExerciseTrainingDivision/edit', 'description' => 'Editar', 'group' => 'ExerciseTrainingDivision'],
            ['name' => 'ExerciseTrainingDivision/delete', 'description' => 'Deletar', 'group' => 'ExerciseTrainingDivision'],

            #Calleds Seeder
            ['name' => 'Calleds/index', 'description' => 'Visualizar', 'group' => 'Calleds'],
            ['name' => 'Calleds/add', 'description' => 'Criar', 'group' => 'Calleds'],
            ['name' => 'Calleds/edit', 'description' => 'Editar', 'group' => 'Calleds'],
            ['name' => 'Calleds/delete', 'description' => 'Deletar', 'group' => 'Calleds'],

            #Medias Seeder
            ['name' => 'Medias/index', 'description' => 'Visualizar', 'group' => 'Medias'],
            ['name' => 'Medias/add', 'description' => 'Criar', 'group' => 'Medias'],
            ['name' => 'Medias/edit', 'description' => 'Editar', 'group' => 'Medias'],
            ['name' => 'Medias/delete', 'description' => 'Deletar', 'group' => 'Medias'],

            #MonthlyPlans Seeder
            ['name' => 'MonthlyPlans/index', 'description' => 'Visualizar', 'group' => 'MonthlyPlans'],
            ['name' => 'MonthlyPlans/add', 'description' => 'Criar', 'group' => 'MonthlyPlans'],
            ['name' => 'MonthlyPlans/edit', 'description' => 'Editar', 'group' => 'MonthlyPlans'],
            ['name' => 'MonthlyPlans/delete', 'description' => 'Deletar', 'group' => 'MonthlyPlans'],

            #ItemsFields Seeder
            ['name' => 'ItemsFields/index', 'description' => 'Visualizar', 'group' => 'ItemsFields'],
            ['name' => 'ItemsFields/add', 'description' => 'Criar', 'group' => 'ItemsFields'],
            ['name' => 'ItemsFields/edit', 'description' => 'Editar', 'group' => 'ItemsFields'],
            ['name' => 'ItemsFields/delete', 'description' => 'Deletar', 'group' => 'ItemsFields'],

            #Items Seeder
            ['name' => 'Items/index', 'description' => 'Visualizar', 'group' => 'Items'],
            ['name' => 'Items/add', 'description' => 'Criar', 'group' => 'Items'],
            ['name' => 'Items/edit', 'description' => 'Editar', 'group' => 'Items'],
            ['name' => 'Items/delete', 'description' => 'Deletar', 'group' => 'Items'],

            #ItemValues Seeder
            ['name' => 'ItemValues/index', 'description' => 'Visualizar', 'group' => 'ItemValues'],
            ['name' => 'ItemValues/add', 'description' => 'Criar', 'group' => 'ItemValues'],
            ['name' => 'ItemValues/edit', 'description' => 'Editar', 'group' => 'ItemValues'],
            ['name' => 'ItemValues/delete', 'description' => 'Deletar', 'group' => 'ItemValues'],

            #ItemLogs Seeder
            ['name' => 'ItemLogs/index', 'description' => 'Visualizar', 'group' => 'ItemLogs'],
            ['name' => 'ItemLogs/add', 'description' => 'Criar', 'group' => 'ItemLogs'],
            ['name' => 'ItemLogs/edit', 'description' => 'Editar', 'group' => 'ItemLogs'],
            ['name' => 'ItemLogs/delete', 'description' => 'Deletar', 'group' => 'ItemLogs'],

            #Orders Seeder
            ['name' => 'Orders/index', 'description' => 'Visualizar', 'group' => 'Orders'],
            ['name' => 'Orders/add', 'description' => 'Criar', 'group' => 'Orders'],
            ['name' => 'Orders/edit', 'description' => 'Editar', 'group' => 'Orders'],
            ['name' => 'Orders/delete', 'description' => 'Deletar', 'group' => 'Orders'],

            #OrderItems Seeder
            ['name' => 'OrderItems/index', 'description' => 'Visualizar', 'group' => 'OrderItems'],
            ['name' => 'OrderItems/add', 'description' => 'Criar', 'group' => 'OrderItems'],
            ['name' => 'OrderItems/edit', 'description' => 'Editar', 'group' => 'OrderItems'],
            ['name' => 'OrderItems/delete', 'description' => 'Deletar', 'group' => 'OrderItems'],

            #OrderInvoices Seeder
            ['name' => 'OrderInvoices/index', 'description' => 'Visualizar', 'group' => 'OrderInvoices'],
            ['name' => 'OrderInvoices/add', 'description' => 'Criar', 'group' => 'OrderInvoices'],
            ['name' => 'OrderInvoices/edit', 'description' => 'Editar', 'group' => 'OrderInvoices'],
            ['name' => 'OrderInvoices/delete', 'description' => 'Deletar', 'group' => 'OrderInvoices'],

            #Events Seeder
            ['name' => 'Events/index', 'description' => 'Visualizar', 'group' => 'Events'],
            ['name' => 'Events/add', 'description' => 'Criar', 'group' => 'Events'],
            ['name' => 'Events/edit', 'description' => 'Editar', 'group' => 'Events'],
            ['name' => 'Events/delete', 'description' => 'Deletar', 'group' => 'Events'],

            #EventRegistrations Seeder
            ['name' => 'EventRegistrations/index', 'description' => 'Visualizar', 'group' => 'EventRegistrations'],
            ['name' => 'EventRegistrations/add', 'description' => 'Criar', 'group' => 'EventRegistrations'],
            ['name' => 'EventRegistrations/edit', 'description' => 'Editar', 'group' => 'EventRegistrations'],
            ['name' => 'EventRegistrations/delete', 'description' => 'Deletar', 'group' => 'EventRegistrations'],

            #StatisticsLogs Seeder
            ['name' => 'StatisticsLogs/index', 'description' => 'Visualizar', 'group' => 'StatisticsLogs'],
            ['name' => 'StatisticsLogs/add', 'description' => 'Criar', 'group' => 'StatisticsLogs'],
            ['name' => 'StatisticsLogs/edit', 'description' => 'Editar', 'group' => 'StatisticsLogs'],
            ['name' => 'StatisticsLogs/delete', 'description' => 'Deletar', 'group' => 'StatisticsLogs'],

            #ExpensesLogs Seeder
            ['name' => 'ExpensesLogs/index', 'description' => 'Visualizar', 'group' => 'ExpensesLogs'],
            ['name' => 'ExpensesLogs/add', 'description' => 'Criar', 'group' => 'ExpensesLogs'],
            ['name' => 'ExpensesLogs/edit', 'description' => 'Editar', 'group' => 'ExpensesLogs'],
            ['name' => 'ExpensesLogs/delete', 'description' => 'Deletar', 'group' => 'ExpensesLogs'],
        ];

        $table = $this->table('permissions');
        $table->insert($data)->save();
    }
}
