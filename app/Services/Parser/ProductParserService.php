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
        $url="https://n-katalog.ru/search?keyword={$this->name}";
        $response = $this->client->get($url);

        if ($response->getStatusCode() != 403) {
            $response = $response->getBody()->getContents();
        } else {
            $response = file_get_contents($url);
        }

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
                    'img' => 'https://n-katalog.ru'.$item->find('.list-img img')->getAttribute('src'),
                    'title' => $item->find('.model-short-title span')->text,
                    'prices' => $pricesArr
                ];
            }
        }

        //

        $url="https://uslugio.com/krasnodar?search={$this->name}";

        $response = $this->client->get($url);

        if ($response->getStatusCode() != 403) {
            $response = $response->getBody()->getContents();
        } else {
            $response = file_get_contents($url);
        }

        $dom = new Dom;
        $dom->loadStr($response);

        $items = $dom->find('.items_n');

        foreach ($items as $item) {
            $shop = 'uslugio.com';
            $prices = $item->find('.price_td');
            $subtitiles = $item->find('.table-price span');
            $pricesArr = [];

            $count = 0;
            foreach ($prices as $price)
            {
                $pricesArr[] = [html_entity_decode(str_replace('&nbsp;','', $subtitiles[$count]->text)), $prices->text];
                $count++;
            }

            if (count($prices) > 0)
            {
                $arr[] = [
                    'img' => $item->find('.showone')->getAttribute('src'),
                    'title' => $item->find('.title')->text,
                    'prices' => $pricesArr
                ];
            }


        }

        return response()->json($arr);
    }
}
