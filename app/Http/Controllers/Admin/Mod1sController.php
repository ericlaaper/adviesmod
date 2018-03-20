<?php

namespace App\Http\Controllers\Admin;

use App\Mod1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMod1sRequest;
use App\Http\Requests\Admin\UpdateMod1sRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class Mod1sController extends Controller
{
    /**
     * Display a listing of Mod1.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('mod1_access')) {
            return abort(401);
        }
        if ($filterBy = Input::get('filter')) {
            if ($filterBy == 'all') {
                Session::put('Mod1.filter', 'all');
            } elseif ($filterBy == 'my') {
                Session::put('Mod1.filter', 'my');
            }
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('mod1_delete')) {
                return abort(401);
            }
            $mod1s = Mod1::onlyTrashed()->get();
        } else {
            $mod1s = Mod1::all();
        }

        return view('admin.mod1s.index', compact('mod1s'));
    }

    /**
     * Show the form for creating new Mod1.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('mod1_create')) {
            return abort(401);
        }
        
        $achternaams = \App\Klanten::get()->pluck('achternaam', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.mod1s.create', compact('achternaams', 'created_bies'));
    }

    /**
     * Store a newly created Mod1 in storage.
     *
     * @param  \App\Http\Requests\StoreMod1sRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMod1sRequest $request)
    {
        if (! Gate::allows('mod1_create')) {
            return abort(401);
        }
        $mod1 = Mod1::create($request->all());



        return redirect()->route('admin.mod1s.index');
    }


    /**
     * Show the form for editing Mod1.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('mod1_edit')) {
            return abort(401);
        }
        
        $achternaams = \App\Klanten::get()->pluck('achternaam', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $created_bies = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $mod1 = Mod1::findOrFail($id);

        return view('admin.mod1s.edit', compact('mod1', 'achternaams', 'created_bies'));
    }

    /**
     * Update Mod1 in storage.
     *
     * @param  \App\Http\Requests\UpdateMod1sRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMod1sRequest $request, $id)
    {
        if (! Gate::allows('mod1_edit')) {
            return abort(401);
        }
        $mod1 = Mod1::findOrFail($id);
        $mod1->update($request->all());



        return redirect()->route('admin.mod1s.index');
    }


    /**
     * Display Mod1.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('mod1_view')) {
            return abort(401);
        }
        $mod1 = Mod1::findOrFail($id);

        return view('admin.mod1s.show', compact('mod1'));
    }


    /**
     * Remove Mod1 from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('mod1_delete')) {
            return abort(401);
        }
        $mod1 = Mod1::findOrFail($id);
        $mod1->delete();

        return redirect()->route('admin.mod1s.index');
    }

    /**
     * Delete all selected Mod1 at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('mod1_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Mod1::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Mod1 from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('mod1_delete')) {
            return abort(401);
        }
        $mod1 = Mod1::onlyTrashed()->findOrFail($id);
        $mod1->restore();

        return redirect()->route('admin.mod1s.index');
    }

    /**
     * Permanently delete Mod1 from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('mod1_delete')) {
            return abort(401);
        }
        $mod1 = Mod1::onlyTrashed()->findOrFail($id);
        $mod1->forceDelete();

        return redirect()->route('admin.mod1s.index');
    }
}
