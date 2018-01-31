<?php
require_once '../autoload.php';
header("Content-type: application/json");

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

$signature 	= new Signature;
$document = new Document();

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
    		
    		case 'edit_title':
    			$file_id 	= $_POST['file_id'];
    			$title 		= $_POST['title'];
    			$document->editTitle($file_id,$title);
    			break;
    		case 'delete':
    		
				$file_id = $_POST['file_id'];
				$document->get($file_id);
				$file_location = '../files/'.$document->file_name;

				if(file_exists($file_location)){
					unlink($file_location);
				}

				$document->delete($document->id);

				$returnObject['message'] 	= 'Document file deleted';

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