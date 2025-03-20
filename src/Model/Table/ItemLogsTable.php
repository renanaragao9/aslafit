<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemLogs Model
 *
 * @property \App\Model\Table\ItemsTable&\Cake\ORM\Association\BelongsTo $Items
 * @property \App\Model\Table\StorageLocationsTable&\Cake\ORM\Association\BelongsTo $StorageLocations
 *
 * @method \App\Model\Entity\ItemLog newEmptyEntity()
 * @method \App\Model\Entity\ItemLog newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ItemLog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemLog get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemLog findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ItemLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemLog[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemLog|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemLog saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemLog[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ItemLog[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ItemLog[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ItemLog[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemLogsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('item_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('StorageLocations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('item_id')
            ->notEmptyString('item_id');

        $validator
            ->integer('location_id')
            ->notEmptyString('location_id');

        $validator
            ->boolean('available_for_use')
            ->notEmptyString('available_for_use');

        $validator
            ->boolean('for_sale')
            ->notEmptyString('for_sale');

        $validator
            ->boolean('active')
            ->notEmptyString('active');

        $validator
            ->boolean('sold')
            ->notEmptyString('sold');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('item_id', 'Items'), ['errorField' => 'item_id']);
        $rules->add($rules->existsIn('location_id', 'StorageLocations'), ['errorField' => 'location_id']);

        return $rules;
    }
}
