<?php

namespace App\Services\Parser;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
use PHPHtmlParser\Dom;

class ConstructorParserService
{
    public string $href;
    public string $product;
    public string $img;
    public string $price;
    public string $title;

    public Client $client;

    public function boot($href, $product, $img, $price, $title)
    {
        $this->href = $href;
        $this->product = $product;
        $this->img = $img;
        $this->price = $price;
        $this->title = $title;

        $this->client = new Client([
            'User-Agent' => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.5845.2319 YaBrowser/23.9.0.0 Safari/537.36",
            'referer' => true,
            'headers' => [
                'User-Agent' => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.5845.2319 YaBrowser/23.9.0.0 Safari/537.36",
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Encoding' => 'gzip, deflate, br',
            ],
        ]);

        return $this->process();
    }

    /**
     * @throws GuzzleException
     */

    private function process()
    {
        #USLUGIO

        $url="{$this->href}";

        $response = $this->client->get($url);

        if ($response->getStatusCode() != 403) {
            $response = $response->getBody()->getContents();
        } else {
            $response = file_get_contents($url);
        }

        $dom = new Dom;
        $dom->loadStr($response);

        $items = $dom->find(".{$this->product}");

        foreach ($items as $item) {
            $shop = "{$this->href}";
            $prices = $item->find(".{$this->price}");
            $subtitiles = $item->find(".{$this->title}");
            $pricesArr = [];

            $count = 0;
            foreach ($prices as $price)
            {
                $pricesArr[] = [$shop.': '.html_entity_decode(str_replace('&nbsp;','', $subtitiles[$count]->text)), $prices->text];
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
