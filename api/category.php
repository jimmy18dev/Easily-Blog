<?php
require_once '../autoload.php';
header("Content-type: application/json");

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
);

$signature 	= new Signature;
$category = new Category;

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
			case 'submit':
				$category_id 	= $_POST['category_id'];
				$title 			= $_POST['title'];
				$desc 			= $_POST['desc'];
				$icon 			= $_POST['icon'];
				$link 			= $_POST['link'];

				if(!empty($category_id) && isset($category_id)){
					$category->edit($category_id,$title,$desc,$link,$icon);
					$returnObject['message'] 	= 'Category edited';
				}else{
					$category->create($title,$desc,$link,$icon);
					$returnObject['message'] 	= 'Category created';
				}
				
				
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