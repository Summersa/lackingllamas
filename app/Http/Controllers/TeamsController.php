<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TeamsController extends Controller
{
	//page does not require login
	public function __construct() {}

	public function teams()
    {
        return view('teams');
    }
}
