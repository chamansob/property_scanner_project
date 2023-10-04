<?php

use Illuminate\Support\Facades\Route;

 
const MONEY ='AED ';
const PACK = ['primary','danger','success','warning','info','primary', 'secondary', 'secondary','secondary'];
const PLANTYPE= [1 => 'Annualy', 0 => 'Monthly'];
const EXCHNAGE = 'USD';
const EXSSYMBOL = '$';
function active_class($path, $active = 'active high') {
  return (Route::getCurrentRoute()->uri == $path) ? $active : '';
}

function is_active_route($path) {
  //dd(Route::getCurrentRoute()->uri);
  return (str_contains(Route::getCurrentRoute()->uri,$path)) ? 'true' : 'false';
}

function show_class($path) {
  return (str_contains(Route::getCurrentRoute()->uri, $path))? 'show' : '';
}

function plantype($value)
{
  return ($value == 0 ? 'Monthly' : 'Annualy' );
}
function currency_exchange($rate)
{
  $req_url = 'https://api.exchangerate-api.com/v4/latest/AED';
  $response_json = file_get_contents($req_url);
  //echo   
  $data = json_decode($response_json, TRUE);

  return $data['rates'][ucfirst($rate)];
}


