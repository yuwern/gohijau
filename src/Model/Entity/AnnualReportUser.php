<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AnnualReportUser Entity.
 *
 * @property int $id
 * @property int $annual_report_id
 * @property \App\Model\Entity\AnnualReport $annual_report
 * @property string $passcode
 * @property string $user_pdf_file
 * @property int $broker_code
 * @property int $broker_type
 * @property string $name_of_broker
 * @property int $cds_ac_no
 * @property string $name_of_shareholders
 * @property string $account_qualifiers
 * @property string $icno
 * @property float $share_holdings
 * @property bool $status
 */
class AnnualReportUser extends Entity
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
