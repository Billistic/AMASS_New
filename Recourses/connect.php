<?php
require 'vendor/autoload.php';

$firebase = Firebase::fromServiceAccount('google-service-account.json');

$database = $firebase->getDatabase();

$database->getReference('config/website')
   ->set([
       'name' => 'My Application',
       'emails' => [
           'support' => 'support@domain.tld',
           'sales' => 'sales@domain.tld',
       ],
       'website' => 'https://app.domain.tld',
      ]);

$database->getReference('config/website/name')->set('New name');

echo '<script language="javascript">';
echo 'alert("message successfully sent")';
echo '</script>';

?>