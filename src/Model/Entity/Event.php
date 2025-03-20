<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Event Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime $date
 * @property string $location
 * @property int $max_participants
 * @property int $collaborator_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Collaborator $collaborator
 * @property \App\Model\Entity\EventRegistration[] $event_registrations
 */
class Event extends Entity
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
        'description' => true,
        'date' => true,
        'location' => true,
        'max_participants' => true,
        'collaborator_id' => true,
        'created' => true,
        'modified' => true,
        'collaborator' => true,
        'event_registrations' => true,
    ];
}
