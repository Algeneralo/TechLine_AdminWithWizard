<?php
/**
 * Created by PhpStorm.
 * User: Algeneral
 * Date: 7/24/2018
 * Time: 12:54 PM
 */
$rules = array(
    'name' => 'required|valid_name',//valid name means valid human name
    'password'    => 'required|max_len,100|min_len,6',
    'email'       => 'required|valid_email',
    'gender'      => 'required|exact_len,1|contains,m f',
    'number'      => 'required|integer',
    'url'      => 'required|valid_url',
    'date'      => 'required|date',
);