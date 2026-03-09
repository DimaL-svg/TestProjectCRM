<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $Customers = Customer::factory(10)->create();
        Ticket::factory(20)->recycle($Customers)->create();
        User::factory(5)->create();
    }
}
