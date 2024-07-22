<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    protected static ?string $password;

    // Daftar nama-nama Indonesia
    protected $indonesianNames = [
        'Budi', 'Ani', 'Joko', 'Siti', 'Agus', 'Rini', 'Andi', 'Sinta', 'Eko', 'Rina', 'Dodi', 'Maya', 'Dewi', 'Hadi', 'Lina'
        // Tambahkan nama-nama lain sesuai kebutuhan Anda
    ];

    protected $indonesiaEmail = [
        'budi@gmail.com',
        'ani@gmail.com',
        'joko@gmail.com',
        'siti@gmail.com',
        'agus@gmail.com',
        'rini@gmail.com',
        'andi@gmail.com',
        'sinta@gmail.com',
        'eko@gmail.com',
        'rina@gmail.com',
        'dodi@gmail.com',
        'maya@gmail.com',
        'dewi@gmail.com',
        'hadi@gmail.com',
        'lina@gmail.com',
    ];

    public function definition()
    {
        $name = $this->faker->randomElement($this->indonesianNames);

        $email = $this->faker->unique()->randomElement($this->indonesiaEmail);

        return [
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
