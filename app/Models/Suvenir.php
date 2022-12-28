<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Suvenir extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasSEO;

    protected $guarded = [];

    public function getCategorySuvenir()
    {
        return $this->hasOne(SuvenirCategory::class, 'id', 'suvenir_category_id');
    }
}
