<?php
class Db
{
    public static function getConnection()
    {
        
        /*$conn = oci_connect(
            'cards', '1',
             '(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.64.1)(PORT = 1521))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = XE)))
');*/ $conn = oci_connect("cards","1","192.168.64.1/XE", "AL32UTF8");
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);

        
    }
    return $conn;
}
}