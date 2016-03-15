<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Announcement Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $annual_report_id
 * @property \App\Model\Entity\AnnualReport $annual_report
 * @property string $category_type
 * @property \Cake\I18n\Time $date
 * @property string $title
 * @property string $content
 * @property int $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Announcement extends Entity
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
