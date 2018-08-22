<?php namespace App\Http\Controllers;

use App\Url;
use App\UrlService;
use App\Http\Requests\CreateUrlRequest;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    private $urls;

    public function __construct(UrlService $urls)
    {
        $this->urls = $urls;
    }

    public function index(Request $request)
    {
        return view('user.index')
            ->with('url', $this->urls->getModel())
            ->with('latest_urls', $this->urls->getLatest(10));
    }

    public function create(CreateUrlRequest $request)
    {
        if (! $this->urls->createFromRequest($request)) {
            // TODO: Get a MessageBag from the urls service
            return redirect('/')->withError('Unable to create URL');
        }

        return redirect('/')->with(['notice' => 'Successfully added a URL']);
    }

    public function visit(Url $url)
    {
        $this->urls->trackClick($url);

        return redirect($url->original_url);
    }

    public function show()
    {
        $url = new Url(['short_url' =>  '1ry23', 'original_url' =>  'http://google.com', 'created_at' => date("Y-m-d H:i:s"), 'clicks_count' => 0]);

        # implement queries
        $daily_clicks = [
            ['1', 13],
            ['2', 2],
            ['3', 1],
            ['4', 7],
            ['5', 20],
            ['6', 18],
            ['7', 10],
            ['8', 20],
            ['9', 15],
            ['10', 5]
        ];
        $browsers_clicks = [
            ['IE', 13],
            ['Firefox', 22],
            ['Chrome', 17],
            ['Safari', 7]
        ];
        $platform_clicks = [
            ['Windows', 13],
            ['macOS', 22],
            ['Ubuntu', 17],
            ['Other', 7]
        ];

        return view('user.show', ['url' =>$url, 'browsers_clicks' => $browsers_clicks, 'daily_clicks' => $daily_clicks, 'platform_clicks' => $platform_clicks]);
    }
}
