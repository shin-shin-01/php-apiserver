<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class UsersController extends AppController
{
    public function index(): void
    {
        $users = $this->Users->find('all');
        $this->set([
            'users' => $users,
            '_serialize' => ['users'],
        ]);
    }

    public function create(): void
    {
        if ($this->request->is('post')) {
            $users = TableRegistry::getTableLocator()->get('Users');
            $user = $users->newEntity($this->request->getData());
            if ($this->Users->save($user)) {
                $message = 'Saved';
            } else {
                $message = 'Error';
            }
            $this->set([
                'message' => $message,
                'user' => $user,
                '_serialize' => ['message', 'user'],
            ]);
        }
    }
}
