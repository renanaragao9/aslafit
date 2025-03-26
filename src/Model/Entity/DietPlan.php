<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class DietPlan extends Entity
{
    protected $_accessible = [
        'description' => true,
        'meal_type_id' => true,
        'food_id' => true,
        'ficha_id' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'meal_type' => true,
        'food' => true,
        'ficha' => true,
    ];
}
