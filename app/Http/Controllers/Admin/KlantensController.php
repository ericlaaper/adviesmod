<?php

namespace App\Http\Controllers\Admin;

use App\Klanten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKlantensRequest;
use App\Http\Requests\Admin\UpdateKlantensRequest;

class KlantensController extends Controller
{
    /**
     * Display a listing of Klanten.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('klanten_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('klanten_delete')) {
                return abort(401);
            }
            $klantens = Klanten::onlyTrashed()->get();
        } else {
            $klantens = Klanten::all();
        }

        return view('admin.klantens.index', compact('klantens'));
    }

    /**
     * Show the form for creating new Klanten.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('klanten_create')) {
            return abort(401);
        }
        
        $naams = \App\Bedrijf::get()->pluck('bedrijfsnaam', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.klantens.create', compact('naams'));
    }

    /**
     * Store a newly created Klanten in storage.
     *
     * @param  \App\Http\Requests\StoreKlantensRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKlantensRequest $request)
    {
        if (! Gate::allows('klanten_create')) {
            return abort(401);
        }
        $klanten = Klanten::create($request->all());



        return redirect()->route('admin.klantens.index');
    }


    /**
     * Show the form for editing Klanten.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('klanten_edit')) {
            return abort(401);
        }
        
        $naams = \App\Bedrijf::get()->pluck('bedrijfsnaam', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $klanten = Klanten::findOrFail($id);

        return view('admin.klantens.edit', compact('klanten', 'naams'));
    }

    /**
     * Update Klanten in storage.
     *
     * @param  \App\Http\Requests\UpdateKlantensRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKlantensRequest $request, $id)
    {
        if (! Gate::allows('klanten_edit')) {
            return abort(401);
        }
        $klanten = Klanten::findOrFail($id);
        $klanten->update($request->all());



        return redirect()->route('admin.klantens.index');
    }


    /**
     * Display Klanten.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('klanten_view')) {
            return abort(401);
        }
        
        $naams = \App\Bedrijf::get()->pluck('bedrijfsnaam', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$mod1s = \App\Mod1::where('achternaam_id', $id)->get();

        $klanten = Klanten::findOrFail($id);

        return view('admin.klantens.show', compact('klanten', 'mod1s'));
    }


    /**
     * Remove Klanten from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('klanten_delete')) {
            return abort(401);
        }
        $klanten = Klanten::findOrFail($id);
        $klanten->delete();

        return redirect()->route('admin.klantens.index');
    }

    /**
     * Delete all selected Klanten at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('klanten_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Klanten::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Klanten from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('klanten_delete')) {
            return abort(401);
        }
        $klanten = Klanten::onlyTrashed()->findOrFail($id);
        $klanten->restore();

        return redirect()->route('admin.klantens.index');
    }

    /**
     * Permanently delete Klanten from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('klanten_delete')) {
            return abort(401);
        }
        $klanten = Klanten::onlyTrashed()->findOrFail($id);
        $klanten->forceDelete();

        return redirect()->route('admin.klantens.index');
    }
}
