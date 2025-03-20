<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MonthlyPlan Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $date_payment
 * @property \Cake\I18n\FrozenDate $date_venciment
 * @property string $value
 * @property string|null $observation
 * @property int $payment_id
 * @property int $plan_type_id
 * @property int $student_id
 * @property int $collaborator_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\FormPayment $form_payment
 * @property \App\Model\Entity\PlanType $plan_type
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Collaborator $collaborator
 */
class MonthlyPlan extends Entity
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
        'date_payment' => true,
        'date_venciment' => true,
        'value' => true,
        'observation' => true,
        'payment_id' => true,
        'plan_type_id' => true,
        'student_id' => true,
        'collaborator_id' => true,
        'created' => true,
        'modified' => true,
        'form_payment' => true,
        'plan_type' => true,
        'student' => true,
        'collaborator' => true,
    ];
}
