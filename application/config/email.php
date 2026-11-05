<?php defined('BASEPATH') or exit('No direct script access allowed');

$config['useragent'] = 'Easy!Appointments';

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.sendgrid.net';
$config['smtp_auth'] = TRUE;
$config['smtp_user'] = 'apikey';
$config['smtp_pass'] = getenv('MAIL_SMTP_PASS');
$config['smtp_port'] = 587;
$config['smtp_crypto'] = 'tls';
$config['smtp_timeout'] = 10;

$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = true;
$config['validate'] = true;

$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
