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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('url')->unique();
            $table->string('description');
            $table->text('content');
            $table->integer('code')->comment('Vlastní kód produktu');
            $table->bigInteger('ean')->comment('EAN kód produktu')->nullable(true);
            $table->float('weight');
            $table->decimal('price', 8, 2);
            $table->integer('qty');
            $table->unsignedBigInteger('supplier_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
