<?php

declare(strict_types=1);

namespace App\Service\FormPayments;

use Cake\ORM\Table;

class DeleteService
{
    private Table $formPayments;

    public function __construct(Table $formPayments)
    {
        $this->formPayments = $formPayments;
    }

    public function run(int $id): array
    {
        $formPayment = $this->formPayments->get($id);

        if ($this->formPayments->delete($formPayment)) {
            return ['success' => true, 'message' => 'Método de pagamento excluído com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao excluir o método de pagamento.'];
    }
}
