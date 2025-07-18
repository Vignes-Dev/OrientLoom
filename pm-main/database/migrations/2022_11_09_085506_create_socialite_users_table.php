<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DutchCodingCompany\FilamentSocialite\Facades\FilamentSocialite;

return new class extends Migration {
    public function up()
    {
        Schema::create('socialite_users', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(FilamentSocialite::getUserModelClass(), 'user_id');
            
            // Change character set to utf8 and allow 255 characters
            $table->string('provider', 255)->charset('utf8')->collation('utf8_unicode_ci');
            $table->string('provider_id', 255)->charset('utf8')->collation('utf8_unicode_ci');

            $table->timestamps();

            // Create a unique index on provider and provider_id
            $table->unique(['provider', 'provider_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('socialite_users');
    }
};
