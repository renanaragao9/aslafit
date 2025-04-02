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
            ['name' => 'users/index', 'description' => 'Visualizar', 'group' => 'Usuários'],
            ['name' => 'users/add', 'description' => 'Criar', 'group' => 'Usuários'],
            ['name' => 'users/edit', 'description' => 'Editar', 'group' => 'Usuários'],
            ['name' => 'users/delete', 'description' => 'Deletar', 'group' => 'Usuários'],

            // Roles Seeder
            ['name' => 'roles/index', 'description' => 'Listar', 'group' => 'Perfis'],
            ['name' => 'roles/add', 'description' => 'Criar', 'group' => 'Perfis'],
            ['name' => 'roles/edit', 'description' => 'Editar', 'group' => 'Perfis'],
            ['name' => 'roles/delete', 'description' => 'Deletar', 'group' => 'Perfis'],

            #Equipments Seeder
            ['name' => 'Equipments/index', 'description' => 'Visualizar', 'group' => 'Equipamentos'],
            ['name' => 'Equipments/add', 'description' => 'Criar', 'group' => 'Equipamentos'],
            ['name' => 'Equipments/edit', 'description' => 'Editar', 'group' => 'Equipamentos'],
            ['name' => 'Equipments/delete', 'description' => 'Deletar', 'group' => 'Equipamentos'],

            #TrainingDivisions Seeder
            ['name' => 'TrainingDivisions/index', 'description' => 'Visualizar', 'group' => 'Divisões de Treinamento'],
            ['name' => 'TrainingDivisions/add', 'description' => 'Criar', 'group' => 'Divisões de Treinamento'],
            ['name' => 'TrainingDivisions/edit', 'description' => 'Editar', 'group' => 'Divisões de Treinamento'],
            ['name' => 'TrainingDivisions/delete', 'description' => 'Deletar', 'group' => 'Divisões de Treinamento'],

            #MuscleGroups Seeder
            ['name' => 'MuscleGroups/index', 'description' => 'Visualizar', 'group' => 'Grupos Musculares'],
            ['name' => 'MuscleGroups/add', 'description' => 'Criar', 'group' => 'Grupos Musculares'],
            ['name' => 'MuscleGroups/edit', 'description' => 'Editar', 'group' => 'Grupos Musculares'],
            ['name' => 'MuscleGroups/delete', 'description' => 'Deletar', 'group' => 'Grupos Musculares'],

            #Addresses Seeder
            ['name' => 'Addresses/index', 'description' => 'Visualizar', 'group' => 'Endereços'],
            ['name' => 'Addresses/add', 'description' => 'Criar', 'group' => 'Endereços'],
            ['name' => 'Addresses/edit', 'description' => 'Editar', 'group' => 'Endereços'],
            ['name' => 'Addresses/delete', 'description' => 'Deletar', 'group' => 'Endereços'],

            #Documents Seeder
            ['name' => 'Documents/index', 'description' => 'Visualizar', 'group' => 'Documentos'],
            ['name' => 'Documents/add', 'description' => 'Criar', 'group' => 'Documentos'],
            ['name' => 'Documents/edit', 'description' => 'Editar', 'group' => 'Documentos'],
            ['name' => 'Documents/delete', 'description' => 'Deletar', 'group' => 'Documentos'],

            #Contacts Seeder
            ['name' => 'Contacts/index', 'description' => 'Visualizar', 'group' => 'Contatos'],
            ['name' => 'Contacts/add', 'description' => 'Criar', 'group' => 'Contatos'],
            ['name' => 'Contacts/edit', 'description' => 'Editar', 'group' => 'Contatos'],
            ['name' => 'Contacts/delete', 'description' => 'Deletar', 'group' => 'Contatos'],

            #FoodTypes Seeder
            ['name' => 'FoodTypes/index', 'description' => 'Visualizar', 'group' => 'Tipos de Alimentos'],
            ['name' => 'FoodTypes/add', 'description' => 'Criar', 'group' => 'Tipos de Alimentos'],
            ['name' => 'FoodTypes/edit', 'description' => 'Editar', 'group' => 'Tipos de Alimentos'],
            ['name' => 'FoodTypes/delete', 'description' => 'Deletar', 'group' => 'Tipos de Alimentos'],

            #Foods Seeder
            ['name' => 'Foods/index', 'description' => 'Visualizar', 'group' => 'Alimentos'],
            ['name' => 'Foods/add', 'description' => 'Criar', 'group' => 'Alimentos'],
            ['name' => 'Foods/edit', 'description' => 'Editar', 'group' => 'Alimentos'],
            ['name' => 'Foods/delete', 'description' => 'Deletar', 'group' => 'Alimentos'],

            #ItemTypes Seeder
            ['name' => 'ItemTypes/index', 'description' => 'Visualizar', 'group' => 'Tipos de Itens'],
            ['name' => 'ItemTypes/add', 'description' => 'Criar', 'group' => 'Tipos de Itens'],
            ['name' => 'ItemTypes/edit', 'description' => 'Editar', 'group' => 'Tipos de Itens'],
            ['name' => 'ItemTypes/delete', 'description' => 'Deletar', 'group' => 'Tipos de Itens'],

            #MealTypes Seeder
            ['name' => 'MealTypes/index', 'description' => 'Visualizar', 'group' => 'Tipos de Refeições'],
            ['name' => 'MealTypes/add', 'description' => 'Criar', 'group' => 'Tipos de Refeições'],
            ['name' => 'MealTypes/edit', 'description' => 'Editar', 'group' => 'Tipos de Refeições'],
            ['name' => 'MealTypes/delete', 'description' => 'Deletar', 'group' => 'Tipos de Refeições'],

            #FormPayments Seeder
            ['name' => 'FormPayments/index', 'description' => 'Visualizar', 'group' => 'Formas de Pagamento'],
            ['name' => 'FormPayments/add', 'description' => 'Criar', 'group' => 'Formas de Pagamento'],
            ['name' => 'FormPayments/edit', 'description' => 'Editar', 'group' => 'Formas de Pagamento'],
            ['name' => 'FormPayments/delete', 'description' => 'Deletar', 'group' => 'Formas de Pagamento'],

            #Positions Seeder
            ['name' => 'Positions/index', 'description' => 'Visualizar', 'group' => 'Cargos'],
            ['name' => 'Positions/add', 'description' => 'Criar', 'group' => 'Cargos'],
            ['name' => 'Positions/edit', 'description' => 'Editar', 'group' => 'Cargos'],
            ['name' => 'Positions/delete', 'description' => 'Deletar', 'group' => 'Cargos'],

            #StorageLocations Seeder
            ['name' => 'StorageLocations/index', 'description' => 'Visualizar', 'group' => 'Locais de Armazenamento'],
            ['name' => 'StorageLocations/add', 'description' => 'Criar', 'group' => 'Locais de Armazenamento'],
            ['name' => 'StorageLocations/edit', 'description' => 'Editar', 'group' => 'Locais de Armazenamento'],
            ['name' => 'StorageLocations/delete', 'description' => 'Deletar', 'group' => 'Locais de Armazenamento'],

            #Suppliers Seeder
            ['name' => 'Suppliers/index', 'description' => 'Visualizar', 'group' => 'Fornecedores'],
            ['name' => 'Suppliers/add', 'description' => 'Criar', 'group' => 'Fornecedores'],
            ['name' => 'Suppliers/edit', 'description' => 'Editar', 'group' => 'Fornecedores'],
            ['name' => 'Suppliers/delete', 'description' => 'Deletar', 'group' => 'Fornecedores'],

            #PlanTypes Seeder
            ['name' => 'PlanTypes/index', 'description' => 'Visualizar', 'group' => 'Tipos de Planos'],
            ['name' => 'PlanTypes/add', 'description' => 'Criar', 'group' => 'Tipos de Planos'],
            ['name' => 'PlanTypes/edit', 'description' => 'Editar', 'group' => 'Tipos de Planos'],
            ['name' => 'PlanTypes/delete', 'description' => 'Deletar', 'group' => 'Tipos de Planos'],

            #Exercises Seeder
            ['name' => 'Exercises/index', 'description' => 'Visualizar', 'group' => 'Exercícios'],
            ['name' => 'Exercises/add', 'description' => 'Criar', 'group' => 'Exercícios'],
            ['name' => 'Exercises/edit', 'description' => 'Editar', 'group' => 'Exercícios'],
            ['name' => 'Exercises/delete', 'description' => 'Deletar', 'group' => 'Exercícios'],

            #Collaborators Seeder
            ['name' => 'Collaborators/index', 'description' => 'Visualizar', 'group' => 'Colaboradores'],
            ['name' => 'Collaborators/add', 'description' => 'Criar', 'group' => 'Colaboradores'],
            ['name' => 'Collaborators/edit', 'description' => 'Editar', 'group' => 'Colaboradores'],
            ['name' => 'Collaborators/delete', 'description' => 'Deletar', 'group' => 'Colaboradores'],

            #Students Seeder
            ['name' => 'Students/index', 'description' => 'Visualizar', 'group' => 'Estudantes'],
            ['name' => 'Students/add', 'description' => 'Criar', 'group' => 'Estudantes'],
            ['name' => 'Students/edit', 'description' => 'Editar', 'group' => 'Estudantes'],
            ['name' => 'Students/delete', 'description' => 'Deletar', 'group' => 'Estudantes'],

            #WorkLogs Seeder
            ['name' => 'WorkLogs/index', 'description' => 'Visualizar', 'group' => 'Registros de Trabalho'],
            ['name' => 'WorkLogs/add', 'description' => 'Criar', 'group' => 'Registros de Trabalho'],
            ['name' => 'WorkLogs/edit', 'description' => 'Editar', 'group' => 'Registros de Trabalho'],
            ['name' => 'WorkLogs/delete', 'description' => 'Deletar', 'group' => 'Registros de Trabalho'],

            #Fichas Seeder
            ['name' => 'Fichas/index', 'description' => 'Visualizar', 'group' => 'Fichas'],
            ['name' => 'Fichas/add', 'description' => 'Criar', 'group' => 'Fichas'],
            ['name' => 'Fichas/edit', 'description' => 'Editar', 'group' => 'Fichas'],
            ['name' => 'Fichas/delete', 'description' => 'Deletar', 'group' => 'Fichas'],

            #Assessments Seeder
            ['name' => 'Assessments/index', 'description' => 'Visualizar', 'group' => 'Avaliações'],
            ['name' => 'Assessments/add', 'description' => 'Criar', 'group' => 'Avaliações'],
            ['name' => 'Assessments/edit', 'description' => 'Editar', 'group' => 'Avaliações'],
            ['name' => 'Assessments/delete', 'description' => 'Deletar', 'group' => 'Avaliações'],

            #DietPlans Seeder
            ['name' => 'DietPlans/index', 'description' => 'Visualizar', 'group' => 'Planos Alimentares'],
            ['name' => 'DietPlans/add', 'description' => 'Criar', 'group' => 'Planos Alimentares'],
            ['name' => 'DietPlans/edit', 'description' => 'Editar', 'group' => 'Planos Alimentares'],
            ['name' => 'DietPlans/delete', 'description' => 'Deletar', 'group' => 'Planos Alimentares'],

            #ExerciseTrainingDivision Seeder
            ['name' => 'ExerciseTrainingDivision/index', 'description' => 'Visualizar', 'group' => 'Exercícios por Divisão de Treinamento'],
            ['name' => 'ExerciseTrainingDivision/add', 'description' => 'Criar', 'group' => 'Exercícios por Divisão de Treinamento'],
            ['name' => 'ExerciseTrainingDivision/edit', 'description' => 'Editar', 'group' => 'Exercícios por Divisão de Treinamento'],
            ['name' => 'ExerciseTrainingDivision/delete', 'description' => 'Deletar', 'group' => 'Exercícios por Divisão de Treinamento'],

            #Calleds Seeder
            ['name' => 'Calleds/index', 'description' => 'Visualizar', 'group' => 'Chamados'],
            ['name' => 'Calleds/add', 'description' => 'Criar', 'group' => 'Chamados'],
            ['name' => 'Calleds/edit', 'description' => 'Editar', 'group' => 'Chamados'],
            ['name' => 'Calleds/delete', 'description' => 'Deletar', 'group' => 'Chamados'],

            #Medias Seeder
            ['name' => 'Medias/index', 'description' => 'Visualizar', 'group' => 'Mídias'],
            ['name' => 'Medias/add', 'description' => 'Criar', 'group' => 'Mídias'],
            ['name' => 'Medias/edit', 'description' => 'Editar', 'group' => 'Mídias'],
            ['name' => 'Medias/delete', 'description' => 'Deletar', 'group' => 'Mídias'],

            #MonthlyPlans Seeder
            ['name' => 'MonthlyPlans/index', 'description' => 'Visualizar', 'group' => 'Planos Mensais'],
            ['name' => 'MonthlyPlans/add', 'description' => 'Criar', 'group' => 'Planos Mensais'],
            ['name' => 'MonthlyPlans/edit', 'description' => 'Editar', 'group' => 'Planos Mensais'],
            ['name' => 'MonthlyPlans/delete', 'description' => 'Deletar', 'group' => 'Planos Mensais'],

            #ItemsFields Seeder
            ['name' => 'ItemsFields/index', 'description' => 'Visualizar', 'group' => 'Campos de Itens'],
            ['name' => 'ItemsFields/add', 'description' => 'Criar', 'group' => 'Campos de Itens'],
            ['name' => 'ItemsFields/edit', 'description' => 'Editar', 'group' => 'Campos de Itens'],
            ['name' => 'ItemsFields/delete', 'description' => 'Deletar', 'group' => 'Campos de Itens'],

            #Items Seeder
            ['name' => 'Items/index', 'description' => 'Visualizar', 'group' => 'Itens'],
            ['name' => 'Items/add', 'description' => 'Criar', 'group' => 'Itens'],
            ['name' => 'Items/edit', 'description' => 'Editar', 'group' => 'Itens'],
            ['name' => 'Items/delete', 'description' => 'Deletar', 'group' => 'Itens'],

            #ItemValues Seeder
            ['name' => 'ItemValues/index', 'description' => 'Visualizar', 'group' => 'Valores de Itens'],
            ['name' => 'ItemValues/add', 'description' => 'Criar', 'group' => 'Valores de Itens'],
            ['name' => 'ItemValues/edit', 'description' => 'Editar', 'group' => 'Valores de Itens'],
            ['name' => 'ItemValues/delete', 'description' => 'Deletar', 'group' => 'Valores de Itens'],

            #ItemLogs Seeder
            ['name' => 'ItemLogs/index', 'description' => 'Visualizar', 'group' => 'Registros de Itens'],
            ['name' => 'ItemLogs/add', 'description' => 'Criar', 'group' => 'Registros de Itens'],
            ['name' => 'ItemLogs/edit', 'description' => 'Editar', 'group' => 'Registros de Itens'],
            ['name' => 'ItemLogs/delete', 'description' => 'Deletar', 'group' => 'Registros de Itens'],

            #Orders Seeder
            ['name' => 'Orders/index', 'description' => 'Visualizar', 'group' => 'Pedidos'],
            ['name' => 'Orders/add', 'description' => 'Criar', 'group' => 'Pedidos'],
            ['name' => 'Orders/edit', 'description' => 'Editar', 'group' => 'Pedidos'],
            ['name' => 'Orders/delete', 'description' => 'Deletar', 'group' => 'Pedidos'],

            #OrderItems Seeder
            ['name' => 'OrderItems/index', 'description' => 'Visualizar', 'group' => 'Itens de Pedidos'],
            ['name' => 'OrderItems/add', 'description' => 'Criar', 'group' => 'Itens de Pedidos'],
            ['name' => 'OrderItems/edit', 'description' => 'Editar', 'group' => 'Itens de Pedidos'],
            ['name' => 'OrderItems/delete', 'description' => 'Deletar', 'group' => 'Itens de Pedidos'],

            #OrderInvoices Seeder
            ['name' => 'OrderInvoices/index', 'description' => 'Visualizar', 'group' => 'Faturas de Pedidos'],
            ['name' => 'OrderInvoices/add', 'description' => 'Criar', 'group' => 'Faturas de Pedidos'],
            ['name' => 'OrderInvoices/edit', 'description' => 'Editar', 'group' => 'Faturas de Pedidos'],
            ['name' => 'OrderInvoices/delete', 'description' => 'Deletar', 'group' => 'Faturas de Pedidos'],

            #Events Seeder
            ['name' => 'Events/index', 'description' => 'Visualizar', 'group' => 'Eventos'],
            ['name' => 'Events/add', 'description' => 'Criar', 'group' => 'Eventos'],
            ['name' => 'Events/edit', 'description' => 'Editar', 'group' => 'Eventos'],
            ['name' => 'Events/delete', 'description' => 'Deletar', 'group' => 'Eventos'],

            #EventRegistrations Seeder
            ['name' => 'EventRegistrations/index', 'description' => 'Visualizar', 'group' => 'Registros de Eventos'],
            ['name' => 'EventRegistrations/add', 'description' => 'Criar', 'group' => 'Registros de Eventos'],
            ['name' => 'EventRegistrations/edit', 'description' => 'Editar', 'group' => 'Registros de Eventos'],
            ['name' => 'EventRegistrations/delete', 'description' => 'Deletar', 'group' => 'Registros de Eventos'],

            #StatisticsLogs Seeder
            ['name' => 'StatisticsLogs/index', 'description' => 'Visualizar', 'group' => 'Registros de Estatísticas'],
            ['name' => 'StatisticsLogs/add', 'description' => 'Criar', 'group' => 'Registros de Estatísticas'],
            ['name' => 'StatisticsLogs/edit', 'description' => 'Editar', 'group' => 'Registros de Estatísticas'],
            ['name' => 'StatisticsLogs/delete', 'description' => 'Deletar', 'group' => 'Registros de Estatísticas'],

            #ExpensesLogs Seeder
            ['name' => 'ExpensesLogs/index', 'description' => 'Visualizar', 'group' => 'Registros de Despesas'],
            ['name' => 'ExpensesLogs/add', 'description' => 'Criar', 'group' => 'Registros de Despesas'],
            ['name' => 'ExpensesLogs/edit', 'description' => 'Editar', 'group' => 'Registros de Despesas'],
            ['name' => 'ExpensesLogs/delete', 'description' => 'Deletar', 'group' => 'Registros de Despesas'],
        ];

        $table = $this->table('permissions');
        $table->insert($data)->save();
    }
}
