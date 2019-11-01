<?php
  $BUCKET_NAME = '';
  $IAM_KEY = '';
  $IAM_SECRET = '';
  require '../vendor/autoload.php'; 
  use Aws\S3\S3Client;
  use Aws\S3\Exception\S3Exception;
 
  $keyPath = 'IoT-Arduino-Monitor-circuit.png'; // file name(can also include the folder name and the file name. eg."member1/IoT-Arduino-Monitor-circuit.png")
  //S3 connection 
  try {
    $s3 = S3Client::factory(
      array(
        'credentials' => array(
          'key' => $IAM_KEY,
          'secret' => $IAM_SECRET
        ),
        'version' => 'latest',
        'region'  => 'us-east-1'
      )
    );
    
    //to get the file from s3 private bucket
    $result = $s3->getObject(array(
      'Bucket' => $BUCKET_NAME,
      'Key'    => $keyPath
    ));
    
    header("Content-Type: {$result['ContentType']}");
    header('Content-Disposition: filename="' . basename($keyPath) . '"');
    echo $result['Body'];
  } catch (Exception $e) {
    die("Error: " . $e->getMessage());
  }
  ?>
