<?php
  $BUCKET_NAME = '';
  $IAM_KEY = '';
  $IAM_SECRET = '';
  require '../vendor/autoload.php';
  use Aws\S3\S3Client;
  use Aws\S3\Exception\S3Exception;
 
  $keyPath = 'IoT-Arduino-Monitor-circuit.png';
  
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
