<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//$config['useragent']        = 'PHPMailer';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
$config['useragent'] = 'CodeIgniter';
$config['protocol']         = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
$config['mailpath']         = '/usr/sbin/sendmail';
// $config['smtp_host']        = 'smtp.gmail.com';
$config['smtp_host']        = 'ssl://smtp.googolemail.com';
$config['smtp_auth']        = true;                     // Whether to use SMTP authentication, boolean TRUE/FALSE. If this option is omited or if it is NULL, then SMTP authentication is used when both $config['smtp_user'] and $config['smtp_pass'] are non-empty strings.
$config['smtp_user']        = 'slife518@gmail.com';
$config['smtp_pass']        = 'jkjkjk7878';
$config['smtp_port']        = 587;
$config['wordwrap']         = true;
// $config['wrapchars']        = 76;
$config['mailtype']         = 'html';                   // 'text' or 'html'
// $config['charset']          = null;                     // 'UTF-8', 'ISO-8859-15', ...; NULL (preferable) means config_item('charset'), i.e. the character set of the site.
// $config['validate']         = true;
// $config['priority']         = 3;                        // 1, 2, 3, 4, 5; on PHPMailer useragent NULL is a possible option, it means that X-priority header is not set at all, see https://github.com/PHPMailer/PHPMailer/issues/449
// $config['crlf']             = '\r\n';                     // "\r\n" or "\n" or "\r"
$config['newline']          = '\r\n';                     // "\r\n" or "\n" or "\r"
// //$config['bcc_batch_mode']   = false;
// //$config['bcc_batch_size']   = 200;
// $config['encoding']         = '8bit';                   // The body encoding. For CodeIgniter: '8bit' or '7bit'. For PHPMailer: '8bit', '7bit', 'binary', 'base64', or 'quoted-printable'.

// DKIM Signing
// $config['dkim_domain']      = '';                       // DKIM signing domain name, for exmple 'example.com'.
// $config['dkim_private']     = '';                       // DKIM private key, set as a file path.
// $config['dkim_private_string'] = '';                    // DKIM private key, set directly from a string.
// $config['dkim_selector']    = '';                       // DKIM selector.
// $config['dkim_passphrase']  = '';                       // DKIM passphrase, used if your key is encrypted.
// $config['dkim_identity']    = '';                       // DKIM Identity, usually the email address used as the source of the email.
$config['smtp_timeout'] = 10;

?>
