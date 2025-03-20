<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DietPlan Entity
 *
 * @property int $id
 * @property string|null $description
 * @property int $student_id
 * @property int $meal_type_id
 * @property int $food_id
 * @property int|null $ficha_id
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\MealType $meal_type
 * @property \App\Model\Entity\Food $food
 * @property \App\Model\Entity\Ficha $ficha
 */
class DietPlan extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'description' => true,
        'student_id' => true,
        'meal_type_id' => true,
        'food_id' => true,
        'ficha_id' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'student' => true,
        'meal_type' => true,
        'food' => true,
        'ficha' => true,
    ];
}
