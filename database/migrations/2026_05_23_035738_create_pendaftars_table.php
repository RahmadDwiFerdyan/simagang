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
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lowongan')->constrained('lowongans')->cascadeOnDelete();
            $table->string('name');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('dob');
            $table->text('address');
            $table->string('no_telp');
            $table->string('university');
            $table->string('major');
            $table->decimal('ipk', 3, 2);
            $table->string('path_cv');
            $table->enum('status', ['P', 'A', 'R'])->default('P');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftars');
    }
};
