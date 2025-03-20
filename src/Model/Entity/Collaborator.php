<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Collaborator Entity
 *
 * @property int $id
 * @property string $name
 * @property \Cake\I18n\FrozenDate|null $birth_date
 * @property \Cake\I18n\FrozenDate|null $entry_date
 * @property string|null $gender
 * @property string|null $color
 * @property string|null $img
 * @property bool $active
 * @property int $position_id
 * @property int|null $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Position $position
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Called[] $calleds
 * @property \App\Model\Entity\Event[] $events
 * @property \App\Model\Entity\Media[] $medias
 * @property \App\Model\Entity\MonthlyPlan[] $monthly_plans
 * @property \App\Model\Entity\WorkLog[] $work_logs
 */
class Collaborator extends Entity
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
        'color' => true,
        'img' => true,
        'active' => true,
        'position_id' => true,
        'user_id' => true,
        'created' => true,
        'modified' => true,
        'position' => true,
        'user' => true,
        'calleds' => true,
        'events' => true,
        'medias' => true,
        'monthly_plans' => true,
        'work_logs' => true,
    ];
}
