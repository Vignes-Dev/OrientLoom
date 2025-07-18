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
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            
            // Manually define notifiable_type with a length limit of 191 characters
            $table->string('notifiable_type', 191); // Limit notifiable_type to 191 characters
            $table->unsignedBigInteger('notifiable_id');
            
            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            
            // Create the composite index on notifiable_type and notifiable_id
            $table->index(['notifiable_type', 'notifiable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
