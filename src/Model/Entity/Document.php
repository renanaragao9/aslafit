<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Document Entity
 *
 * @property int $id
 * @property string $documentable_type
 * @property int $documentable_id
 * @property string $document_type
 * @property string $document_number
 * @property bool|null $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Document extends Entity
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
        'documentable_type' => true,
        'documentable_id' => true,
        'document_type' => true,
        'document_number' => true,
        'active' => true,
        'created' => true,
        'modified' => true,
    ];
}
