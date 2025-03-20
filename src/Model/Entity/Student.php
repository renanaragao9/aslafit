<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\FrozenDate $birth_date
 * @property \Cake\I18n\FrozenDate $entry_date
 * @property string|null $gender
 * @property string $weight
 * @property string $height
 * @property string|null $color
 * @property string|null $img
 * @property bool $active
 * @property int|null $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Assessment[] $assessments
 * @property \App\Model\Entity\Called[] $calleds
 * @property \App\Model\Entity\DietPlan[] $diet_plans
 * @property \App\Model\Entity\EventRegistration[] $event_registrations
 * @property \App\Model\Entity\Ficha[] $fichas
 * @property \App\Model\Entity\MonthlyPlan[] $monthly_plans
 */
class Student extends Entity
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
        'birth_date' => true,
        'entry_date' => true,
        'gender' => true,
        'weight' => true,
        'height' => true,
        'color' => true,
        'img' => true,
        'active' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'assessments' => true,
        'calleds' => true,
        'diet_plans' => true,
        'event_registrations' => true,
        'fichas' => true,
        'monthly_plans' => true,
    ];
}
