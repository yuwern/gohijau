<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AnnualReport Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Company $company
 * @property string $name
 * @property string $company_name
 * @property string $report_year
 * @property string $shareholder_file_path
 * @property string $report_pdf_file_path
 * @property bool $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class AnnualReport extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
