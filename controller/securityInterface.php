<?php

/***************************************************
 * Name: security interface
 * Description:all these methods are used for ipad data exchange,
 * Author: Chris Gao
 * Date: 2015-12-30
 ***************************************************/
	// set character set, avoid messy code
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Access-Control-Max-Age: 1000');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, RequestId");
	require_once('common/DatabaseHelper.php');
	require_once('common/model.php');
	require_once('common/registry.php');
	
	$registry = new Registry();
	$db = new DatabaseHelper();
	$registry->set('db', $db);
	
	//$action = $_GET['action'];
    $sql= isset($_GET['sql'])?($_GET['sql']):NULL;
	$searchid = isset($_GET['searchid'])?($_GET['searchid']):NULL;
	$searchname = isset($_GET['searchname'])?($_GET['searchname']):NULL;
	$searchby = isset($_GET['searchby'])?($_GET['searchby']):NULL;
	$from = isset($_GET['from'])?($_GET['from']):NULL;
	$action = isset($_GET['action'])?($_GET['action']):NULL;


	switch ($action) {


//		case "getallmenus":{
//			require_once('launchpad_data.php');
//			$client = new launchpaddata($registry);
//			$result = $client->getAllMenuLists($searchname);
//			echo $result;
//			break;
//		}

        case "OpenCase":{
            require_once('model/OpenCase.php');
            $client = new  OpenCase($registry);
            $result = $client->ajaxSQL($sql);
            echo $result;
            break;
        }
        case "CaseData":{
            require_once('model/CaseData.php');
            $client = new  CaseData();
            $result = $client->ajaxSQL();

            echo $result;
            break;
        }

	
	}

?>