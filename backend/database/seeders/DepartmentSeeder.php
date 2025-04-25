<?php
namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['name' => 'Computer Science and Engineering'],
            ['name' => 'Electrical Engineering'],
            ['name' => 'Electronics and Communication Engineering'],
            ['name' => 'Mechanical Engineering'],
            ['name' => 'Civil Engineering'],
            ['name' => 'Chemical Engineering'],
            ['name' => 'Aerospace Engineering'],
            ['name' => 'Biomedical Engineering'],
            ['name' => 'Information Technology'],
            ['name' => 'Robotics and Automation'],
        ];

        foreach ($departments as $department) {
            Department::updateOrCreate(
                ['name' => $department['name']],
                ['name' => $department['name']]
            );
        }
    }
}
