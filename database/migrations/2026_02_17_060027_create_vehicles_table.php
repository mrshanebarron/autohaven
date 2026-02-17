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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->decimal('price', 10, 2);
            $table->integer('mileage')->default(0);
            $table->string('exterior_color');
            $table->string('interior_color')->nullable();
            $table->string('vin', 17)->unique();
            $table->string('stock_number')->unique();
            $table->string('body_type'); // sedan, suv, truck, coupe, convertible, van
            $table->string('transmission'); // automatic, manual
            $table->string('fuel_type'); // gasoline, diesel, electric, hybrid
            $table->string('drivetrain'); // fwd, rwd, awd, 4wd
            $table->string('engine')->nullable();
            $table->integer('horsepower')->nullable();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->string('condition'); // new, used, certified
            $table->string('status')->default('available'); // available, pending, sold
            $table->boolean('featured')->default(false);
            $table->string('hero_image')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
