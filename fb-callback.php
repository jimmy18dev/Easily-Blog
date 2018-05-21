<?php
require_once 'autoload.php';
require_once 'plugin/facebook-sdk-v5/autoload.php';

$fb = new Facebook\Facebook([
    'app_id'                => $config['facebook']['api_id'],
    'app_secret'            => $config['facebook']['app_secret'],
    'default_graph_version' => 'v3.0'
]);

$helper = $fb->getRedirectLoginHelper();

// Get Access Token
try {
    $accessToken = $helper->getAccessToken();
}catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo '#1 Graph returned an error: '.$e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo '#1 Facebook SDK returned an error: '.$e->getMessage();
    exit;
}

// Retrieve User Profile via the Graph API
try {
    $response = $fb->get('/me?fields=id,email,name,first_name,last_name,verified',$accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo '#2 Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo '#2 Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$fbuser = $response->getGraphUser();

$facebook_id    = $fbuser['id'];
$email          = $fbuser['email'];
$fname          = $fbuser['first_name'];
$lname          = $fbuser['last_name'];
$link           = '';
$verified       = $fbuser['verified'];
$gender         = '';

$user_id = $user->alreadyFacebookAccount($facebook_id,$email);

if($user_id == -1){
    // Register new account.
    if(!empty($facebook_id) && !empty($email)){
        $user_id = $user->registerFacebook($facebook_id,$email,$fname,$lname,$link,$verified,$gender);
        $msg  = 'Registered';
    }else{
        $msg  = 'Invalid!';
    }
}else{
    $user->editFormFacebook($user_id,$facebook_id,$email,$fname,$lname,$link,$verified,$gender);
    // Update to account.
    $msg  = 'Updated';
}

$returnObject['user_id']  = floatval($user_id);
$user->facebookLogin($user_id);

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
header('Location: '.DOMAIN.'/profile#'.$msg);
?>