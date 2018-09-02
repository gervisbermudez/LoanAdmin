<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('session', 'database');
$autoload['drivers'] = array();
$autoload['helper'] = array('url','html', 'form', 'string');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('MY_model', 'admin/User_model', 'admin/loan/Loan_model', 'admin/User_Group_model');