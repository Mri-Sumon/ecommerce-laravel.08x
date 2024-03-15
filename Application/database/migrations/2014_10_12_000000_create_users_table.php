<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phoneNumber')->nullable();
            $table->string('address')->nullable();
            $table->string('userType')->nullable();
            $table->string('status')->nullable();
            $table->string('sort')->nullable();
            $table->string('permissions')->nullable();
            $table->string('createdBy')->nullable();
            $table->string('updatedBy')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // insert some data during createting users table
        DB::table('users')->insert(
            array(
                'name' => 'Md. Rafiqul Islam',
                'email' => 'mrisumon121@gmail.com',
                'phoneNumber' => '01317404152',
                'userType' => 'developer',
                'status' => 'active',
                'sort' => '1',
                'permissions' => 'dashbaord,categories,products,orders,transactions,paymentsMethods,pages,posts,pos,settings,users',
                'createdBy' => 'developer',
                'password' => bcrypt('142793'),
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
