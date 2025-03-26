<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class FirebaseHelper {
    public static function sendPushNotification($deviceToken, $title, $body)
    {
        $serverKeyPath = storage_path('app/sikejar-posyandujambu-57a85bd5ac0b.json');
        if (!file_exists($serverKeyPath)) {
            throw new \Exception("FCM Server Key file not found.");
        }

        $serverKey = trim(file_get_contents($serverKeyPath)); // Membaca server key dari file
        $url = "https://fcm.googleapis.com/fcm/send";

        $data = [
            "to" => $deviceToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
                "click_action" => url('/') // Bisa disesuaikan
            ]
        ];

        $response = Http::withHeaders([
            "Authorization" => "key=" . $serverKey,
            "Content-Type" => "application/json"
        ])->post($url, $data);

        return $response->json();
    }

    private static function getFirebaseAccessToken($credentialsPath) {
        $credentials = json_decode(file_get_contents($credentialsPath), true);
        $clientEmail = $credentials['client_email'];
        $privateKey = $credentials['private_key'];
        $tokenUri = 'https://oauth2.googleapis.com/token';

        $payload = [
            'iss' => $clientEmail,
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud' => $tokenUri,
            'exp' => time() + 3600,
            'iat' => time()
        ];

        $jwt = self::generateJwt($payload, $privateKey);

        $response = Http::asForm()->post($tokenUri, [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt
        ]);

        return $response->json()['access_token'];
    }

    private static function generateJwt($payload, $privateKey) {
        $header = ['alg' => 'RS256', 'typ' => 'JWT'];
        $base64UrlHeader = self::base64UrlEncode(json_encode($header));
        $base64UrlPayload = self::base64UrlEncode(json_encode($payload));
        $signature = '';
        openssl_sign("$base64UrlHeader.$base64UrlPayload", $signature, $privateKey, OPENSSL_ALGO_SHA256);
        $base64UrlSignature = self::base64UrlEncode($signature);
        return "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";
    }

    private static function base64UrlEncode($data) {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }
}
