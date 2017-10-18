<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Event\Event;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
/**
 * Users Model
 *
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Levels');

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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->add('email', 'valid', ['rule' => 'email', 'message' => 'Please enter a valid email.'])
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'Password is required')
             ->add('password', [
					'length' => [
						'rule' => ['minLength', 6],
						'message' => 'Password need to be at least 6 characters long.',
					]
				]);

        // $validator
        //     ->add('level_id', 'valid', ['rule' => 'numeric'])
        //     ->requirePresence('level_id', 'create')
        //     ->notEmpty('level_id');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name', 'Name is required.');

        $validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone', 'Phone is required.');

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
        $rules->add($rules->isUnique(['email'], 'Email already in use.'));
        return $rules;
    }

    


}
