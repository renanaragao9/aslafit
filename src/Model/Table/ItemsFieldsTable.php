<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemsFields Model
 *
 * @property \App\Model\Table\ItemTypesTable&\Cake\ORM\Association\BelongsTo $ItemTypes
 *
 * @method \App\Model\Entity\ItemsField newEmptyEntity()
 * @method \App\Model\Entity\ItemsField newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\ItemsField[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemsField get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemsField findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\ItemsField patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemsField[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemsField|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemsField saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemsField[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ItemsField[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\ItemsField[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\ItemsField[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemsFieldsTable extends Table
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

        $this->setTable('items_fields');
        $this->setDisplayField('field_name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ItemTypes', [
            'foreignKey' => 'item_type_id',
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
            ->integer('item_type_id')
            ->notEmptyString('item_type_id');

        $validator
            ->scalar('field_name')
            ->maxLength('field_name', 255)
            ->requirePresence('field_name', 'create')
            ->notEmptyString('field_name');

        $validator
            ->scalar('field_type')
            ->maxLength('field_type', 50)
            ->requirePresence('field_type', 'create')
            ->notEmptyString('field_type');

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
        $rules->add($rules->existsIn('item_type_id', 'ItemTypes'), ['errorField' => 'item_type_id']);

        return $rules;
    }
}
