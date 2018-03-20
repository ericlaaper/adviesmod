<?php

namespace App\Http\Controllers\Api\V1;

use App\Mod1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMod1sRequest;
use App\Http\Requests\Admin\UpdateMod1sRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class Mod1sController extends Controller
{
    public function index()
    {
        return Mod1::all();
    }

    public function show($id)
    {
        return Mod1::findOrFail($id);
    }

    public function update(UpdateMod1sRequest $request, $id)
    {
        $mod1 = Mod1::findOrFail($id);
        $mod1->update($request->all());
        

        return $mod1;
    }

    public function store(StoreMod1sRequest $request)
    {
        $mod1 = Mod1::create($request->all());
        

        return $mod1;
    }

    public function destroy($id)
    {
        $mod1 = Mod1::findOrFail($id);
        $mod1->delete();
        return '';
    }
}
