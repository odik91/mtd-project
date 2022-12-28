<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class HomeSlider extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasSEO;

    protected $guarded = [];
}
