<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Media Entity
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string|null $img
 * @property string|null $link
 * @property string|null $description
 * @property int $collaborator_id
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Collaborator $collaborator
 */
class Media extends Entity
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
        'title' => true,
        'type' => true,
        'img' => true,
        'link' => true,
        'description' => true,
        'collaborator_id' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
        'collaborator' => true,
    ];
}
