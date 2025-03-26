use Google\Client;

function getFCMToken()
{
$serverKeyPath = storage_path('app/sikejar-posyandujambu-57a85bd5ac0b.json');

if (!file_exists($serverKeyPath)) {
throw new Exception("Service account JSON file not found.");
}

$client = new Client();
$client->setAuthConfig($serverKeyPath);
$client->addScope('https://www.googleapis.com/auth/firebase.messaging');

$accessToken = $client->fetchAccessTokenWithAssertion();

return $accessToken['access_token'] ?? null;
}
