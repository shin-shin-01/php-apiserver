<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialze(array $config)
    {
        echo "initialize UsersTable";
        $this->setTable('users');
        $this->setEntityClass('App\Model\Entity\User');
        $this->setPrimaryKey('id');
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.buildValidator' => [
                    'created' => 'new',
                    'modified' => 'always',
                ]
            ]
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name', 'Please fill this field');

        return $validator;
    }
}
