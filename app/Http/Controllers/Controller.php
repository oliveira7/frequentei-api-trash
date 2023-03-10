<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as RouteController;

class Controller extends RouteController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

