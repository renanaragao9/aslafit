<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Assessment Entity
 *
 * @property int $id
 * @property string $goal
 * @property string|null $observation
 * @property string $term
 * @property string $height
 * @property string $weight
 * @property string|null $arm
 * @property string|null $forearm
 * @property string|null $breastplate
 * @property string|null $back
 * @property string|null $waist
 * @property string|null $glute
 * @property string|null $hip
 * @property string|null $thigh
 * @property string|null $calf
 * @property int|null $ficha_id
 * @property bool $active
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Ficha $ficha
 */
class Assessment extends Entity
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
        'goal' => true,
        'observation' => true,
        'height' => true,
        'weight' => true,
        'arm' => true,
        'forearm' => true,
        'breastplate' => true,
        'back' => true,
        'waist' => true,
        'glute' => true,
        'hip' => true,
        'thigh' => true,
        'calf' => true,
        'ficha_id' => true,
        'created' => true,
        'modified' => true,
        'ficha' => true,
    ];
}
