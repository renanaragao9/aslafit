<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ficha Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property string|null $description
 * @property array|null $notes
 * @property int $student_id
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Assessment[] $assessments
 * @property \App\Model\Entity\DietPlan[] $diet_plans
 * @property \App\Model\Entity\ExerciseTrainingDivision[] $exercise_training_division
 */
class Ficha extends Entity
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
        'start_date' => true,
        'end_date' => true,
        'description' => true,
        'notes' => true,
        'student_id' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'student' => true,
        'assessments' => true,
        'diet_plans' => true,
        'exercise_training_division' => true,
    ];
}
