<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Traits\Validation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    use Validation;

    public function store(Request $request)
    {
        $validation = Validation::validateUrl($request->url);

        if ($validation['error']) {
            return response($validation['error'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (array_key_exists('code', $validation)) {
            return response(['code' => $validation['code'], 'type' => $validation['type']], Response::HTTP_OK);
        }

        $url = new Url();
        $url->url = $request->url;
        $url->type = $validation['type'];
        $url->code = $url->generateSymbolHash();
        $url->save();

        return response(['code' => $url->code, 'type' => $url->type], Response::HTTP_CREATED);
    }

    public function redirectUrl($code)
    {
        $url = Url::where('code', $code)->first();

        if (!$url) {
            return response('', Response::HTTP_NOT_FOUND);
        }

        if ($url->type == 'path') {
            $url->url = 'file:///' . $url->url;
        }

        return response($url->url, Response::HTTP_OK);
    }
}
