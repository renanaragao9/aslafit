<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string $order_number
 * @property \Cake\I18n\FrozenTime $order_date
 * @property string $total_amount
 * @property string $status
 * @property string $token
 * @property int|null $payment_id
 * @property bool $delivery
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\FormPayment $form_payment
 * @property \App\Model\Entity\OrderInvoice[] $order_invoices
 * @property \App\Model\Entity\OrderItem[] $order_items
 */
class Order extends Entity
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
        'order_number' => true,
        'order_date' => true,
        'total_amount' => true,
        'status' => true,
        'token' => true,
        'payment_id' => true,
        'delivery' => true,
        'created' => true,
        'modified' => true,
        'form_payment' => true,
        'order_invoices' => true,
        'order_items' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'token',
    ];
}
