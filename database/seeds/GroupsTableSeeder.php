<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'id'          => 1,
                'name'        => 'Admin',
                'permissions' => [
                    'offers.view',
                    'offers.create',
                    'offers.confirm-all',
                    'ballots.view',
                    'ballots.create',
                    'ballots.edit',
                    'invoices.view',
                    'invoices.create',
                    'invoices.edit',
                    'analytics.view',
                    'users.view',
                    'users.create',
                    'users.edit',
                    'users.group',
                    'groups.view',
                    'groups.create',
                    'groups.edit',
                ],
            ],
            [
                'id'          => 2,
                'name'        => 'Người dùng',
                'permissions' => [
                    'offers.view',
                    'offers.create',
                    'offers.confirm-all',
                    'ballots.view',
                    'ballots.create',
                    'ballots.edit',
                    'invoices.view',
                    'invoices.create',
                    'invoices.edit',
                    'analytics.view',
                    'users.view',
                    'users.create',
                    'users.edit',
                    'users.group',
                    'groups.view',
                    'groups.create',
                    'groups.edit',
                ],
            ]
        ];
        foreach ($groups as $group) {
            if(DB::table('groups')->orWhere('id', $group['id'])->orWhere('name', $group['name'])->count() > 0){
                return false;
            }
            $tmp = [];
            foreach($group['permissions'] as $val){
                $tmp[$val] = $val;
            }
            $group['permissions'] = json_encode($tmp);
            $group['created_at'] = $group['updated_at'] = date('Y-m-d H:i:s');
            DB::table('groups')->insert($group);
        }
    }
}
