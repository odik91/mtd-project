<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class ElevatorPitch extends Model
{
    use HasFactory, SoftDeletes, Notifiable, HasSEO;

    protected $guarded = [];

    public function getDynamicSEOData(): SEOData

    {        // Override only the properties you want:

        return new SEOData(

            title: $this->title,

            description: $this->excerpt,

        );

    }
}
