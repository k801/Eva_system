<?php
 namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$permissions = [
'role',
'role27',
'role37',
'role47',
];
foreach ($permissions as $permission) {
Permission::create(['name' => $permission]);
}
}
}
