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

        //  Maintenancier', 'Support', 'Gestionnaire de licence', 'Administrateur
         
        //  Droit sur toute l'application
         Permission::create(['guard_name' => 'tenant', 'name' => 'Super-Administrateur']);
        //  Droits des tenants
         Permission::create(['guard_name' => 'tenant', 'name' => 'Administrateur']);
         Permission::create(['guard_name' => 'tenant', 'name' => 'Agent']);
         Permission::create(['guard_name' => 'tenant', 'name' => 'Superviseur']);
         Permission::create(['guard_name' => 'tenant', 'name' => 'Chef-Plateau']);
         Permission::create(['guard_name' => 'tenant', 'name' => 'DataManager']);
         Permission::create(['guard_name' => 'tenant', 'name' => 'Coach']);
         Permission::create(['guard_name' => 'tenant', 'name' => 'Ecoute']);

        //  Droits du landlord
         Permission::create(['guard_name' => 'web', 'name' => 'Support']);
         Permission::create(['guard_name' => 'web', 'name' => 'Gestionnaire de licence']);
         Permission::create(['guard_name' => 'web', 'name' => 'Maintenancier']);

        //  create roles
         $superAdminRole = Role::create(['guard_name' => 'tenant', 'name' => 'Super-Administrateur']);
         $superAdminRole->givePermissionTo('Super-Administrateur');

         $agentRole = Role::create(['guard_name' => 'tenant', 'name' => 'Administrateur']);
         $agentRole->givePermissionTo('Administrateur');

         $agentRole = Role::create(['guard_name' => 'tenant', 'name' => 'Agent']);
         $agentRole->givePermissionTo('Agent');

         $supervisorRole = Role::create(['guard_name' => 'tenant', 'name' => 'Superviseur']);
         $supervisorRole->givePermissionTo('Superviseur');

         $chefPlateauRole = Role::create(['guard_name' => 'tenant', 'name' => 'Chef-Plateau']);
         $chefPlateauRole->givePermissionTo('Chef-Plateau');

         $dataManagerRole = Role::create(['guard_name' => 'tenant', 'name' => 'DataManager']);
         $dataManagerRole->givePermissionTo('DataManager');

         $coachRole = Role::create(['guard_name' => 'tenant', 'name' => 'Coach']);
         $coachRole->givePermissionTo('Coach');

         $ecouteRole = Role::create(['guard_name' => 'tenant', 'name' => 'Ecoute']);
         $ecouteRole->givePermissionTo('Ecoute');

         $dataManagerRole = Role::create(['guard_name' => 'web', 'name' => 'Maintenancier']);
         $dataManagerRole->givePermissionTo('Maintenancier');

         $coachRole = Role::create(['guard_name' => 'web', 'name' => 'Support']);
         $coachRole->givePermissionTo('Support');

         $ecouteRole = Role::create(['guard_name' => 'web', 'name' => 'Gestionnaire de licence']);
         $ecouteRole->givePermissionTo('Gestionnaire de licence');
         
}
}
