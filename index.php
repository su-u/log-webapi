<?php
/**
 * 結果をjsonで返却する
 *
 * @param  array resultArray 返却値
 * @return string jsonで表現されたレスポンス
 * @author kobayashi
 **/
function returnJson($resultArray){
  if(array_key_exists('callback', $_GET)){
    $json = $_GET['callback'] . "(" . json_encode($resultArray) . ");";
  }else{
    $json = json_encode($resultArray);
  }
  header('Content-Type: text/html; charset=utf-8');
  echo  $json;
  exit(0);
}

$logstr = $_POST["log"];
$result = [];

try {

  file_put_contents("log.log", $logstr."\n", FILE_APPEND);

  $result = [
      ['result' => 'ok'],
  ];

  returnJson($result);
} catch (RuntimeException $e) {
  header("HTTP/1.1 400 Bad Reques");
  exit(0);
} catch (Exception $e) {
  header("HTTP/1.1 500 Internal Server Error");
  exit(0);
}