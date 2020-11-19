<?php

// debug mode, make debug = 1
$debug = 0;
$whitelist_ip = array();

$cmd = "/usr/sbin/asterisk -rx 'sip show peers'";
exec($cmd, $result);
$debug && print_r ($result);


$debug && print "\n========================\n";

foreach ($result as $line) {
        $parts = preg_split('/\s+/', $line);
        $debug && print_r ($parts);
        foreach ($parts as $chars) {
                // detech IP V4 address
                if (filter_var($chars, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                        // detech duplicate entry first
                        if (!in_array($chars, $whitelist_ip)) {
                                array_push ($whitelist_ip, $chars);
                        }
                }
        }
        $debug && print "\n========================\n";
}


print_r($whitelist_ip);
