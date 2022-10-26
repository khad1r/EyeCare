<?php
$DB_CONFIG = array(
    'host' => 'localhost',
    'username' => 'username',
    'password' => 'password',
    'dbname' => 'eyecare'
);

$koneksi = mysqli_connect(
    $DB_CONFIG['host'],
    $DB_CONFIG['username'],
    $DB_CONFIG['password'],
    $DB_CONFIG['dbname']
) or die(mysqli_error($koneksi));

// function backupDatabase($fileDest)
// {
//     global $DB_CONFIG;

//     $cmd = "mysqldump --routines 
//     -h {$DB_CONFIG['host']} 
//     -u {$DB_CONFIG['username']} 
//     -p{$DB_CONFIG['password']} 
//     {$DB_CONFIG['dbname']} > {$fileDest}";

//     exec($cmd);
// }
// function restoreDatabase($file)
// {
//     global $DB_CONFIG;

//     $cmd = "mysql 
//     -h {$DB_CONFIG['host']} 
//     -u {$DB_CONFIG['username']} 
//     -p{$DB_CONFIG['password']} 
//     {$DB_CONFIG['dbname']} < {$file}";

//     exec($cmd);
// }


function sanitizeQuery($koneksi, $query)
{
    return trim(htmlspecialchars(mysqli_real_escape_string($koneksi, $query)));;
}