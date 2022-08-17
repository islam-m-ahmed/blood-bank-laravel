<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset cahed
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::table('permissions')->insert(['name' => 'user list','guard_name'=> 'web','routes' => 'user.index']);
        DB::table('permissions')->insert(['name' => 'user create & edit','guard_name'=> 'web','routes' => 'user.index,user.store,user.edit,user.update']);
        DB::table('permissions')->insert(['name' => 'user delete','guard_name'=> 'web','routes' => 'user.destroy']);
        DB::table('permissions')->insert(['name' => 'client list','guard_name'=> 'web','routes' => 'client.index']);
        DB::table('permissions')->insert(['name' => 'client status','guard_name'=> 'web','routes' => 'client.status']);
        DB::table('permissions')->insert(['name' => 'client delete','guard_name'=> 'web','routes' =>'client.destroy']);
        DB::table('permissions')->insert(['name' => 'donation request list','guard_name'=> 'web','routes' =>'donation_request.index']);
        DB::table('permissions')->insert(['name' => 'donation request delete','guard_name'=> 'web','routes' =>'donation_request.destroy']);
        DB::table('permissions')->insert(['name' => 'role add & edit','guard_name'=> 'web','routes' =>'role.create,role.store,role.edit,role.update']);
        DB::table('permissions')->insert(['name' => 'role delete','guard_name'=> 'web','routes' =>'role.destroy']);
        DB::table('permissions')->insert(['name' => 'role list','guard_name'=> 'web','routes' =>'role.index']);
        DB::table('permissions')->insert(['name' => 'settings edit','guard_name'=> 'web','routes' =>'setting.edit,setting.update']);
        DB::table('permissions')->insert(['name' => 'contact delete','guard_name'=> 'web','routes' =>'contact.destroy']);
        DB::table('permissions')->insert(['name' => 'contact list','guard_name'=> 'web','routes' =>'contact.index']);
        DB::table('permissions')->insert(['name' => 'post list','guard_name'=> 'web','routes' =>'post.index']);
        DB::table('permissions')->insert(['name' => 'post add & edit','guard_name'=> 'web','routes' =>'post.store,post.create,post.edit,post.update']);
        DB::table('permissions')->insert(['name' => 'post remove','guard_name'=> 'web','routes' =>'post.destroy']);
        DB::table('permissions')->insert(['name' => 'category add & edit','guard_name'=> 'web','routes' =>'category.store,category.create,category.edit,category.update']);
        DB::table('permissions')->insert(['name' => 'category remove','guard_name'=> 'web','routes' =>'category.destroy']);
        DB::table('permissions')->insert(['name' => 'city add & edit','guard_name'=> 'web','routes' =>'city.store,city.create,city.edit,city.update']);
        DB::table('permissions')->insert(['name' => 'city remove','guard_name'=> 'web','routes' =>'city.destroy']);
        DB::table('permissions')->insert(['name' => 'governorate add & edit','guard_name'=> 'web','routes' =>'governorate.store,governorate.create,governorate.edit,governorate.update']);
        DB::table('permissions')->insert(['name' => 'governorate remove','guard_name'=> 'web','routes' =>'governorate.destroy']);


        //role permission
        // or may be done by chaining
        // do all with out see role
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo(['user list','client list','client status','client delete','donation request list','donation request delete',
            'settings edit','contact delete','contact list','post list','post add & edit','post remove','category add & edit','category remove',
            'city add & edit','city remove','governorate add & edit','governorate remove']);
        //writer can posts
        $role3 = Role::create(['name' => 'writer']);
        $role3->givePermissionTo(['post list', 'post add & edit','category add & edit']);

        // modorateo can view message and donation request and client
        $role4 = Role::create(['name' => 'moderator']);
        $role4->givePermissionTo(['contact list', 'client list','donation request list','post list']);

        //can do any thing
        $role2 = Role::create(['name' => 'programmer']);
        $role2->givePermissionTo(Permission::all());

        //can do any thing
        $role2 = Role::create(['name' => 'super-admin']);
        $role2->givePermissionTo(Permission::all());

        //user
        $user = \App\Models\User::factory()->create([
            'name' => 'islam super admin',
            'email' => 'islam@islam.com',
        ]);
        $user->assignRole($role2);
    }
}
