<?php

namespace App\Services\Parser;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPHtmlParser\Dom;

class ProductParserService
{
    public string $name;

    public Client $client;

    public function boot($name)
    {
        $this->client = new Client([
            'User-Agent' => "Mozilla/5.0 (Macintosh; Intel Mac OS X ".rand(9,11)."_".rand(10, 30)."_".rand(1,9).") AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5845." . rand(928, 2913) . " YaBrowser/23.9.0.0 Safari/537.36"
        ]);
        $this->name = $name;

        return $this->process();
    }

    /**
     * @throws GuzzleException
     */
    private function process()
    {
        $response = $this->client->get("https://n-katalog.ru/search?keyword={$this->name}")->getBody()->getContents();

//        $response = file_get_contents('test.html');

        $arr = [];

        $dom = new Dom;
        $dom->loadStr($response);

        $items = $dom->find('.list-item--goods');

        foreach ($items as $item) {
            $shops = $item->find('.model-shop-name .sn-div');
            $prices = $item->find('.model-shop-price a');
            $pricesArr = [];

            $count = 0;
            foreach ($shops as $shop) {
                $pricesArr[] = [html_entity_decode($shop->text), $prices[$count]->text];
                $count++;
            }

            $arr[$item->find('.model-short-title span')->text] = $pricesArr;
        }

        return response()->json($arr);
    }
}
