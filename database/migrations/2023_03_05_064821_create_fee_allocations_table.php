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
        Schema::create('fee_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('fee_title');
            $table->string('allocated_type');
            $table->foreignId('fee_group_id')->constrained('fee_groups')->onDelete('cascade');
            $table->foreignId('fee_type_id')->constrained('fee_types')->onDelete('cascade');
            $table->boolean('is_all_student')->default(false);
            $table->integer('allocated_class_id')->nullable();
            $table->integer('allocated_group_id')->nullable();
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('fee_allocations');
    }
};
