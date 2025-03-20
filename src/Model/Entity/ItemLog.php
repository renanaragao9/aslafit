<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ItemLog Entity
 *
 * @property int $id
 * @property int $item_id
 * @property int $location_id
 * @property bool $available_for_use
 * @property bool $for_sale
 * @property bool $active
 * @property bool $sold
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Item $item
 * @property \App\Model\Entity\StorageLocation $storage_location
 */
class ItemLog extends Entity
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
        'location_id' => true,
        'available_for_use' => true,
        'for_sale' => true,
        'active' => true,
        'sold' => true,
        'created' => true,
        'modified' => true,
        'item' => true,
        'storage_location' => true,
    ];
}
