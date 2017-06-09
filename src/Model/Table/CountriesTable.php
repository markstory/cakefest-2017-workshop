<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Capitals
 * @property \Cake\ORM\Association\HasMany $Cities
 * @property \Cake\ORM\Association\HasMany $Languages
 *
 * @method \App\Model\Entity\Country get($primaryKey, $options = [])
 * @method \App\Model\Entity\Country newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Country[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Country|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Country patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Country[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Country findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CountriesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('countries');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Capitals', [
            'foreignKey' => 'capital_id',
        ]);
        $this->hasMany('Cities', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('NamedCities', [
            'className' => 'Cities',
            'foreignKey' => 'country_id',
            'conditions' => function ($exp, $query) {
                $func = $query->func();
                $exp->eq(
                    $func->substr(['Countries.name', 1, 1]),
                    $func->substr(['NamedCities.name', 1, 1])
                );
                return $exp;
            }
        ]);
        $this->hasMany('Languages', [
            'foreignKey' => 'country_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('continent', 'create')
            ->notEmpty('continent');

        $validator
            ->requirePresence('region', 'create')
            ->notEmpty('region');

        $validator
            ->numeric('surface_area')
            ->requirePresence('surface_area', 'create')
            ->notEmpty('surface_area');

        $validator
            ->integer('independence_year')
            ->allowEmpty('independence_year');

        $validator
            ->integer('population')
            ->requirePresence('population', 'create')
            ->notEmpty('population');

        $validator
            ->numeric('life_expectancy')
            ->allowEmpty('life_expectancy');

        $validator
            ->numeric('gnp')
            ->allowEmpty('gnp');

        $validator
            ->numeric('gnp_oid')
            ->allowEmpty('gnp_oid');

        $validator
            ->requirePresence('local_name', 'create')
            ->notEmpty('local_name');

        $validator
            ->requirePresence('government_form', 'create')
            ->notEmpty('government_form');

        $validator
            ->allowEmpty('head_of_state');

        $validator
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['capital_id'], 'Capitals'));

        return $rules;
    }

    public function findByPopulation($query, $options)
    {
        if (empty($options['operator'])) {
            throw new \RuntimeException('operator is required');
        }
        if (empty($options['value'])) {
            throw new \RuntimeException('value is required');
        }
        $operator = $options['operator'];
        $value = $options['value'];
        return $query->where(["Countries.population $operator" => $value]);
    }

    public function findByLanguage($query, $options)
    {
        if (empty($options['values'])) {
            throw new \RuntimeException('values are required');
        }
        return $query->matching('Languages', function ($q) use ($options) {
            return $q->where([
                'Languages.is_official' => 'T',
                'Languages.language IN' => $options['values']
            ]);
        });
    }


}
