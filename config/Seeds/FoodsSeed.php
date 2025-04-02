<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

class FoodsSeed extends AbstractSeed
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            // Proteínas (food_type_id = 1)
            ['name' => 'Frango grelhado', 'link' => null, 'food_type_id' => 1, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Peito de peru', 'link' => null, 'food_type_id' => 1, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Clara de ovo', 'link' => null, 'food_type_id' => 1, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Tofu', 'link' => null, 'food_type_id' => 1, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Salmão', 'link' => null, 'food_type_id' => 1, 'active' => true, 'created' => $now, 'modified' => $now],

            // Carboidratos (2)
            ['name' => 'Arroz integral', 'link' => null, 'food_type_id' => 2, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Batata-doce', 'link' => null, 'food_type_id' => 2, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Aveia', 'link' => null, 'food_type_id' => 2, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Macarrão integral', 'link' => null, 'food_type_id' => 2, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Banana', 'link' => null, 'food_type_id' => 2, 'active' => true, 'created' => $now, 'modified' => $now],

            // Gorduras (3)
            ['name' => 'Abacate', 'link' => null, 'food_type_id' => 3, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Azeite de oliva', 'link' => null, 'food_type_id' => 3, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Manteiga de amendoim', 'link' => null, 'food_type_id' => 3, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Castanha-do-pará', 'link' => null, 'food_type_id' => 3, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Nozes', 'link' => null, 'food_type_id' => 3, 'active' => true, 'created' => $now, 'modified' => $now],

            // Frutas (4)
            ['name' => 'Maçã', 'link' => null, 'food_type_id' => 4, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Laranja', 'link' => null, 'food_type_id' => 4, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Mamão', 'link' => null, 'food_type_id' => 4, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Melancia', 'link' => null, 'food_type_id' => 4, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Uva', 'link' => null, 'food_type_id' => 4, 'active' => true, 'created' => $now, 'modified' => $now],

            // Verduras (5)
            ['name' => 'Alface', 'link' => null, 'food_type_id' => 5, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Couve', 'link' => null, 'food_type_id' => 5, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Espinafre', 'link' => null, 'food_type_id' => 5, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Rúcula', 'link' => null, 'food_type_id' => 5, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Agrião', 'link' => null, 'food_type_id' => 5, 'active' => true, 'created' => $now, 'modified' => $now],

            // Legumes (6)
            ['name' => 'Cenoura', 'link' => null, 'food_type_id' => 6, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Beterraba', 'link' => null, 'food_type_id' => 6, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Abobrinha', 'link' => null, 'food_type_id' => 6, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Berinjela', 'link' => null, 'food_type_id' => 6, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Vagem', 'link' => null, 'food_type_id' => 6, 'active' => true, 'created' => $now, 'modified' => $now],

            // Carne Vermelha (7)
            ['name' => 'Patinho moído', 'link' => null, 'food_type_id' => 7, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Coxão mole', 'link' => null, 'food_type_id' => 7, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Filé mignon', 'link' => null, 'food_type_id' => 7, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Contra filé', 'link' => null, 'food_type_id' => 7, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Acém', 'link' => null, 'food_type_id' => 7, 'active' => true, 'created' => $now, 'modified' => $now],

            // Carne Branca (food_type_id = 8)
            ['name' => 'Filé de frango', 'link' => null, 'food_type_id' => 8, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Tilápia grelhada', 'link' => null, 'food_type_id' => 8, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Peito de frango desfiado', 'link' => null, 'food_type_id' => 8, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Atum enlatado em água', 'link' => null, 'food_type_id' => 8, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Ovo cozido', 'link' => null, 'food_type_id' => 8, 'active' => true, 'created' => $now, 'modified' => $now],

            // Laticínios (9)
            ['name' => 'Leite desnatado', 'link' => null, 'food_type_id' => 9, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Queijo cottage', 'link' => null, 'food_type_id' => 9, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Iogurte natural', 'link' => null, 'food_type_id' => 9, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Queijo minas frescal', 'link' => null, 'food_type_id' => 9, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Requeijão light', 'link' => null, 'food_type_id' => 9, 'active' => true, 'created' => $now, 'modified' => $now],

            // Grãos e Cereais (10)
            ['name' => 'Quinoa', 'link' => null, 'food_type_id' => 10, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Cevada', 'link' => null, 'food_type_id' => 10, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Milho cozido', 'link' => null, 'food_type_id' => 10, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Granola sem açúcar', 'link' => null, 'food_type_id' => 10, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Arroz selvagem', 'link' => null, 'food_type_id' => 10, 'active' => true, 'created' => $now, 'modified' => $now],

            // Oleaginosas (11)
            ['name' => 'Castanha de caju', 'link' => null, 'food_type_id' => 11, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Amêndoas', 'link' => null, 'food_type_id' => 11, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Pistache sem sal', 'link' => null, 'food_type_id' => 11, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Semente de girassol', 'link' => null, 'food_type_id' => 11, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Semente de abóbora', 'link' => null, 'food_type_id' => 11, 'active' => true, 'created' => $now, 'modified' => $now],

            // Hidratação (12)
            ['name' => 'Água mineral', 'link' => null, 'food_type_id' => 12, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Água de coco', 'link' => null, 'food_type_id' => 12, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Suco natural de laranja', 'link' => null, 'food_type_id' => 12, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Chá verde', 'link' => null, 'food_type_id' => 12, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Bebida isotônica', 'link' => null, 'food_type_id' => 12, 'active' => true, 'created' => $now, 'modified' => $now],

            // Suplementos (13)
            ['name' => 'Whey protein', 'link' => null, 'food_type_id' => 13, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Creatina', 'link' => null, 'food_type_id' => 13, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'BCAA', 'link' => null, 'food_type_id' => 13, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Albumina', 'link' => null, 'food_type_id' => 13, 'active' => true, 'created' => $now, 'modified' => $now],
            ['name' => 'Pré-treino', 'link' => null, 'food_type_id' => 13, 'active' => true, 'created' => $now, 'modified' => $now],
        ];

        $table = $this->table('foods');
        $table->insert($data)->save();
    }
}
