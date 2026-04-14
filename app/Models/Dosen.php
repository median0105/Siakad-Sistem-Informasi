<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['nama', 'nidn', 'email'])]
class Dosen extends Model
{
    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class);
    }
}
