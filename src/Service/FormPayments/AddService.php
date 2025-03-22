<?php

declare(strict_types=1);

namespace App\Service\FormPayments;

use Cake\ORM\Table;

class AddService
{
    private Table $formPayments;

    public function __construct(Table $formPayments)
    {
        $this->formPayments = $formPayments;
    }

    public function run(array $data): array
    {
        $formPayment = $this->formPayments->newEntity($data);

        if ($this->formPayments->save($formPayment)) {
            return ['success' => true, 'message' => 'Método de pagamento salvo com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao salvar o método de pagamento.'];
    }

    public function getNewEntity()
    {
        return $this->formPayments->newEmptyEntity();
    }
}
