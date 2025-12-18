<?php
session_start();
include 'database.php'; // Your database connection

require_once __DIR__ . '/google-api-php-client-v2.18.3-PHP8.0/vendor/autoload.php';

// -------------------- Google API credentials --------------------
$client_id = ';
$client_secret = '';
$redirect_uri = 'http://localhost/Blood-Care/glogin.php';

// -------------------- Initialize Google Client --------------------
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope(['email', 'profile']);
$client->setPrompt('select_account');

$service = new Google_Service_Oauth2($client);

// -------------------- Step 0: Set access token from session --------------------
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
}

// -------------------- Step 1: Handle OAuth callback --------------------
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    
    if (isset($token['error'])) {
        die("Error fetching access token: " . $token['error']);
    }

    $_SESSION['access_token'] = $token;
    $client->setAccessToken($token);

    // Redirect to remove ?code from URL
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit;
}

// -------------------- Step 2: Show login button if not authenticated --------------------
if (!$client->getAccessToken()) {
    $authUrl = $client->createAuthUrl();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Blood Bank</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
        /* Reset */
        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Poppins', sans-serif; }

        /* Body Background */
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: linear-gradient(135deg, rgba(230, 57, 70, 0.8), rgba(244, 180, 180, 0.8));
        }

        /* Container */
        .container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 40px 30px;
            max-width: 350px;
            width: 100%;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
            text-align: center;
        }

        .container header {
            font-size: 2.3em;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-shadow: 1px 2px 6px rgba(0,0,0,0.2);
            margin-bottom: 30px;
            color: #fff; 
        }

        /* Google Button */
        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            color: #444;
            padding: 12px 20px;
            margin: 20px 0;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s;
        }
        .google-btn:hover {
            background: #f0f0f0;
        }
        .google-btn svg {
            height: 24px;
            width: 24px;
            margin-right: 10px;
        }
        </style>
    </head>
    <body>
        <div class="container">
            <header>Login</header>
            <a class="google-btn" href="<?php echo $authUrl; ?>">
                <!-- Google "G" SVG logo -->
                <svg viewBox="0 0 533.5 544.3">
                    <path fill="#4285F4" d="M533.5 278.4c0-17.5-1.5-34.3-4.3-50.7H272v95.9h146.9c-6.3 34.1-25.1 62.9-53.4 82.1v68.2h86.2c50.4-46.4 79.8-114.7 79.8-195.5z"/>
                    <path fill="#34A853" d="M272 544.3c72.6 0 133.6-24.1 178.1-65.4l-86.2-68.2c-24 16.2-55 25.8-91.9 25.8-70.7 0-130.5-47.7-151.9-111.6H31.8v70.1C76.2 478.1 166 544.3 272 544.3z"/>
                    <path fill="#FBBC05" d="M120.1 325.1c-4.9-14.7-7.7-30.3-7.7-46.1s2.8-31.4 7.7-46.1v-70.1H31.8C11.3 222.5 0 273.1 0 278.9s11.3 56.4 31.8 91.3l88.3-45.1z"/>
                    <path fill="#EA4335" d="M272 107.1c37.9 0 71.7 13.1 98.3 38.9l73.7-73.7C405.6 24.1 344.6 0 272 0 166 0 76.2 66.2 31.8 165.1l88.3 70.1C141.5 154.8 201.3 107.1 272 107.1z"/>
                </svg>
                Sign in with Google
            </a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// -------------------- Step 3: Fetch user info --------------------
try {
    $user = $service->userinfo->get();
} catch (Exception $e) {
    die('Error fetching user info: ' . $e->getMessage());
}

// -------------------- Step 4: Check if user exists in DB --------------------
$stmt = $con->prepare("SELECT * FROM user WHERE Gmail = ?");
$stmt->bind_param("s", $user->email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['ID'] = $row['ID'];
    $_SESSION['Name'] = $user->name;
    $_SESSION['Email'] = $row['Gmail'];
    $_SESSION['Picture'] = $user->picture;

    if ($row['Name'] != $user->name) {
        $update = $con->prepare("UPDATE user SET Name=? WHERE ID=?");
        $update->bind_param("si", $user->name, $row['ID']);
        $update->execute();
    }
} else {
    $insert_stmt = $con->prepare("INSERT INTO user (Name, Gmail) VALUES (?, ?)");
    $insert_stmt->bind_param("ss", $user->name, $user->email);
    $insert_stmt->execute();

    $_SESSION['ID'] = $con->insert_id;
    $_SESSION['Name'] = $user->name;
    $_SESSION['Email'] = $user->email;
    $_SESSION['Picture'] = $user->picture;
}

// -------------------- Step 5: Redirect --------------------
header("Location: User_dashboard.php");
exit;
?>
