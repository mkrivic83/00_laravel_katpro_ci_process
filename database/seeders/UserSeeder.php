<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PHPUnit\Framework\Constraint\IsFalse;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name'=>'Administrator',
                'email'=>'admin@tester.com',
                'password'=>Hash::make('admin1234'),
                'isAdmin'=>true,
                'datum_rod'=>'1980-01-15',
                'placa'=>3500
            ]
        );

        User::create(
            [
                'name'=>'Pero Perić',
                'email'=>'pero@tester.com',
                'password'=>Hash::make('pero1234'),
                'isAdmin'=>false,
                'datum_rod'=>'1990-03-22',
                'placa'=>1900
            ]
        );

        User::create(
            [
                'name'=>'Ivana Ivić',
                'email'=>'ivana@tester.com',
                'password'=>Hash::make('ivana1234'),
                'isAdmin'=>false,
                'datum_rod'=>'1995-10-19',
                'placa'=>2100
            ]
        );

        User::create(
            [
                'name'=>'Luka Modrić',
                'email'=>'luka@tester.com',
                'password'=>Hash::make('luka1234'),
                'isAdmin'=>false,
                'datum_rod'=>'1994-10-19',
                'placa'=>2650
            ]
        );

        User::create(
            [
                'name'=>'Joško Gvariol',
                'email'=>'josko@tester.com',
                'password'=>Hash::make('josko1234'),
                'isAdmin'=>false,
                'datum_rod'=>'1997-12-22',
                'placa'=>3650
            ]
        );
    }
}
