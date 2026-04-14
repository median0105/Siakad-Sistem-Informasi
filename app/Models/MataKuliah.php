<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['kode', 'nama', 'sks'])]
class MataKuliah extends Model
{
    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }
}
