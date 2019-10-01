<?php

/**
 * Configuration for database connection
 *
 */

$host       = "localhost";
$username   = "alunando_apoia";
$password   = "d5;^0~q#W#q]";
$dbname     = "alunando_apoia";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );