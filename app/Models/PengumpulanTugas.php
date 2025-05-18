<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengumpulanTugas extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'file_url',
        'isi_tugas_editor',
        'nilai',
        'komentar',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'tugas_id' => 'integer',
            'siswa_id' => 'integer',
            'nilai' => 'decimal:2',
        ];
    }

    public function tugas(): BelongsTo
    {
        return $this->belongsTo(Tugas::class, 'tugas_id'); // Benerin key foreignnya
    }


    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    // Di Model PengumpulanTugas.php
    protected static function booted()
    {
        static::saved(function ($pengumpulanTugas) {
            $siswaId = $pengumpulanTugas->siswa_id;
            $mapelId = $pengumpulanTugas->tugas->materi->mapel_id;

            // Hitung rata-rata nilai untuk siswa dan mapel ini
            $avgNilai = PengumpulanTugas::whereHas('tugas.materi', function($q) use ($mapelId) {
                $q->where('mapel_id', $mapelId);
            })->where('siswa_id', $siswaId)
            ->whereNotNull('nilai')
            ->avg('nilai');

            // Simpan atau update ke rekap nilai
            \App\Models\NilaiRekap::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'mapel_id' => $mapelId,
                ],
                [
                    'nilai_akhir' => $avgNilai,
                ]
            );
        });
    }

}
