<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            
            // Use the morphs method but change the tokenable_type column length to 191 characters
            $table->string('tokenable_type', 191); // Limit the tokenable_type length to 191 characters
            $table->unsignedBigInteger('tokenable_id');
            
            // Create the index for the polymorphic relation
            $table->index(['tokenable_type', 'tokenable_id']); // Create the composite index

            $table->string('name');
            $table->string('token', 191)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
