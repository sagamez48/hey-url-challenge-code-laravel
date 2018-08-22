<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\CreateUrlRequest;

class Url extends Model
{
    protected $fillable = ['short_url', 'original_url', 'clicks_count'];

    public $timestamps = true;

    public static function makeId()
    {
        return str_random(5);
    }
}
