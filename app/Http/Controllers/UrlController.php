<?php namespace App\Http\Controllers;
use App\Url;
use App\Click;
use App\Http\Requests\CreateUrlRequest;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class UrlController extends Controller
{
    public function index(Request $request)
    {
        $url = new Url();
        $urls = Url::limit(10)->get();

        return view('user.index', compact('url', 'urls'));
    }

    public function create(CreateUrlRequest $request)
    {
        $url = Url::create([
            'short_url' => Url::makeId(),
            'original_url' => $request->input('original_url'),
        ]);

        if (! $url) {
            return redirect('/')
                ->withError('Unable to create URL');
        }

        return redirect('/')->with(['notice' => 'Successfully added a URL']);
    }

    public function visit(Url $url)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $platform = $agent->platform();

        $url->clicks_count++;

        Click::create([
            'url_id' => $url->id,
            'browser' => $browser,
            'platform' => $platform,
        ]);

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
