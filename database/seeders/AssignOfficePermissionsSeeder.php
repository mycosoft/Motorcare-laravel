<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AssignOfficePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find administrator role
        $adminRole = Role::where('name', 'administrator')->first();
        
        if ($adminRole) {
            // Get office permissions
            $officePermissions = Permission::whereIn('name', [
                'offices.read',
                'offices.create', 
                'offices.update',
                'offices.delete'
            ])->get();
            
            // Assign permissions to admin role
            $adminRole->permissions()->syncWithoutDetaching($officePermissions->pluck('id'));
            
            $this->command->info('Office permissions assigned to administrator role successfully!');
        } else {
            $this->command->error('Administrator role not found');
        }
    }
}
