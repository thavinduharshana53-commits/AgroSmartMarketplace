<?php

namespace App\Http\Controllers\Farmer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublishProductController extends Controller
{
    public function index(){
        return view('farmer.publishProducts');
    }
}
