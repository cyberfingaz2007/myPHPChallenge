<?php 

class MyDB extends SQLite3
{
  function __construct()
  {
     $this->open('jenkinsJobs.db');
  }
}
/* Define STDIN in case if it is not already defined by PHP for some reason */
if (!defined("STDIN")){define("STDIN", fopen('php://stdin','r'));}
 
echo "Hello! What is your name (enter below):\n";
$strName = fread(STDIN, 80); // Read up to 80 characters or a newline
echo 'Hello ' , $strName , "\n";

$postData = array(
    'j_username' => '-----',
    'j_password' => '-----',
    'crumb' => 'f081e039f0601d03b7d4ef1a62162025',
    'redirect_to' => 'http://localhost:8080/api/json?pretty=true'
);

// init the resource
$curl = curl_init();

// ... or an array of options
curl_setopt_array($curl, array( 
    CURLOPT_URL => 'http://localhost:8080/login?from=%2F',
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_FAILONERROR => TRUE,
    CURLOPT_USERAGENT => 'PHP Console Challenge'
));

if(!curl_exec($curl)){
    die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
}
// execute
$output = curl_exec($curl);
// free
curl_close($curl);

$db = new MyDB();
if(!$db){
  echo $db->lastErrorMsg();
} else {
  echo "Opened database successfully\n";
  $sql =<<<EOF
      INSERT INTO JOBS (JOBNAME,STATUS,DATECHECKED)
      VALUES ('Paul', 32, '' );
EOF;
  $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
   $db->close();
}
echo $output;

?>