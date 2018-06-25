<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// $config['protocol'] = 'sendmail';

$config['protocol'] = 'ssmtp';
$config['smtp_host'] = 'ssl://ssmtp.gmail.com';

$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;



?>
