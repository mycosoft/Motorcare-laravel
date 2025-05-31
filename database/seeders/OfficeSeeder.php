<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ALPHABETICAL ORDER BY CITY NAME - VERIFIED COORDINATES
        $offices = [
            // A - ARUA
            [
                'name' => 'MOTORCARE ARUA - TOTAL ARUA NILE',
                'type' => 'service_center',
                'address' => 'Arua-Nebbi Road, Total Fuel Station',
                'city' => 'Arua',
                'region' => 'West Nile',
                'phone' => '+256 476 420 500',
                'email' => 'arua@motorcareuganda.com',
                'latitude' => 3.019400,
                'longitude' => 30.910700,
                'services' => ['Service', 'Parts', 'Fuel'],
                'working_hours' => [
                    'monday_friday' => '8:00 AM - 6:00 PM',
                    'saturday' => '8:00 AM - 4:00 PM',
                    'sunday' => '9:00 AM - 2:00 PM'
                ],
                'manager_name' => 'Samuel Drani',
                'manager_phone' => '+256 700 890 123',
                'description' => 'West Nile region service center at Total station',
                'is_active' => true
            ],
            // G - GULU
            [
                'name' => 'MOTORCARE GULU/MAKO WAREHOUSING',
                'type' => 'service_center',
                'address' => 'Plot 22 Oola Lubara Road',
                'city' => 'Gulu',
                'region' => 'Northern',
                'phone' => '+256 471 432 100',
                'email' => 'gulu@motorcareuganda.com',
                'latitude' => 2.818578,
                'longitude' => 32.446724,
                'services' => ['Parts', 'Warehousing', 'Distribution'],
                'working_hours' => [
                    'monday_friday' => '7:00 AM - 5:00 PM',
                    'saturday' => '8:00 AM - 2:00 PM',
                    'sunday' => 'Closed'
                ],
                'manager_name' => 'David Okello',
                'manager_phone' => '+256 700 456 789',
                'description' => 'Northern region warehousing and distribution center',
                'is_active' => true
            ],
            // J - JINJA
            [
                'name' => 'MOTORCARE JINJA - TOTAL JINJA',
                'type' => 'service_center',
                'address' => 'Jinja Main Street, Total Fuel Station',
                'city' => 'Jinja',
                'region' => 'Eastern',
                'phone' => '+256 434 420 600',
                'email' => 'jinja@motorcareuganda.com',
                'latitude' => 0.429700,
                'longitude' => 33.204000,
                'services' => ['Service', 'Parts', 'Fuel'],
                'working_hours' => [
                    'monday_friday' => '8:00 AM - 6:00 PM',
                    'saturday' => '8:00 AM - 4:00 PM',
                    'sunday' => '9:00 AM - 2:00 PM'
                ],
                'manager_name' => 'James Wamala',
                'manager_phone' => '+256 700 012 345',
                'description' => 'Eastern region service center at Total station',
                'is_active' => true
            ],
            // K - KAMPALA
            [
                'name' => 'MOTORCARE UGANDA LIMITED',
                'type' => 'branch',
                'address' => 'Kitgum House, Jinja Road',
                'city' => 'Kampala',
                'region' => 'Central',
                'phone' => '+256 414 237 000',
                'email' => 'info@motorcareuganda.com',
                'latitude' => 0.347596,
                'longitude' => 32.582520,
                'services' => ['Sales', 'Service', 'Parts', 'Finance'],
                'working_hours' => [
                    'monday_friday' => '8:00 AM - 6:00 PM',
                    'saturday' => '8:00 AM - 5:00 PM',
                    'sunday' => 'Closed'
                ],
                'manager_name' => 'John Mukasa',
                'manager_phone' => '+256 700 123 456',
                'description' => 'Main headquarters and showroom',
                'is_active' => true
            ],
            // K - KITGUM
            [
                'name' => 'MOTORCARE KITGUM - TOTAL KITGUM',
                'type' => 'service_center',
                'address' => 'Kitgum Town Center, Total Fuel Station',
                'city' => 'Kitgum',
                'region' => 'Northern',
                'phone' => '+256 471 420 700',
                'email' => 'kitgum@motorcareuganda.com',
                'latitude' => 3.278400,
                'longitude' => 32.879400,
                'services' => ['Service', 'Parts', 'Fuel'],
                'working_hours' => [
                    'monday_friday' => '8:00 AM - 6:00 PM',
                    'saturday' => '8:00 AM - 4:00 PM',
                    'sunday' => '9:00 AM - 2:00 PM'
                ],
                'manager_name' => 'Patrick Okumu',
                'manager_phone' => '+256 700 123 456',
                'description' => 'Northern region service center at Total station',
                'is_active' => true
            ],
            // L - LIRA
            [
                'name' => 'MOTORCARE LIRA - TOTAL LIRA',
                'type' => 'service_center',
                'address' => 'Lira Main Street, Total Fuel Station',
                'city' => 'Lira',
                'region' => 'Northern',
                'phone' => '+256 473 420 300',
                'email' => 'lira@motorcareuganda.com',
                'latitude' => 2.249100,
                'longitude' => 32.899800,
                'services' => ['Service', 'Parts', 'Fuel'],
                'working_hours' => [
                    'monday_friday' => '8:00 AM - 6:00 PM',
                    'saturday' => '8:00 AM - 4:00 PM',
                    'sunday' => '9:00 AM - 2:00 PM'
                ],
                'manager_name' => 'Moses Odongo',
                'manager_phone' => '+256 700 678 901',
                'description' => 'Northern region service center at Total station',
                'is_active' => true
            ],
            // M - MASAKA
            [
                'name' => 'MOTORCARE UGANDA MASAKA',
                'type' => 'branch',
                'address' => 'Masaka-Kampala Road, Commercial Area',
                'city' => 'Masaka',
                'region' => 'Central',
                'phone' => '+256 481 420 789',
                'email' => 'masaka@motorcareuganda.com',
                'latitude' => -0.350000,
                'longitude' => 31.730000,
                'services' => ['Sales', 'Service', 'Parts'],
                'working_hours' => [
                    'monday_friday' => '8:00 AM - 6:00 PM',
                    'saturday' => '8:00 AM - 4:00 PM',
                    'sunday' => 'Closed'
                ],
                'manager_name' => 'Peter Ssebunya',
                'manager_phone' => '+256 700 345 678',
                'description' => 'Southern region branch office',
                'is_active' => true
            ],
            // M - MBARARA
            [
                'name' => 'MOTORCARE UGANDA MBARARA',
                'type' => 'branch',
                'address' => 'Mbarara-Kampala Road, Commercial Area',
                'city' => 'Mbarara',
                'region' => 'Western',
                'phone' => '+256 485 440 123',
                'email' => 'mbarara@motorcareuganda.com',
                'latitude' => -0.607160,
                'longitude' => 30.654503,
                'services' => ['Sales', 'Service', 'Parts'],
                'working_hours' => [
                    'monday_friday' => '8:00 AM - 6:00 PM',
                    'saturday' => '8:00 AM - 4:00 PM',
                    'sunday' => 'Closed'
                ],
                'manager_name' => 'Sarah Atuhaire',
                'manager_phone' => '+256 700 234 567',
                'description' => 'Western region branch office',
                'is_active' => true
            ],
            // M - MBALE
            [
                'name' => 'MOTORCARE MBALE - TOTAL MBALE',
                'type' => 'service_center',
                'address' => 'Mbale-Tororo Road, Total Fuel Station',
                'city' => 'Mbale',
                'region' => 'Eastern',
                'phone' => '+256 454 433 200',
                'email' => 'mbale@motorcareuganda.com',
                'latitude' => 1.082700,
                'longitude' => 34.175500,
                'services' => ['Service', 'Parts', 'Fuel'],
                'working_hours' => [
                    'monday_friday' => '8:00 AM - 6:00 PM',
                    'saturday' => '8:00 AM - 4:00 PM',
                    'sunday' => '9:00 AM - 2:00 PM'
                ],
                'manager_name' => 'Grace Namukose',
                'manager_phone' => '+256 700 567 890',
                'description' => 'Eastern region service center at Total station',
                'is_active' => true
            ]
        ];

        foreach ($offices as $office) {
            Office::create($office);
        }
    }
}
