<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class RapportageModule1sController extends Controller
{
    public function index()
    {
        if (! Gate::allows('rapportage_module_1_access')) {
            return abort(401);
        }
        return view('admin.rapportage_module_1s.index');
    }
}
