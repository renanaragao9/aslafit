<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemsField Entity
 *
 * @property int $id
 * @property int $item_type_id
 * @property string $field_name
 * @property string $field_type
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ItemType $item_type
 */
class ItemsField extends Entity
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
        'item_type_id' => true,
        'field_name' => true,
        'field_type' => true,
        'created' => true,
        'modified' => true,
        'item_type' => true,
    ];
}
