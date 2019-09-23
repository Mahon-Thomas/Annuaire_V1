<?php

/**
 * Configuration pour la connexion à la base de données
 *
 */

$host       = "localhost";
$username   = "root";
$password   = "root";
$dbname     = "dbannuaire";
$dsn        = "mysql:host=$host;dbname=$dbname";
$tbl        = "employes";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );