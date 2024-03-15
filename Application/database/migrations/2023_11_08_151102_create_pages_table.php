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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('pageName', 256)->nullable();
            $table->string('pageTitle', 500)->nullable();
            $table->string('slug', 256)->nullable();
            $table->string('pageLinks', 256)->nullable();
            $table->string('parentPage', 256)->nullable();
            $table->longText('pageBody')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('sorts', 50)->nullable();
            $table->string('createBy', 50)->nullable();
            $table->string('updatedBy', 50)->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        // insert some data during createting pages table  
        DB::table('pages')->insert(
            array(
                'pageName' => 'Home',
                'pageTitle' => 'Home',
                'slug' => 'home',
                'pageLinks' => '',
                'parentPage' => '0',
                'pageBody' => 'Updating........................',
                'status' => 'active',
                'sorts' => '1',
            ),
        );

        DB::table('pages')->insert(
            array(
                'pageName' => 'Pages',
                'pageTitle' => 'Pages',
                'slug' => 'pages',
                'pageLinks' => '',
                'parentPage' => '0',
                'pageBody' => 'Updating........................',
                'status' => 'active',
                'sorts' => '2',
            ),
        );

        DB::table('pages')->insert(
            array(
                'pageName' => 'Gallery',
                'pageTitle' => 'Gallery',
                'slug' => 'gallery',
                'pageLinks' => '',
                'parentPage' => '0',
                'pageBody' => 'Updating........................',
                'status' => 'active',
                'sorts' => '3',
            ),
        );

        DB::table('pages')->insert(
            array(
                'pageName' => 'Contact Us',
                'pageTitle' => 'Contact Us',
                'slug' => 'contact_us',
                'pageLinks' => '',
                'parentPage' => '0',
                'pageBody' => 'Updating........................',
                'status' => 'active',
                'sorts' => '4',
            ),
        );

        DB::table('pages')->insert(
            array(
                'pageName' => 'About Us',
                'pageTitle' => 'About Us',
                'slug' => 'about_us',
                'pageLinks' => '',
                'parentPage' => '0',
                'pageBody' => 'Updating........................',
                'status' => 'active',
                'sorts' => '5',
            ),
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
