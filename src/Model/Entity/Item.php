<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $quantity
 * @property string $unit_price
 * @property bool $available_for_use
 * @property bool $for_sale
 * @property bool $local_storage
 * @property int $item_type_id
 * @property int $supplier_id
 * @property int $storage_location_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\ItemType $item_type
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\StorageLocation $storage_location
 * @property \App\Model\Entity\ItemLog[] $item_logs
 * @property \App\Model\Entity\ItemValue[] $item_values
 * @property \App\Model\Entity\OrderItem[] $order_items
 */
class Item extends Entity
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
        'quantity' => true,
        'unit_price' => true,
        'available_for_use' => true,
        'for_sale' => true,
        'local_storage' => true,
        'item_type_id' => true,
        'supplier_id' => true,
        'storage_location_id' => true,
        'created' => true,
        'modified' => true,
        'item_type' => true,
        'supplier' => true,
        'storage_location' => true,
        'item_logs' => true,
        'item_values' => true,
        'order_items' => true,
    ];
}
