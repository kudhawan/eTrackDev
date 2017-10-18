<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity.
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $token
 * @property int $level
 * @property string $fname
 * @property string $lname
 * @property string $company
 * @property string $title
 * @property string $phone
 * @property string $avatar
 * @property string $city
 * @property string $state
 * @property string $country
 * @property float $lat
 * @property float $lon
 * @property bool $employer
 * @property \Cake\I18n\Time $verified_at
 * @property \Cake\I18n\Time $login_at
 * @property \Cake\I18n\Time $active_at
 * @property \Cake\I18n\Time $modified
 * @property \Cake\I18n\Time $deleted_at
 * @property \Cake\I18n\Time $created
 */
class User extends Entity
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
    
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
          return (new DefaultPasswordHasher)->hash($password);
        }
    }
    protected function _setEmail($email)
    {
        return strtolower($email);
    }
    
    function checkPassword($password, $hash)
    {
        return (new DefaultPasswordHasher)->check($password, $hash);
	}
}
