<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Document extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $table = 'documents';

    protected $fillable = [
        'name',
        'description'
    ];

    protected $appends = [
        'document_file',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function getDocumentFileAttribute()
    {
        return $this->getMedia('document_file')->last();
    }
}
