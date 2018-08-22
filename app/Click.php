<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    protected $fillable = ['url_id', 'browser', 'platform'];

    public function url()
    {
        return $this->belongsTo(Url::class);
    }
}
