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
        $offices = [
            [
                'name' => 'MOTORCARE UGANDA LIMITED',
                'type' => 'branch',
                'address' => 'Kitgum House, Jinja Road',
                'city' => 'Kampala',
                'region' => 'Central',
                'phone' => '+256 414 237 000',
                'email' => 'info@motorcareuganda.com',
                'latitude' => 0.3476,
                'longitude' => 32.6131,
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
            [
                'name' => 'MOTORCARE UGANDA HOIMA',
                'type' => 'branch',
                'address' => 'Hoima Road, Near Bank of Uganda',
                'city' => 'Hoima',
                'region' => 'Western',
                'phone' => '+256 465 440 123',
                'email' => 'hoima@motorcareuganda.com',
                'latitude' => 1.4331,
                'longitude' => 31.3524,
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
            [
                'name' => 'MOTORCARE UGANDA MASAKA',
                'type' => 'branch',
                'address' => 'Masaka-Kampala Road, Commercial Area',
                'city' => 'Masaka',
                'region' => 'Central',
                'phone' => '+256 481 420 789',
                'email' => 'masaka@motorcareuganda.com',
                'latitude' => -0.3476,
                'longitude' => 31.7414,
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
            [
                'name' => 'MOTORCARE UGANDA GULU/MAKO WAREHOUSING',
                'type' => 'service_center',
                'address' => 'Gulu Industrial Area, Warehouse Complex',
                'city' => 'Gulu',
                'region' => 'Northern',
                'phone' => '+256 471 432 100',
                'email' => 'gulu@motorcareuganda.com',
                'latitude' => 2.7796,
                'longitude' => 32.2990,
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
            [
                'name' => 'MOTORCARE MBALE - TOTAL KAMPALA',
                'type' => 'service_center',
                'address' => 'Mbale-Tororo Road, Total Fuel Station',
                'city' => 'Mbale',
                'region' => 'Eastern',
                'phone' => '+256 454 433 200',
                'email' => 'mbale@motorcareuganda.com',
                'latitude' => 1.0827,
                'longitude' => 34.1777,
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
            ],
            [
                'name' => 'MOTORCARE LIRA - TOTAL LIRA',
                'type' => 'service_center',
                'address' => 'Lira Main Street, Total Fuel Station',
                'city' => 'Lira',
                'region' => 'Northern',
                'phone' => '+256 473 420 300',
                'email' => 'lira@motorcareuganda.com',
                'latitude' => 2.2499,
                'longitude' => 32.8998,
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
            [
                'name' => 'MOTORCARE FORT PORTAL - TOTAL KASESE',
                'type' => 'service_center',
                'address' => 'Fort Portal-Kasese Road, Total Fuel Station',
                'city' => 'Fort Portal',
                'region' => 'Western',
                'phone' => '+256 483 422 400',
                'email' => 'fortportal@motorcareuganda.com',
                'latitude' => 0.6714,
                'longitude' => 30.2748,
                'services' => ['Service', 'Parts', 'Fuel'],
                'working_hours' => [
                    'monday_friday' => '8:00 AM - 6:00 PM',
                    'saturday' => '8:00 AM - 4:00 PM',
                    'sunday' => '9:00 AM - 2:00 PM'
                ],
                'manager_name' => 'Rebecca Kyomuhendo',
                'manager_phone' => '+256 700 789 012',
                'description' => 'Western region service center at Total station',
                'is_active' => true
            ],
            [
                'name' => 'MOTORCARE ARUA - TOTAL ARUA NILE',
                'type' => 'service_center',
                'address' => 'Arua-Nebbi Road, Total Fuel Station',
                'city' => 'Arua',
                'region' => 'West Nile',
                'phone' => '+256 476 420 500',
                'email' => 'arua@motorcareuganda.com',
                'latitude' => 3.0197,
                'longitude' => 30.9107,
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
            [
                'name' => 'MOTORCARE MOROTO - NETGAS ENERGY',
                'type' => 'parts_center',
                'address' => 'Moroto Town Center, Netgas Energy Station',
                'city' => 'Moroto',
                'region' => 'Karamoja',
                'phone' => '+256 454 661 600',
                'email' => 'moroto@motorcareuganda.com',
                'latitude' => 2.5350,
                'longitude' => 34.6667,
                'services' => ['Parts', 'Basic Service'],
                'working_hours' => [
                    'monday_friday' => '8:00 AM - 5:00 PM',
                    'saturday' => '8:00 AM - 3:00 PM',
                    'sunday' => 'Closed'
                ],
                'manager_name' => 'Joseph Lokwang',
                'manager_phone' => '+256 700 901 234',
                'description' => 'Karamoja region parts center',
                'is_active' => true
            ]
        ];

        foreach ($offices as $office) {
            Office::create($office);
        }
    }
}
