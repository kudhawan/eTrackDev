<?php
class EmailConfig {
public $smtp2go = array(
'host' => 'tls://mail.smtp2go.com',
'port' => 2525,
// 8025, 587 and 25 can also be used. Use Port 465 for SSL.

'username' => 'USERNAME',
'password' => 'PASSWORD',
'transport' => 'Smtp'
);
}

?>