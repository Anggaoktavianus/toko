<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Escpos
{
    public function __construct()
    {
        require_once APPPATH . 'vendor/mike42/escpos-php/autoload.php';
    }
}
