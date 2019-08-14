<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
  public function welcome()
  {
    $viewData = $this->loadViewData();

    return view('layouts.app', $viewData);
  }
}