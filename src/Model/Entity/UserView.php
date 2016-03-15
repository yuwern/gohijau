<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserView Entity.
 *
 * @property int $id
 * @property \Cake\I18n\Time $created
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $report_id
 * @property \App\Model\Entity\Report $report
 * @property bool $is_view
 * @property bool $is_download
 * @property string $report_type
 * @property bool $status
 */
class UserView extends Entity
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
