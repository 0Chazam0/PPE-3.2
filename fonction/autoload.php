<?php
function __autoload($class) {
	require_once 'modele/DTO/' . lcfirst($class) . '.php';
}
