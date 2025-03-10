<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Status extends Model
{

    use HasTranslations;

    protected $translatable = [
        'name'
    ];

    protected $guarded = [];


   public function applications(): HasMany
   {
       return $this->hasMany(Application::class);
   }
}
