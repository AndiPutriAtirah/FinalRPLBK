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
        Schema::disableForeignKeyConstraints();

        Schema::create('nilai_rekaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('users,ids');
            $table->foreignId('mapel_id')->constrained('mapel,ids');
            $table->decimal('nilai_akhir', 5, 2);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_rekaps');
    }
};
