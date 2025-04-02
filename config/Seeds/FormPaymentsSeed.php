<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class FormPaymentsSeed extends AbstractSeed
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'name' => 'Dinheiro',
                'flag' => '-',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Cartão de Crédito - Visa',
                'flag' => 'visa',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Cartão de Crédito - MasterCard',
                'flag' => 'mastercard',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Cartão de Crédito - Elo',
                'flag' => 'elo',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Cartão de Crédito - American Express',
                'flag' => 'amex',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Cartão de Débito - Visa',
                'flag' => 'visa',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Cartão de Débito - MasterCard',
                'flag' => 'mastercard',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Pix',
                'flag' => 'pix',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Boleto Bancário',
                'flag' => 'boleto',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Transferência Bancária - TED',
                'flag' => 'ted',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Transferência Bancária - DOC',
                'flag' => 'doc',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Carteira Digital - PicPay',
                'flag' => 'picpay',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Carteira Digital - Mercado Pago',
                'flag' => 'mercado_pago',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
            [
                'name' => 'Carteira Digital - PayPal',
                'flag' => 'paypal',
                'active' => true,
                'created' => $now,
                'modified' => $now,
            ],
        ];

        $table = $this->table('form_payments');
        $table->insert($data)->save();
    }
}
