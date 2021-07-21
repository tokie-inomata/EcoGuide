<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SitemapCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'batch:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'サイトマップの定期作成';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
                //保存先
                $file = resource_path('views/sitemap.xml');
                //初期化
                $start_content = '<?xml version="1.0" encoding="UTF-8"?>'
                .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
                \File::put($file,$start_content);

                $content = "<url>
                    <loc>".route('home')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);

                /*$content = "<url>
                    <loc>".route('pass.edit')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);*/
                $content = "<url>
                    <loc>".route('password.update')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('pass.forget')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('pass.reset')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);

                $content = "<url>
                    <loc>".route('user.page')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('user.add')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('user.create')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('user_login')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('user_signin')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('user_logout')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('user.edit')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('user.update')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);

                $content = "<url>
                    <loc>".route('search')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);

                $content = "<url>
                    <loc>".route('spot.index')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('spot.add')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('spot.create')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('spot.edit')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('spot.update')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('spot.show')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);

                $content = "<url>
                <loc>".route('admin.user.index')."</loc>
                <lastmod>2021-06-02</lastmod>
                </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('admin.spot.index')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('admin.user.edit')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('blacklist')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('item.add')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);
                $content = "<url>
                    <loc>".route('item.create')."</loc>
                    <lastmod>2021-06-02</lastmod>
                    </url>";
                \File::append($file,$content);

                //最後閉じタグが必要
                $end_content = '</urlset>';
                \File::append($file,$end_content);

                //本番環境のときは、Googleにピンを送る
                if(config('app.env') == 'production'){
                    'https://www.google.com/ping?sitemap=https://xxxxxxxxxxx.jp/sitemap.xml';
                }
    }
}
