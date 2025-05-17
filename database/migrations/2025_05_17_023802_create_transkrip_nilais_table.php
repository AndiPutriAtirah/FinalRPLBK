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

        Schema::create('transkrip_nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('users,ids');
            $table->decimal('total_nilai', 5, 2);
            $table->string('keterangan', 100);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transkrip_nilais');
    }
};
