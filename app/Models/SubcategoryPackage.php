<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class SubcategoryPackage extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];

    public function getSubcategory() {
        return $this->hasOne(Subcategory::class, 'id', 'subcategory_id');
    }
}
