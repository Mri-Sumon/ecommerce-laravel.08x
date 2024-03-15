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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('websiteIcon', 500)->nullable();
            $table->string('websiteTitle', 256)->nullable();
            $table->string('marqueeText', 2000)->nullable();
            $table->string('headerFooterLogo', 500)->nullable();
            $table->string('companyName', 500)->nullable();
            $table->string('companyAddress', 1000)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('telephoneIcon', 500)->nullable();
            $table->string('fax', 20)->nullable();
            $table->string('faxIcon', 500)->nullable();
            $table->string('mobile', 11)->nullable();
            $table->string('mobileIcon', 500)->nullable();
            $table->string('email', 500)->nullable();
            $table->string('emailIcon', 500)->nullable();
            $table->string('facebook', 500)->nullable();
            $table->string('facebookIcon', 500)->nullable();
            $table->string('whatsapp', 500)->nullable();
            $table->string('whatsappIcon', 500)->nullable();
            $table->string('twitter', 500)->nullable();
            $table->string('twitterIcon', 500)->nullable();
            $table->string('instagram', 500)->nullable();
            $table->string('instagramIcon', 500)->nullable();
            $table->string('linkedin', 500)->nullable();
            $table->string('linkedinIcon', 500)->nullable();
            $table->string('googlePage', 500)->nullable();
            $table->string('googlePageIcon', 500)->nullable();
            $table->string('pinterest', 500)->nullable();
            $table->string('pinterestIcon', 500)->nullable();
            $table->string('googlemap', 1000)->nullable();
            $table->string('officeHours', 256)->nullable();
            $table->string('copyrightText', 256)->nullable();
            $table->string('createdBy', 256)->nullable();
            $table->string('updatedBy', 256)->nullable();
            $table->timestamps();
        });

        // insert some data during createting settings table  
        DB::table('settings')->insert(
            array(
                'websiteIcon' => 'websiteIcon',
                'websiteTitle' => 'websiteTitle',
                'marqueeText' => 'marqueeText',
                'headerFooterLogo' => 'headerFooterLogo',
                'companyName' => 'companyName',
                'companyAddress' => 'companyAddress',
                'telephone' => '123456789',
                'telephoneIcon' => 'telephoneIcon',
                'fax' => '123456789',
                'faxIcon' => 'faxIcon',
                'mobile' => '123456789',
                'mobileIcon' => 'mobileIcon',
                'email' => 'email',
                'emailIcon' => 'emailIcon',
                'facebook' => 'facebook',
                'facebookIcon' => 'facebookIcon',
                'whatsapp' => '123456789',
                'whatsappIcon' => 'whatsappIcon',
                'twitter' => 'twitter',
                'twitterIcon' => 'twitterIcon',
                'instagram' => 'instagram',
                'instagramIcon' => 'instagramIcon',
                'linkedin' => 'linkedin',
                'linkedinIcon' => 'linkedinIcon',
                'googlePage' => 'googlePage',
                'googlePageIcon' => 'googlePageIcon',
                'pinterest' => 'pinterest',
                'pinterestIcon' => 'pinterestIcon',
                'googlemap' => 'googlemap',
                'officeHours' => 'officeHours',
                'copyrightText' => 'copyrightText',
                'createdBy' => 'createdBy',
                'updatedBy' => 'updatedBy',
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
