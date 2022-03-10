<?php

namespace App\Models;

use App\Traits\HasImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model {

    use HasFactory, HasImages;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'status',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function isActive(): Attribute {
        return new Attribute(get: fn() => $this->status == 'published');
    }


}
