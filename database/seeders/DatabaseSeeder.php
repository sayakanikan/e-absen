<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'kelas_id'  => 1,
            'qr_id'     => 1,
            'name'      => 'Windah Basudara',
            'nis'       => '33740112012321',
            'email'     => 'wbasura@gmail.com',
            'gender'    => 'L',
            'lahir_ayah'=> '1971-01-03',
            'lahir_ibu' => '1969-12-22',
            'role_id'   => 0,
            'password'  => Hash::make('password'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('kelas')->insert([
            'kelas'     => '9A',
            'jml_siswa' => 24,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('admins')->insert([
            'kelas_id'  => 1,
            'name'      => 'Ilham God',
            'nip'       => '33741002100129293',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('password'),
            'foto'     => 'guru1.png',
            'role_id'   => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('super_admins')->insert([
            'name'      => 'Ilham God',
            'nip'       => '33741002100129293',
            'email'     => 'super@gmail.com',
            'password'  => Hash::make('password'),
            'role_id'   => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('absens')->insert([
            'user_id'   => 1,
            'qr_id'     => 1,
            'kelas_id'  => 1,
            'admin_id'  => 1,
            'status'    => 'Tepat Waktu',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('qrs')->insert([
            'token'     => \Illuminate\Support\Str::random(12),
            'barcode'   => 'storage/barcode/qr.png',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
