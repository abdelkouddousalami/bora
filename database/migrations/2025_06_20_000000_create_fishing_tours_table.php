<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fishing_tours', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('category'); // 'fishing' or 'excursion'
            $table->string('duration')->nullable();
            $table->string('capacity')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('price_type')->nullable(); // 'per_person' or 'total'
            $table->string('image')->nullable();
            $table->json('features')->nullable(); // Store additional features
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fishing_tours');
    }
};
