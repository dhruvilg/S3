<?php
  $BUCKET_NAME = '';
  $IAM_KEY = '';
  $IAM_SECRET = '';
  require '../vendor/autoload.php';
  use Aws\S3\S3Client;
  use Aws\S3\Exception\S3Exception;
  
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
  $keyPath = 'uploadedfiles/IoT-Arduino-Monitor-circuit.png';
  $fileName = 'IoT-Arduino-Monitor-circuit.png';
$command = $s3->getCommand('GetObject', array(
            'Bucket'      => $BUCKET_NAME,
            'Key'         => $keyPath,
            'ContentType' => 'image/png',
            'ResponseContentDisposition' => 'attachment; filename="'.$fileName.'"'
        ));
$signedUrl = $s3->createPresignedRequest($command, "+6 days");

// Create a signed URL from the command object that will last for
// 10 minutes from the current time
$presignedUrl = (string)$signedUrl->getUri();

//echo file_get_contents($presignedUrl);

echo '<!DOCTYPE html>
<html>
<body>

<h2>HTML Image</h2>
<img src="'.$presignedUrl.'" alt="Girl in a jacket" width="500" height="600">

</body>
</html>
';
  ?>
