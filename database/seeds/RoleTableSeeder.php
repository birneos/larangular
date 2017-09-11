<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\User;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role::where('name','User')->first();
        $role_admin = new Role::where('name','Admin')->first();
        $role_author = new Role::where('name','Author')->first();

        $user = new User();
        $user->first_name("Dirk");
        $user->last_name("User");
        $user->email("user@example.com");
        $user->password = bcrypt('user');
        $user->save();
        $user->roles()->attach($role_user);

        $admin = new User();
        $admin->first_name("Steffen");
        $admin ->last_name("Admin");
        $admin->email("admin@example.com");
        $admin->password = bcrypt('admin');
        $admin->save();
        $user->roles()->attach($role_admin);

        $author = new User();
        $author->first_name("Andrea");
        $author->last_name("Author");
        $author->email("author@example.com");
        $author->password = bcrypt('author');
        $author->save();
        $user->roles()->attach($role_author);

    }
}
