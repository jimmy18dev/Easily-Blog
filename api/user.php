<?php
require_once '../autoload.php';
header("Content-type: application/json");

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

$signature 	= new Signature;

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		// switch ($_GET['request']){
		// 	case 'list':
		// 		$dataset = $app->listAll();

		// 		$returnObject['items'] = $dataset;
		// 		$returnObject['message'] = 'list all apps';
		// 		break;
		// 	default:
		// 		$returnObject['message'] = 'GET API Not found!';
		// 	break;
		// }
    	break;
    case 'POST':
    	switch ($_POST['request']){
    		case 'facebook_login':
    			$fb_id 		= $_POST['fb_id'];
    			$fb_email 	= $_POST['fb_email'];
    			$fb_fname 	= $_POST['fb_fname'];
    			$fb_lname 	= $_POST['fb_lname'];
    			$fb_link 	= $_POST['fb_link'];
    			$fb_verified = $_POST['fb_verified'];
    			$gender 	= $_POST['gender'];

    			$user_id = $user->alreadyFacebookAccount($fb_id,$fb_email);

    			if($user_id == -1){
    				// Register new account.
    				if(!empty($fb_id) && !empty($fb_email)){
    					$user_id = $user->registerFacebook($fb_id,$fb_email,$fb_fname,$fb_lname,$fb_link,$fb_verified,$gender);
    					$returnObject['message'] 	= 'New Account Created from Facebook';
    				}else{
    					$returnObject['message'] 	= 'Facebook or Email Address invalid!';
    				}
    			}else{
    				$user->editFormFacebook($user_id,$fb_id,$fb_email,$fb_fname,$fb_lname,$fb_link,$fb_verified,$gender);
    				// Update to account.
    				$returnObject['message'] 	= 'Update account from Facebook';
    			}
    			$returnObject['user_id'] 	= floatval($user_id);

    			$user->facebookLogin($user_id);
    			break;

    		case 'register':
				$fullname 	= $_POST['fullname'];
				$phone 		= $_POST['phone'];
				$email 		= $_POST['email'];
				$password 	= $_POST['password'];

				$user_id = $user->registerForm($fullname,$phone,$email,$password);

				if(true){
					$state = $user->login($phone,$password);
				}

				$returnObject['message'] 	= 'New Account Created!';
				$returnObject['account_id'] = $user_id;

				break;
			case 'login':
				$username = $_POST['username'];
				$password = $_POST['password'];

				$state = $user->login($_POST['username'],$_POST['password']);

				if($state == 1) $message = 'login success';
				else if($state == 1) $message = 'Login fail';
				else if($state == -1) $message = 'Account Locked';
				else $message = 'n/a';

				$returnObject['message'] 	= $message;
				$returnObject['state'] 		= $state;
				
				break;
			case 'edit_info':
				$display 	= $_POST['display'];
				$bio 		= $_POST['bio'];

				$user->editInfo($user->id,$display,$bio);
				
				$returnObject['message'] = 'Profile edited.';
				break;
			case 'change_password':
				$newpassword = $_POST['newpassword'];

				$user->changePassword($user->id,$newpassword);

				$returnObject['message'] 	= 'Password changed.';
				break;
			case 'request_verify':
				$user_id 	= $_POST['user_id'];
				$fullname 	= $_POST['fullname'];
				$email 		= $_POST['email'];
				$phone 		= $_POST['phone'];
				$bio 		= $_POST['bio'];

				$user->requestVerify($user->id,$fullname,$email,$phone,$bio);

				$returnObject['message'] 	= 'Verify request Send';
				break;
			case 'import_facebook_avatar':
				$fb_avatar = 'https://graph.facebook.com/'.$user->fb_id.'/picture?type=large';
				$img_folder = '../image/upload/avatar/';
				$new_filename = 'avatar_'.substr(md5(time().rand(0,2147483647)),6,6).'.jpg';
				$img_location = $img_folder.$new_filename;

				$stream_opts = [
					"ssl" => [
						"verify_peer"=>false,
						"verify_peer_name"=>false
					]
				];    

				file_put_contents($img_location,file_get_contents($fb_avatar,false, stream_context_create($stream_opts)));

				// Delte Old Image.
                if(!empty($user->avatar) && file_exists($img_folder.$user->avatar))
                	unlink($img_folder.$user->avatar);

                $user->updateAvatar($user->id,$new_filename); // Update Avatar
				
				$returnObject['fb_avatar'] = $fb_avatar;
				$returnObject['message'] = 'Avatar Imported.';
				break;
			default:
				$returnObject['message'] = 'POST API Not found!';
			break;
		}
    	break;
    default:
    	$returnObject['message'] = 'METHOD API Not found!';
    	break;
}

echo json_encode($returnObject);
exit();
?>