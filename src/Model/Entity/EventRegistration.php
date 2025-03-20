<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventRegistration Entity
 *
 * @property int $id
 * @property int $event_id
 * @property int $student_id
 * @property bool $confirmed
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\Student $student
 */
class EventRegistration extends Entity
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
        'event_id' => true,
        'student_id' => true,
        'confirmed' => true,
        'created' => true,
        'modified' => true,
        'event' => true,
        'student' => true,
    ];
}
