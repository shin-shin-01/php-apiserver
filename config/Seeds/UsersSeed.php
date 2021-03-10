<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'id'       => 1,
                'name'     => 'test',
                'created'  => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')

            ],
        ];
        
        
        foreach($datas as $data) {
            // 一度出たエラーを所持するため毎回初期化
            $table = $this->table('users');
            try {
                $table->insert($data)->save();
            } catch(PDOException $e) {
                // 既にデータが存在している場合にアップデート
                // TODO: Take measures SQL injection
                $name = $data["name"];
                $id = $data["id"];
                $modified = $data["modified"];
                $this->execute("UPDATE users SET name='{$name}', modified='{$modified}' WHERE id = {$id}");
            };
            
        }
    }
}
