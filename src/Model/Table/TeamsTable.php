<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
/**
 * Users Model
 *
 */
class TeamsTable extends Table
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

        $this->addBehavior('Timestamp');
        // $this->displayField('name');
        // $this->primaryKey('id');
        // $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'member_id',
            'className' => 'Users'
        ]);

         $this->belongsTo('Projects', [
             'foreignKey' => 'project_id',
             'className' => 'Projects'
         ]);


        $this->belongsTo('Designations', [
            'foreignKey' => 'designation_id',
            'className' => 'Designations'
        ]);
		
        $this->belongsTo('Positions', [
            'foreignKey' => 'position_id',
            'className' => 'Positions'
        ]);
    }

     
    
}
