<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model {

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'path',
        'user_id',
        'imageable_type',
        'imageable_id',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $appends = [
        'url',
    ];

    /**
     * Define a relation that use multiple image...
     *
     * @param string $type You need to pass an argument
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable(string $type): \Illuminate\Database\Eloquent\Relations\MorphTo {
        return $this->morphTo('imageable');
    }

    public function getUrlAttribute() {
        return url(Str::replace('public', 'storage', $this->path));
    }


}
