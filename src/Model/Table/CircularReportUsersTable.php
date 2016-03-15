<?php
namespace App\Model\Table;

use App\Model\Entity\CircularReportUser;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CircularReportUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Circulars
 */
class CircularReportUsersTable extends Table
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

        $this->table('circular_report_users');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Circulars', [
            'foreignKey' => 'circular_id',
            'joinType' => 'INNER'
        ]);
	
		$this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('passcode', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('passcode')]
			])
            ->add('name_of_broker', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('name_of_broker')]
			])
            ->add('icno', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('icno')]
            ])->add('q', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('name_of_shareholders'),$this->aliasField('account_qualifiers'),$this->aliasField('broker_code')]
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
            ->requirePresence('passcode', 'create')
            ->notEmpty('passcode');

        $validator
            ->requirePresence('user_pdf_file', 'create')
            ->notEmpty('user_pdf_file');

        $validator
            ->add('broker_code', 'valid', ['rule' => 'numeric'])
            ->requirePresence('broker_code', 'create')
            ->notEmpty('broker_code');

        $validator
            ->add('broker_type', 'valid', ['rule' => 'numeric'])
            ->requirePresence('broker_type', 'create')
            ->notEmpty('broker_type');

        $validator
            ->requirePresence('name_of_broker', 'create')
            ->notEmpty('name_of_broker');

        $validator
            ->add('cds_ac_no', 'valid', ['rule' => 'numeric'])
            ->requirePresence('cds_ac_no', 'create')
            ->notEmpty('cds_ac_no');

        $validator
            ->requirePresence('name_of_shareholders', 'create')
            ->notEmpty('name_of_shareholders');

        $validator
            ->requirePresence('account_qualifiers', 'create')
            ->notEmpty('account_qualifiers');

        $validator
            ->requirePresence('icno', 'create')
            ->notEmpty('icno');

        $validator
            ->add('share_holdings', 'valid', ['rule' => 'numeric'])
            ->requirePresence('share_holdings', 'create')
            ->notEmpty('share_holdings');

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
        $rules->add($rules->existsIn(['circular_id'], 'Circulars'));
        return $rules;
    }
}
