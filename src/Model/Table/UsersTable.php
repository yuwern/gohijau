<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;
use Cake\Validation;
use Cake\Auth\DefaultPasswordHasher;
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
        $this->displayField('email');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
		
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'avatar' => [],
        ]);
		
        $this->belongsTo('Groups', [
            'foreignKey' => 'group_id',
            'joinType' => 'LEFT'
        ]);
		
		$this->hasMany('UserCompanies', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);
		
        $this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('email', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('email')]
			])
            ->add('username', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('username')]
			])
            ->add('q', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('first_name'), $this->aliasField('last_name')]
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
            ->requirePresence('username', 'create')
            ->notEmpty('username', 'Name is required');

        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->allowEmpty('email');

        $validator
            //->requirePresence('password', 'create')
            ->allowEmpty('password');
			
		//$validator->requirePresence('old_password', 'reset');
		//$validator->requirePresence('new_password', 'reset');
		//$validator->requirePresence('confirm_password', 'reset');
		$validator
            ->notEmpty('old_password')
                ->add('old_password', 'custom', [
                    'rule' => 

                    function($value, $context) {
                        $query = $this->find()
                                ->where([
                                    'id' => $context['data']['id']
                                ])
                                ->first();

                        $data = $query->toArray();

                        return (new DefaultPasswordHasher)->check($value, $data['password']);
                    },
                    'message' => 'Current password is incorrect!'
                ]);
				
		$validator
			->add('confirm_password',
				'compareWith', [
					'rule' => ['compareWith', 'password'],
					'message' => 'Passwords not equal.'
				]
			)		
			->add('password', [
				'minLength' => [
					'rule' => ['minLength', 6],
					'message' => 'Minimum length of password is 6 letters'
				],
				'maxLength' => [
					'rule' => ['maxLength', 20],
					'message' => 'Maximum length of password is 20 letters'
				]
			])
            ;		
			
			
			$validator
			->add('confirm_password1',
				'compareWith', [
					'rule' => ['compareWith', 'new_password'],
					'message' => 'Passwords not equal.'
				]
			)		
			->add('new_password', [
				'minLength' => [
					'rule' => ['minLength', 6],
					'message' => 'Minimum length of password is 6 letters'
				],
				'maxLength' => [
					'rule' => ['maxLength', 20],
					'message' => 'Maximum length of password is 20 letters'
				]
			])
            ;

        $validator
            ->allowEmpty('first_name');

        $validator
            ->allowEmpty('last_name');

        $validator
            ->allowEmpty('role');
        
		$validator
            ->requirePresence('activation_key', 'create')
            ->notEmpty('activation_key', 'Activation key is required');
						        
		$validator
            ->requirePresence('cds_acc_no', 'create')
            ->notEmpty('cds_acc_no', 'CDS Acc No is required');
									        
		$validator
            ->requirePresence('company_reg_no', 'create')
            ->notEmpty('company_reg_no',  'ICNO is required');					
	
		$validator
            ->requirePresence('phone', 'create')
            ->notEmpty('phone', 'Phone no is required');
			
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
        //$rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
	
	function equalToField($array, $field) {
		return strcmp($this->data[$this->alias][key($array)], $this->data[$this->alias][$field]) == 0;
	}
}
