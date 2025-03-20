<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Called Entity
 *
 * @property int $id
 * @property string $urgency
 * @property string $title
 * @property string $subject
 * @property string $status
 * @property bool $active
 * @property int|null $collaborator_id
 * @property int|null $student_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Collaborator $collaborator
 * @property \App\Model\Entity\Student $student
 */
class Called extends Entity
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
        'urgency' => true,
        'title' => true,
        'subject' => true,
        'status' => true,
        'active' => true,
        'collaborator_id' => true,
        'student_id' => true,
        'created' => true,
        'modified' => true,
        'collaborator' => true,
        'student' => true,
    ];
}
