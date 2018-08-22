<?php namespace App;

use App\Http\Requests\CreateUrlRequest;
use Hashids\Hashids;
use Illuminate\Support\Collection;
use Jenssegers\Agent\Agent;

class UrlService
{
    private $agent;
    private $hashids;
    private $model;

    public function __construct(Agent $agent, Hashids $hashids, Url $model)
    {
        $this->agent = $agent;
        $this->hashids = $hashids;
        $this->model = $model;
    }

    public function getModel(): Url
    {
        return $this->model;
    }

    public function getLatest($number): Collection
    {
        return $this->model->limit(10)->get();
    }

    public function createFromRequest(CreateUrlRequest $request): bool
    {
        $created = $this->model->create([
            'short_url' => $this->makeShortUrlId(),
            'original_url' => $request->input('original_url'),
        ]);

        return (bool) $created;
    }

    public function trackClick(Url $url)
    {
        $url->clicks()->create([
            'browser' => $this->agent->browser(),
            'platform' => $this->agent->platform(),
        ]);

        $url->clicks_count++;

        $url->save();
    }

    private function makeShortUrlId()
    {
        $max_id = $this->model->max('id');

        return $this->hashids->encode($max_id + 1);
    }
}
