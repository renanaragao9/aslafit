<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Food extends Entity
{
    protected $_accessible = [
        'name' => true,
        'link' => true,
        'image' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'diet_plans' => true,
        'food_type_id' => true,
        'food_type' => true,
    ];
}
