<?php

namespace App\Services\Parser;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPHtmlParser\Dom;

class ProductParserServiceCopy
{
    public string $name;

    public Client $client;

    public function boot($name)
    {
        $this->client = new Client([
            'User-Agent' => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.5845.2319 YaBrowser/23.9.0.0 Safari/537.36",
            'referer' => true,
            'headers' => [
                'User-Agent' => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.5845.2319 YaBrowser/23.9.0.0 Safari/537.36",
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Encoding' => 'gzip, deflate, br',
            ],
        ]);
        $this->name = $name;

        return $this->process();
    }

    /**
     * @throws GuzzleException
     */
    private function process()
    {
        $response = $this->client->get("https://n-katalog.ru/search?keyword={$this->name}");

        if ($response->getStatusCode() != 403) {
            $response = $response->getBody()->getContents();
        } else {
            $response = file_get_contents("https://n-katalog.ru/search?keyword={$this->name}");
        }

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
                $pricesArr[] = [str_replace(' ', '', html_entity_decode(str_replace('&nbsp;','', $shop->text))), $prices[$count]->text];
                $count++;
            }

            if (count($shops) > 0) {
                $arr[] = [
                    'img' => $item->find('.list-img img')->getAttribute('src'),
                    'title' => $item->find('.model-short-title span')->text,
                    'prices' => $pricesArr
                ];
            }
        }

        return response()->json($arr);
    }
}
