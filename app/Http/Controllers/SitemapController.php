<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SitemapController
{
    // sitemap-indexを出力する
    public function index()
    {
        $sitemap = App::make("sitemap");

        // キャッシュの設定。単位は分
        $sitemap->setCache('laravel.sitemap-index', 3600);

        if (!$sitemap->isCached()) {
            // sitemapのURLを追加
            $sitemap->addSitemap(URL::route('sitemap-basics'));
            // sitemapを増やす場合はココに追記していく。
        }

        // XML形式で出力
        return $sitemap->render('sitemapindex');
    }

    // sitemapを出力する
    public function basics()
    {
        $sitemap = App::make("sitemap");

        // キャッシュの設定。単位は分
        $sitemap->setCache('laravel.sitemap-basics', 3600);

        if (!$sitemap->isCached()) {
            // ページ１のURLを追加
            $sitemap->add(
                route('your-route-name1'),
                Carbon::now(),
                1.0,
                'weekly'
            );

            // ページ２のURLを追加
            $sitemap->add(
                route('your-route-name2'),
                Carbon::now(),
                1.0,
                'weekly'
            );

            // 必要に応じて上記をコピペする
        }

        // XML形式で出力
        return $sitemap->render('xml');
    }
}