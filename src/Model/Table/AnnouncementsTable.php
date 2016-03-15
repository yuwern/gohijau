<?php
namespace App\Model\Table;

use App\Model\Entity\Announcement;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Announcements Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $AnnualReports
 */
class AnnouncementsTable extends Table
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

        $this->table('announcements');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AnnualReports', [
            'foreignKey' => 'related_id',
            'joinType' => 'INNER'
        ]);

		$this->belongsTo('Circulars', [
            'foreignKey' => 'related_id',
            'joinType' => 'LEFT'
        ]);
		
		 $this->belongsTo('AnnualReportUsers', [
            'foreignKey' => 'related_id',
            'joinType' => 'INNER'
        ]);
		
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'attachment' => []
        ]);		
		
		$this->addBehavior('Search.Search');
        $this->searchManager()
            ->add('title', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('title')]
			])
            ->add('content', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('content')]
			])
            ->add('date', 'Search.Value', [
				'filterEmpty' => true,
                'field' => date('Y-m-d',strtotime($this->aliasField('date')))
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
            ->requirePresence('category_type', 'create')
            ->notEmpty('category_type');


        $validator
            ->requirePresence('attachment', 'create')
            ->allowEmpty('attachment');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
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
        $rules->add($rules->existsIn(['annual_report_id'], 'AnnualReports'));
        return $rules;
    }
}
