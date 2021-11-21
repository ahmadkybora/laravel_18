<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile')->unique();
            $table->string('home_phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->text('work_address')->nullable();
            $table->text('home_address')->nullable();
            $table->string('image')->nullable();
            $table->json('information')->nullable();
            $table->enum('status', ['ACTIVE', 'DEACTIVE', 'SUSPENDED', 'PENDING'])->default('ACTIVE');
            $table->rememberToken();
            $table->timestamps();
        });

        $user = new User();
        $user->first_name = 'admin';
        $user->last_name = 'admin';
        $user->username = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('12345678');
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
