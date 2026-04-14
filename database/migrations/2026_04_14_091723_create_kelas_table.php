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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mata_kuliah_id')->constrained()->cascadeOnDelete();
            $table->foreignId('dosen_id')->nullable()->constrained('dosens')->nullOnDelete();
            $table->string('kode_kelas'); // contoh: A, B, 01
            $table->string('hari')->nullable(); // contoh: Senin
            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->string('ruangan')->nullable();
            $table->unsignedInteger('kuota')->default(0);
            $table->timestamps();

            $table->unique(['mata_kuliah_id', 'kode_kelas']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
