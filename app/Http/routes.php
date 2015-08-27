<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    $app->log->debug('Hitting the subscription route..');

    $appId = '1459015154407859';

    $fb = new Facebook\Facebook([
        'app_id' => $appId,
        'app_secret' => '8383a4f0b8084e29237dffcb89b31cd5',
        'default_graph_version' => 'v2.2',
    ]);
    
    $request = $fb->request('POST', "/$appId/subscriptions", json_encode([
            'object' => 'page',
            'callback_url' => 'fbsub.purple.horse/callback',
            'fields' => 'feed',
            'verify_token' => 'thisisaverifystring'
        ]));
    $request->setAccessToken('1459015154407859|75Nl63m_HJRRdUmLHXYMiXuv-YA');

    try {
        $response = $fb->getClient()->sendRequest($request);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      // When Graph returns an error
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      // When validation fails or other local issues
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
});

$app->get('login', function() { return view('index'); });

$app->get('callback', function() use ($app) {
    $challenge = $app->request->input('hub_challenge');
    $app->log->debug('challenge: ' . $challenge);
    echo $challenge;
});

$app->post('callback', function() use ($app) {
    $app->log->debug('Post request coming in!');
});
