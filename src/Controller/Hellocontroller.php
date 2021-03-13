<?php
declare(strict_types=1);

namespace App\Controller;

class HelloController extends AppController
{
    public function world(): void
    {
        $this->set([
            'message' => 'hello world',
            '_serialize' => ['message'],
        ]);
    }
}
