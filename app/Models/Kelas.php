<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'mata_kuliah_id',
    'dosen_id',
    'kode_kelas',
    'hari',
    'jam_mulai',
    'jam_selesai',
    'ruangan',
    'kuota',
])]
class Kelas extends Model
{
    protected $table = 'kelas';

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class);
    }

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'enrollments')->withTimestamps();
    }
}
