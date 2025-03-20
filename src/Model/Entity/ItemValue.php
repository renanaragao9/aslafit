<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemValue Entity
 *
 * @property int $id
 * @property int $item_id
 * @property int $field_id
 * @property string|null $value
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\ItemsField $items_field
 */
class ItemValue extends Entity
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
        'item_id' => true,
        'field_id' => true,
        'value' => true,
        'created' => true,
        'modified' => true,
        'item' => true,
        'items_field' => true,
    ];
}
