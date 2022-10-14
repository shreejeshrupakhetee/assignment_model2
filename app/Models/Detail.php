<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $table='details';
    protected $fillable=['title',  'description','post_id'];


    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
