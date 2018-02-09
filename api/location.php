<?php
require_once '../autoload.php';
header("Content-type: application/json");

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
	"updated"  		=> time()
);

$signature 	= new Signature();
$location 	= new Location();

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		switch ($_GET['request']){
			case 'list_geography':
				$dataset = $location->listGeography();
				$returnObject['dataset'] = $dataset;
				$returnObject['message'] = 'List Geography';
				break;
			case 'list_provice':
				$geography_id 	= $_GET['geography_id'];
				$data 			= $location->getGeography($geography_id);
				$dataset 		= $location->listProvince($geography_id);
				$returnObject['dataset'] 	= $dataset;
				$returnObject['data'] 		= $data;
				$returnObject['message'] 	= 'List Provinces';
				break;
			case 'list_amphur':
				$province_id = $_GET['province_id'];
				$dataset = $location->listAmphur($province_id);
				$returnObject['dataset'] = $dataset;
				$returnObject['message'] = 'List Amphur';
				break;
			case 'list_district':
				$amphur_id = $_GET['amphur_id'];
				$dataset = $location->listDistrict($amphur_id);
				$returnObject['dataset'] = $dataset;
				$returnObject['message'] = 'List District';
				break;
			default:
				$returnObject['message'] = 'GET API Not found!';
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