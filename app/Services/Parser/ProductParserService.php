<?php

namespace App\Services\Parser;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;
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
        #N-KATALOG
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

        #X_COM
        $shop = 'xcom-shop.ru';
        $search=$this->name;
        $xmlString = file_get_contents(('yaml/market_all.xml'));
        $xmlObject = simplexml_load_string($xmlString);

        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);
        $phpArray=$phpArray['shop']['offers']['offer'];

        foreach ($phpArray as $result)
        {
            $pricesArr = [];
            if(preg_match('*'.$search.'*', $result['name']))
            {
                $pricesArr[]=[$shop, $result['price'].' руб.'];
                $arr[] = [
                    'img' => $result['picture'],
                    'title' => $result['name'],
                    'prices' => $pricesArr
                ];
            }

        }
        return response()->json($arr);
    }
}
