<?php

use Migrations\AbstractSeed;

class AllSeed extends AbstractSeed
{
    public function run(): void
    {
        $this->call('RolesSeed');
        $this->call('PermissionsSeed');
        $this->call('UsersSeed');
        $this->call('RolesPermissionsSeed');
        $this->call('MuscleGroupsSeed');
        $this->call('EquipmentsSeed');
        $this->call('ExercisesSeed');
        $this->call('TrainingDivisionGroupsSeed');
        $this->call('FoodTypesSeed');
        $this->call('FoodsSeed');
        $this->call('FormPaymentsSeed');
        $this->call('PlanTypesSeed');
        $this->call('MealTypesSeed');
    }
}
