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
        Schema::create('admissionforms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('birth_certificate_no');
            $table->string('email')->nullable();
            $table->date('birth_date');
            $table->string('nationality');
            $table->string('religion');
            $table->string('gender');
            $table->string('prvSchool');
            $table->string('previousRoll');
            $table->string('blood_group')->nullable();
            $table->string('fName');
            $table->string('fNid');
            $table->string('fOccupation');
            $table->string('fIncome');
            $table->string('fMail')->nullable();
            $table->string('fNumber');
            $table->string('mName');
            $table->string('mNid');
            $table->string('mOccupation');
            $table->string('mIncome');
            $table->string('mMail')->nullable();
            $table->string('mNumber')->nullable();
            $table->string('present_address');
            $table->string('post_code');
            $table->string('district');
            $table->string('upazila');
            $table->string('permanent_address');
            $table->string('parmanent_post_code');
            $table->string('parmanent_district');
            $table->string('parmanent_upazila');
            $table->string('addmission_class');
            $table->string('payment_method');
            $table->string('qouta')->nullable();
            $table->string('photo')->nullable();
            $table->string('amount')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('status')->nullable();
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('admissionforms');
    }
};
