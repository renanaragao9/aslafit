<?php

declare(strict_types=1);

namespace App\Service\FormPayments;

use Cake\ORM\Table;

class EditService
{
    private Table $formPayments;

    public function __construct(Table $formPayments)
    {
        $this->formPayments = $formPayments;
    }

    public function run(int $id, array $data): array
    {
        $formPayment = $this->formPayments->get($id);
        $this->formPayments->patchEntity($formPayment, $data);

        if ($this->formPayments->save($formPayment)) {
            return ['success' => true, 'message' => 'Método de pagamento editado com sucesso.'];
        }

        return ['success' => false, 'message' => 'Erro ao editar o método de pagamento.'];
    }

    public function getEditData(int $id)
    {
        return ['formPayment' => $this->formPayments->get($id)];
    }
}
