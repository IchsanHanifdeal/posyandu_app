<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/pdf/docx', function (Request $request) {
    $tempFile = $request->input('files');
    $ck = $request->input('cookie');

    $client = new Client();

    $convertResponse = $client->post('https://filetools23.pdf24.org/client.php?action=convertToPdf', [
        'headers' => [
            'Content-Type' => 'application/json',
            'Cookie' => $ck
        ],
        'body' => json_encode([
            'files' => $tempFile,
            'language' => 'id'
        ]),
    ]);

    $setCookie = $convertResponse->getHeader('Set-Cookie')[0];

    $convertBody = json_decode($convertResponse->getBody(), true);
    $jobId = $convertBody['jobId'];

    $outputResponse = $client->get('https://filetools23.pdf24.org/client.php?action=getStatus&jobId=' . $jobId, [
        'headers' => [
            'Cookie' => $ck
        ]
    ]);

    $outputUrl = "https://filetools23.pdf24.org/client.php?mode=download&action=downloadJobResult&jobId=" . $jobId;

    $downloadResponse = $client->post($outputUrl, [
        'headers' => [
            'Cookie' => $setCookie,
            'Accept' => 'application/octet-stream'
        ]
    ]);

    return response()->json($downloadResponse->getBody());
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
