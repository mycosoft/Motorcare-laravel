<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    private const CRUD_DEF = [
        'create',
        'read',
        'update',
        'delete'
    ];

    private const DEFAULT_CRUD_RESOURCES = [
        'roles',
        'permissions',
        'users',
        'teams',
        'brands',
        'gallery_categories',
        'galleries',
    ];

    public function run(): void
    {
        DB::transaction(function () {
            for ($i = 0; $i < count(self::DEFAULT_CRUD_RESOURCES); $i++) {
                for ($j = 0; $j < count(self::CRUD_DEF); $j++) {
                    \App\Models\Permission::firstOrCreate([
                        'name' => self::DEFAULT_CRUD_RESOURCES[$i] . '.' . self::CRUD_DEF[$j]
                    ]);
                }
            }

            \App\Models\Permission::firstOrCreate([
                'name' => 'profile.read'
            ]);

            \App\Models\Permission::firstOrCreate([
                'name' => 'profile.update'
            ]);

            \App\Models\Permission::firstOrCreate([
                'name' => 'dashboard.read'
            ]);
        });
    }
}
