<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
         // Reset cached roles and permissions
         app()[PermissionRegistrar::class]->forgetCachedPermissions();

         // create permissions
         Permission::create(['name' => 'Accès Super-Administrateur']);
         Permission::create(['name' => 'Accès Administrateur']);
         Permission::create(['name' => 'Accès Agent']);
         Permission::create(['name' => 'Accès Superviseur']);
         Permission::create(['name' => 'Accès Chef-Plateau']);
         Permission::create(['name' => 'Accès DataManager']);
         Permission::create(['name' => 'Accès Coach']);
         Permission::create(['name' => 'Accès Ecoute']);

        //  create roles
         $superAdminRole = Role::create(['name' => 'Accès Super-Administrateur']);
         $superAdminRole->givePermissionTo('Accès Super-Administrateur');

         $agentRole = Role::create(['name' => 'Accès Administrateur']);
         $agentRole->givePermissionTo('Accès Administrateur');

         $agentRole = Role::create(['name' => 'Accès Agent']);
         $agentRole->givePermissionTo('Accès Agent');

         $supervisorRole = Role::create(['name' => 'Accès Superviseur']);
         $supervisorRole->givePermissionTo('Accès Superviseur');

         $chefPlateauRole = Role::create(['name' => 'Accès Chef-Plateau']);
         $chefPlateauRole->givePermissionTo('Accès Chef-Plateau');

         $dataManagerRole = Role::create(['name' => 'Accès DataManager']);
         $dataManagerRole->givePermissionTo('Accès DataManager');

         $coachRole = Role::create(['name' => 'Accès Coach']);
         $coachRole->givePermissionTo('Accès Coach');

         $ecouteRole = Role::create(['name' => 'Accès Ecoute']);
         $ecouteRole->givePermissionTo('Accès Ecoute');
         
}
}
