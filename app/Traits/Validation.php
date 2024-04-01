<?php

namespace App\Traits;

use App\Models\Url;
use GuzzleHttp\Client;

trait Validation
{
    public static function validateUrl($data)
    {
        if (!$data) {
            return [
                'type' => null,
                'error' => 'Please insert a URL, or the absolut path of a folder.'
            ];
        }

        $url = Url::where('url', $data)->first();

        if ($url) {
            return [
                'code' => $url->code,
                'type' => $url->type,
                'error' => null
            ];
        }

        $absolutPathPattern = "/^[a-zA-Z]:\\\\/";

        if (preg_match($absolutPathPattern, $data)) {
            return [
                'type' => 'path',
                'error' => null
            ];
        }

        $urlPattern = "#^(http|https|ftp):\/\/#";

        if (!preg_match($urlPattern, $data)) {
            return [
                'type' => 'url',
                'error' => 'The URL it\'s not valid.'
            ];
        }

        $response = static::validateWithSafeBrowsingApi($data);

        return $response;
    }

    private static function validateWithSafeBrowsingApi($url)
    {
        $endpoint = 'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . env('GOOGLE_SAFE_BROWSING_API_KEY');

        $payload = [
            'client' => [
                'clientId' => env('GOOGLE_SAFE_BROWSING_CLIENT_ID'),
                'clientVersion' => '1.5.2'
            ],
            'threatInfo' => [
                'threatTypes' => ['MALWARE', 'SOCIAL_ENGINEERING', 'THREAT_TYPE_UNSPECIFIED', 'UNWANTED_SOFTWARE', 'POTENTIALLY_HARMFUL_APPLICATION'],
                'platformTypes' => ['WINDOWS'],
                'threatEntryTypes' => ['URL'],
                'threatEntries' => [['url' => $url]]
            ]
        ];

        $client = new Client();

        $response = $client->post($endpoint, [
            'json' => $payload,
            'headers' => [
                'Content-Type' => 'application/json'
            ]
        ]);

        $response = json_decode($response->getBody(), true);

        if (empty($response)) {
            return [
                'type' => 'url',
                'error' => null
            ];
        } else {
            return [
                'type' => 'url',
                'error' => 'The URL it\'s not safe.'
            ];
        }
    }
}
