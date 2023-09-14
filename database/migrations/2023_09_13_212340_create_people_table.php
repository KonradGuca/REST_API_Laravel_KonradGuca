<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;
use App\Models\People;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('forename');
            $table->string('surname');
            $table->string('phone')->unique()->default('');
            $table->string('street')->default('');
            $table->string('city')->default('');
            $table->string('country')->default('');
            $table->string('email')->unique()->default('');
            $table->timestamp('email_verified_at')->default(now())->nullable();
            $table->string('password')->default('');
            $table->rememberToken();
            $table->timestamps();
        });

        $faker = FakerFactory::create();

        for ($i = 0; $i < 200; $i++) {
            $forename = $faker->firstName;
            $surname = $faker->lastName;
            $password = Str::random(10);

            People::create([
                'forename' => $forename,
                'surname' => $surname,
                'phone' => $faker->unique()->phoneNumber,
                'street' => $faker->streetAddress,
                'city' => $faker->city,
                'country' => $faker->country,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt($password),
                'remember_token' => Str::random(10),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
}