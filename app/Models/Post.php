<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
class Post extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ["title", "type", "slug", "content", "published_at"];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        "published_at" => "date",
    ];

    protected $appends = ["link"];

    public function scopePublished(Builder $query)
    {
        return $query->whereNotNull("published_at");
    }

    public function scopeIsPage(Builder $query)
    {
        return $query->where("type", "page");
    }
    public function scopeIsPost(Builder $query)
    {
        return $query->where("type", "post");
    }

    public function scopeDraft(Builder $query)
    {
        return $query->whereNull("published_at");
    }

    public function getLinkAttribute()
    {
        return url($this->slug);
    }

    public function taxos(): MorphToMany
    {
        return $this->morphToMany(
            Term::class,
            "model",
            "model_terms",
            "model_id",
            "term_id"
        );
    }
}
