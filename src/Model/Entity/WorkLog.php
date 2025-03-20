<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WorkLog Entity
 *
 * @property int $id
 * @property int $collaborator_id
 * @property \Cake\I18n\FrozenDate $log_date
 * @property string $log_type
 * @property \Cake\I18n\Time $log_time
 * @property string|null $log_address
 * @property string|null $latitude
 * @property string|null $longitude
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Collaborator $collaborator
 */
class WorkLog extends Entity
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
        'collaborator_id' => true,
        'log_date' => true,
        'log_type' => true,
        'log_time' => true,
        'log_address' => true,
        'latitude' => true,
        'longitude' => true,
        'created' => true,
        'modified' => true,
        'collaborator' => true,
    ];
}
