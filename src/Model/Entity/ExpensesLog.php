<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ExpensesLog Entity
 *
 * @property int $id
 * @property string $expense_type
 * @property int $reference_id
 * @property string $amount
 * @property string $transaction_type
 * @property string|null $description
 * @property \Cake\I18n\FrozenDate $date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class ExpensesLog extends Entity
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
        'expense_type' => true,
        'reference_id' => true,
        'amount' => true,
        'transaction_type' => true,
        'description' => true,
        'date' => true,
        'created' => true,
        'modified' => true,
    ];
}
