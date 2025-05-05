<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $viewRoutes = Permission::create([
            'name' => 'View Routes',
            'slug' => 'view-routes',
            'description' => 'Can view bus routes'
        ]);

        $bookTickets = Permission::create([
            'name' => 'Book Tickets',
            'slug' => 'book-tickets',
            'description' => 'Can book bus tickets'
        ]);

        $manageUsers = Permission::create([
            'name' => 'Manage Users',
            'slug' => 'manage-users',
            'description' => 'Can manage users'
        ]);

        $manageRoutes = Permission::create([
            'name' => 'Manage Routes',
            'slug' => 'manage-routes',
            'description' => 'Can manage bus routes'
        ]);

        $manageSystem = Permission::create([
            'name' => 'Manage System',
            'slug' => 'manage-system',
            'description' => 'Can manage system settings'
        ]);

        // Create roles
        $visitor = Role::create([
            'name' => 'Visitor',
            'slug' => 'visitor',
            'description' => 'Basic visitor role'
        ]);

        $traveler = Role::create([
            'name' => 'Traveler',
            'slug' => 'traveler',
            'description' => 'Registered traveler role'
        ]);

        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Administrator role'
        ]);

        // Assign permissions to roles
        $visitor->permissions()->attach([$viewRoutes->id]);

        $traveler->permissions()->attach([
            $viewRoutes->id,
            $bookTickets->id
        ]);

        $admin->permissions()->attach([
            $viewRoutes->id,
            $bookTickets->id,
            $manageUsers->id,
            $manageRoutes->id,
            $manageSystem->id
        ]);
    }
}
