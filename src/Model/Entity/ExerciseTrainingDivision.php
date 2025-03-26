<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExerciseTrainingDivision Entity
 *
 * @property int $id
 * @property int $order
 * @property int $series
 * @property int $repetitions
 * @property string|null $weight
 * @property int|null $rest
 * @property string|null $description
 * @property int $ficha_id
 * @property int $exercise_id
 * @property int $training_division_id
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Ficha $ficha
 * @property \App\Model\Entity\Exercise $exercise
 * @property \App\Model\Entity\TrainingDivision $training_division
 */
class ExerciseTrainingDivision extends Entity
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
        'sort_order' => true,
        'series' => true,
        'repetitions' => true,
        'weight' => true,
        'rest' => true,
        'description' => true,
        'ficha_id' => true,
        'exercise_id' => true,
        'training_division_id' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'ficha' => true,
        'exercise' => true,
        'training_division' => true,
    ];
}
