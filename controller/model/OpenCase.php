<?php


/**
 * Created by PhpStorm.
 * User: Welcome
 * Date: 2017/6/8
 * Time: 10:45
 */
class OpenCase extends Model{
  function ajaxSQL($sql){

      $jsonArray = array();

      $sql = $sql;

      $ResultSet = $this->get('db')->execute($sql);

      $listResultArray = array();
      while($row = mysql_fetch_assoc($ResultSet))
      {
          if($row != null)
          {
              array_push($listResultArray,$row);
          }
      }
      if(count($listResultArray) > 0 )
      {
          $jsonArray = array('error'=>0,'output'=>$listResultArray);
      }
      else
      {
          $jsonArray = array('error'=>1);
      }

      return json_encode($jsonArray);

  }

}