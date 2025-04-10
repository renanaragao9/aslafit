<?php

declare(strict_types=1);

namespace App\Service\Medias;

use Cake\ORM\Table;

class ViewService
{
    private Table $medias;

    public function __construct(Table $medias)
    {
        $this->medias = $medias;
    }

    public function run(int $id)
    {
        return $this->medias->get($id, [
            'contain' => ['Collaborators'],
        ]);
    }
}
