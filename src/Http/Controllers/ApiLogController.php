<?php

namespace Lupka\NovaLaravelApiLogger\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Lupka\ApiLogger\Models\ApiLog;

class ApiLogController extends Controller
{
    public function index()
    {
        return ApiLog::orderBy('created_at','DESC')->paginate(30);
    }

    public function show($id)
    {
        return ApiLog::with('user')->findOrFail($id);
    }
}
