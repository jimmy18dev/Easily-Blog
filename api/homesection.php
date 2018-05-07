<?php
require_once '../autoload.php';
header("Content-type: application/json");

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

$signature 	= new Signature;
$homesection = new HomeSection();

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
    		case 'create':
    			$category_id 	= $_POST['category_id'];
    			$total_items 	= $_POST['total_items'];
    			$homesection->create($category_id,$total_items);
    			break;
    		case 'swap':
				$current 	= $_POST['current'];
				$target 	= $_POST['target'];

				$homesection->swap($current,$target);
				break;
    		case 'delete':
    			$section_id = $_POST['section_id'];
    			$homesection->delete($section_id);
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