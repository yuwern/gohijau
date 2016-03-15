<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $name
 * @property string $address
 * @property string $phone_no
 * @property string $street
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $image_url
 * @property string $stock_code
 * @property string $market
 * @property string $sector
 * @property string $website
 * @property bool $status
 * @property \App\Model\Entity\AnnualReport[] $annual_reports
 * @property \App\Model\Entity\Circular[] $circulars
 * @property \App\Model\Entity\Event[] $events
 */
class Company extends Entity
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
