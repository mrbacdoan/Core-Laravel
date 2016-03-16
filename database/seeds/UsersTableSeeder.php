<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'nhamhv',
                'email' => 'nhamhv@izee.vn',
                'password' => bcrypt('izeemedia'),
                'full_name' => 'Hoàng Văn Nhâm',
                'phone' => '01638572284',
                'address' => 'Bắc Giang',
                'group_id' => '2',
                'status' => 1,
                'gender' => 1
            ],
            [
                'username' => 'phucpm',
                'email' => 'phucpm@izee.vn',
                'password' => bcrypt('izeemedia'),
                'full_name' => 'Phạm Minh Phúc',
                'phone' => '0985315508',
                'address' => 'Thái Bình',
                'group_id' => '2',
                'status' => 1,
                'gender' => 1
            ],
            [
                'username' => 'admin',
                'email' => 'admin@izee.vn',
                'password' => bcrypt('izeemedia'),
                'full_name' => 'IZee Media',
                'phone' => '',
                'address' => 'Việt Nam',
                'group_id' => 1,
                'status' => 1,
                'gender' => 1
            ]
        ];

        foreach($users as $user){
            $user['created_at'] = $user['updated_at'] = date('Y-m-d H:i:s');
            if(DB::table('users')->where('username', $user['username'])->count() == 0){
                DB::table('users')->insert($user);
            }
        }
    }

}
