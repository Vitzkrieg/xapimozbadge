<?php

$data = $_POST["data"];
$name = (isset($data["name"])) ? $data["name"] : "Unknown User";
$verb = (isset($data["verb"])) ? $data["verb"]["display"]["en-US"] : "interacted";
$result = (isset($data["result"])) ? $data["result"]["response"] : NULL;
$object = (isset($data["object"])) ? $data["object"]["definition"]["name"] : "a button";

$statement = $name;

$statement .= " " . $verb;

$statement .= " with " . $object;

if($result){
	$statement .= " and resulted in: " . PHP_EOL . $result;
}

echo $statement;

?>