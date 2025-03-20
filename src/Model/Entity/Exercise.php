<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Exercise Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property string|null $gif
 * @property string|null $link
 * @property bool $active
 * @property int $equipment_id
 * @property int $muscle_group_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Equipment $equipment
 * @property \App\Model\Entity\MuscleGroup $muscle_group
 * @property \App\Model\Entity\ExerciseTrainingDivision[] $exercise_training_division
 */
class Exercise extends Entity
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
        'name' => true,
        'image' => true,
        'gif' => true,
        'link' => true,
        'active' => true,
        'equipment_id' => true,
        'muscle_group_id' => true,
        'created' => true,
        'modified' => true,
        'equipment' => true,
        'muscle_group' => true,
        'exercise_training_division' => true,
    ];
}
