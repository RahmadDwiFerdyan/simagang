<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Departemen;
use Illuminate\Database\Seeder;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $departemen=[
            'Accounting',
            'Business Development',
            'Engineering',
            'Human Resources',
            'Legal',
            'Marketing',
            'Product Management',
            'Sales',
            'Training',
        ];
    
        foreach ($departemen as $dept){
            Departemen::create(['name' => $dept]);
        }

    }
}
