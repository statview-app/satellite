<?php

use Illuminate\Support\Facades\Config;

it('can expose about information via a route', function () {
    $token = '5816cc49-5722-48a7-8f33-53d2f69943c8';

    Config::set('statview.api_key', $token);

    $response = $this
        ->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->get('/statview/satellite/about');

    $response->assertSuccessful();

    expect($response->json())
        ->toHaveKeys(['data'])
        ->and($response->json()['data'])
        ->toHaveKeys(['environment', 'cache', 'drivers']);
});

it('can authenticate a request', function () {
    $token = '5816cc49-5722-48a7-8f33-53d2f69943c8';

    Config::set('statview.api_key', $token);

    $response = $this
        ->withHeaders([
            'Authorization' => 'Bearer b8d8ef9e-ae96-443b-957a-3d2939e904ae',
        ])
        ->get('/statview/satellite/about');

    $response->assertStatus(403);
});
