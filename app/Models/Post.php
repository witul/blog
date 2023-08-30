<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        //@TODO move this code to separate event handling
        static::updating(function (Post $post) {
            if ($post->isDirty('thumbnail') && $post->getOriginal('thumbnail')) {
                Storage::disk('public')->delete($post->getOriginal('thumbnail'));
            }
        });

        static::saving(function (Post $post) {
            if ($post->isDirty('content')) {
                $post->excerpt = $post->prepareExcerpt();
            }
        });
    }

    protected $fillable = [
        'title',
        'content',
        'thumbnail'
    ];
    protected $casts = [
        'updated_at' => 'datetime:Y-m-d H:i',
        'created_at' => 'datetime:Y-m-d H:i'
    ];

    protected function prepareExcerpt($content = null, $length = 160)
    {
        return Str::limit($content ?? $this->attributes['content'], $length, '...');
    }
    protected function publishedAt(): Attribute
    {
        return Attribute::get(fn() => $this->attributes['updated_at']);
    }
}
