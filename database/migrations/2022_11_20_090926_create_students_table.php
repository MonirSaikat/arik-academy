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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_unique_id')->unique();
            $table->string('roll_number');
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('parent_phone')->unique();
            $table->string('student_phone');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('group_id')->nullable()->constrained('groups')->onDelete('cascade');
            $table->foreignId('session_id')->constrained('sessions')->onDelete('cascade');
            $table->foreignId('section_id')->nullable()->constrained('sections')->onDelete('cascade');
            $table->foreignId('gender')->constrained('genders')->onDelete('cascade');
            $table->foreignId('religion')->constrained('religions')->onDelete('cascade');
            $table->string('blood_group')->nullable();
            $table->date('date_of_birth');
            $table->string('birth_certificate_number')->unique();
            $table->string('photo')->nullable();
            $table->string('village');
            $table->string('post');
            $table->string('upozila');
            $table->string('district');
            $table->string('parmanent_village')->nullable();
            $table->string('parmanent_post')->nullable();
            $table->string('parmanent_upozila')->nullable();
            $table->string('parmanent_district')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('students');
    }
};
