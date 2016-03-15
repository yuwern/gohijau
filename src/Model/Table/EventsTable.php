<?php
namespace App\Model\Table;

use App\Model\Entity\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;
use ArrayObject;
use Cake\ORM\TableRegistry;

/**
 * Events Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Reports
 */
class EventsTable extends Table
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

        $this->table('events');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);
		
        $this->belongsTo('AnnualReports', [
            'foreignKey' => 'report_id',
            'joinType' => 'LEFT'
        ]);    

		$this->belongsTo('Circulars', [
            'foreignKey' => 'report_id',
            'joinType' => 'LEFT'
        ]);
		
		$this->hasMany('UsersEvents', [
            'foreignKey' => 'event_id',
            'joinType' => 'LEFT'
        ]);
		$this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('company_name', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('company_name')]
			])          
			->add('report_type', 'Search.Value')
            ->add('year', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('year')]
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
            ->requirePresence('event_type', 'create')
            ->notEmpty('event_type');

        $validator
            ->requirePresence('company_name', 'create')
            ->notEmpty('company_name');

        $validator
            ->requirePresence('year', 'create')
            ->notEmpty('year');

        $validator
            ->requirePresence('report_type', 'create')
            ->notEmpty('report_type');

        $validator
            ->requirePresence('venue', 'create')
            ->notEmpty('venue');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('descripiton', 'create')
            ->notEmpty('descripiton');

        $validator
            ->add('status', 'valid', ['rule' => 'boolean'])
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        return $rules;
    }
	
	
	public function beforeMarshal(\Cake\Event\Event $event, ArrayObject $data, ArrayObject $options)
	{
		//set company Id
		$data['company_id'] = $this->getCompany($data['company_name']);
	}		
	
	Public function getCompany($name){
		$companyTable = TableRegistry::get('Companies');
		$query = $companyTable->findByName($name);
		$results = $query->first();
		if(empty($results)){
			$company = $companyTable->newEntity();
			$company->name = $name;

			if ($companyTable->save($company)) {
				// The $article entity contains the id now
				return $company->id;
			}else{
				return 0;
			}
		}else{
			return $results->id;
		}
	}		
}
