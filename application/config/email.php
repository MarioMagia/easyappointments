<?php defined('BASEPATH') or exit('No direct script access allowed');

$config['useragent'] = 'Easy!Appointments';

$config['protocol'] = 'smtp';
$config['smtp_debug'] = '1'; // or '1'
$config['smtp_host'] = getenv('MAIL_SMTP_HOST') ?: 'smtp.sendgrid.net';
$config['smtp_user'] = getenv('MAIL_SMTP_USER') ?: 'apikey';
$config['smtp_pass'] = getenv('MAIL_SMTP_PASS') ?: '';
$config['smtp_port'] = (int) (getenv('MAIL_SMTP_PORT') ?: 587);
$config['smtp_crypto'] = 'tls';
$config['smtp_timeout'] = 30;

$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = true;
$config['validate'] = true;

$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
