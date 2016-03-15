<?php
namespace App\Model\Table;

use App\Model\Entity\Circular;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;
use Search\Manager;
use Cake\Event\Event;
use ArrayObject;

/**
 * Circulars Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 */
class CircularsTable extends Table
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

        $this->table('circulars');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'LEFT'
        ]);
		
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            'shareholder_list_file' => [],
            'report_pdf' => [],
        ]);				
		  $this->addBehavior('Search.Search');
			$this->searchManager()
            ->add('name', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('name')]
			])
            ->add('company_name', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('company_name')]
			])
            ->add('circular_year', 'Search.Like', [
				'filterEmpty' => true,
                'before' => true,
                'after' => true,
                'field' => [$this->aliasField('circular_year')]
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
            ->requirePresence('company_name', 'create')
            ->notEmpty('company_name');

        $validator
            ->requirePresence('circular_year', 'create')
            ->notEmpty('circular_year');

        $validator
            ->requirePresence('subject', 'create')
            ->notEmpty('subject');

        $validator
            ->requirePresence('shareholder_list_file', 'create')
            ->notEmpty('shareholder_list_file');

        $validator
            ->requirePresence('report_pdf', 'create')
            ->notEmpty('report_pdf');

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
        return $rules;
    }
	
	
	public function generatePdf($shtData, $annualReportId , $subject){
		
		$CircularReportTable = TableRegistry::get('CircularReportUsers');
		$report = $CircularReportTable->newEntity();
		$report->circular_id = $annualReportId ;
		$report->broker_code = empty($shtData['A'])?'':$shtData['A'];
		$report->broker_type = empty($shtData['B'])?'':$shtData['B'];
		$report->name_of_broker = empty($shtData['C'])?'':$shtData['C'];
		$report->cds_ac_no = empty($shtData['D'])?'':$shtData['D'];
		$report->name_of_shareholders = empty($shtData['E'])?'':$shtData['E'];
		$report->account_qualifiers = empty($shtData['F'])?'':preg_replace('/\s\s+/', ' ', $shtData['F']);
		$report->icno = empty($shtData['G'])?'':$shtData['G'];
		$report->share_holdings = empty($shtData['H'])?'':$shtData['H'];
		$filename = uniqid().'.pdf';
		$report->user_pdf_file =  $filename;		
		$report->passcode = 'CR'.mt_rand(100000, 999999);;
		$CircularReportTable->save($report);
							
		// create new PDF document
		$pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetAuthor('Gohijau');
		$pdf->SetTitle('Gohijau');
		$pdf->SetSubject('Gohijau');
		$pdf->SetKeywords('Gohijau');
		$header_logo = 'logo.png';
		// set default header data
		$pdf->SetHeaderData($header_logo, PDF_HEADER_LOGO_WIDTH, 'User Invitation', 'Gohiju.com', array(0,64,255), array(0,64,128));
		$pdf->setFooterData(array(0,64,0), array(0,64,128));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------


		// set default font subsetting mode
		$pdf->setFontSubsetting(true);

		// Set font
		$pdf->SetFont('dejavusans', '', 14, '', true);

		// Add a page
		$pdf->AddPage();

		// set text shadow effect
		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

		$pdf->Cell(0, 0, 'Welcome to Gohijau');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(0, 12, $subject);
		$pdf->Ln();
		$pdf->Cell(0, 12, 'Reg. Passcode: '.$report->passcode);
		$pdf->Ln();
		$pdf->Cell(0, 12, 'Broker Code : '.$shtData['A']);
		$pdf->Ln();
		$pdf->Cell(0, 12, 'Name of Broker : '.$shtData['C']);
		$pdf->Ln();
		$pdf->Cell(0, 12, 'CDS AC No : '.$shtData['D']);
		$pdf->Ln();
		$pdf->Cell(0, 12, 'Account Qualifiers : '.$report->account_qualifiers);
		$pdf->Ln();
		$pdf->Cell(0, 12, 'Name of Shareholders : '.$shtData['E']);
		$pdf->Ln();
		$pdf->Cell(0, 12, 'IC NO: '.$shtData['G']);
		$pdf->Ln();

		// ---------------------------------------------------------
		
		$dir = WWW_ROOT."files/Circulars/pdf/" . $annualReportId . "/";

		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}
		
		$pdf->Output($dir.$filename, 'F');	
	}	
	
	public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
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