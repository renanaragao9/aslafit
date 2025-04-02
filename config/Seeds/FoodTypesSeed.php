<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class FoodTypesSeed extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'Proteína',
                'description' => 'Nutriente essencial para construção e reparo dos tecidos.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Carboidrato',
                'description' => 'Principal fonte de energia para o corpo.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Gordura',
                'description' => 'Importante para absorção de vitaminas e reserva energética.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Frutas',
                'description' => 'Fontes naturais de vitaminas, fibras e antioxidantes.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Verduras',
                'description' => 'Ricas em fibras, vitaminas e minerais com baixas calorias.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Legumes',
                'description' => 'Alimentos vegetais ricos em fibras, vitaminas e nutrientes.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Carne Vermelha',
                'description' => 'Fonte rica em proteína e ferro, proveniente de bovinos.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Carne Branca',
                'description' => 'Carnes como frango e peixe, com menor teor de gordura.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Laticínios',
                'description' => 'Derivados do leite, como queijo e iogurte, ricos em cálcio.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Grãos e Cereais',
                'description' => 'Alimentos como arroz, aveia, quinoa e outros integrais.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Oleaginosas',
                'description' => 'Nozes, castanhas e sementes, fontes de gordura saudável.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Hidratação',
                'description' => 'Líquidos como água, sucos e bebidas isotônicas.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Suplementos',
                'description' => 'Produtos como whey protein, BCAA, creatina e afins.',
                'active' => true,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('food_types');
        $table->insert($data)->save();
    }
}
