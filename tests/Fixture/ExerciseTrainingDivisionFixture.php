<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ExerciseTrainingDivisionFixture
 */
class ExerciseTrainingDivisionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'exercise_training_division';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'order' => 1,
                'series' => 1,
                'repetitions' => 1,
                'weight' => 1.5,
                'rest' => 1,
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'ficha_id' => 1,
                'exercise_id' => 1,
                'training_division_id' => 1,
                'active' => 1,
                'created' => '2025-03-20 08:57:41',
                'modified' => '2025-03-20 08:57:41',
            ],
        ];
        parent::init();
    }
}
