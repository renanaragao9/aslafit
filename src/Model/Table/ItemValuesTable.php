<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemValues Model
 *
 * @property \App\Model\Table\ItemsTable&\Cake\ORM\Association\BelongsTo $Items
 * @property \App\Model\Table\ItemsFieldsTable&\Cake\ORM\Association\BelongsTo $ItemsFields
 *
 * @method \App\Model\Entity\ItemValue newEmptyEntity()
 * @method \App\Model\Entity\ItemValue newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ItemValue[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemValue get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemValue findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ItemValue patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemValue[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemValue|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemValue saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemValue[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ItemValue[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ItemValue[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ItemValue[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemValuesTable extends Table
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

        $this->setTable('item_values');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ItemsFields', [
            'foreignKey' => 'field_id',
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
            ->integer('field_id')
            ->notEmptyString('field_id');

        $validator
            ->scalar('value')
            ->allowEmptyString('value');

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
        $rules->add($rules->existsIn('field_id', 'ItemsFields'), ['errorField' => 'field_id']);

        return $rules;
    }
}
