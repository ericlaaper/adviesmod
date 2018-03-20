<?php

namespace App\Http\Controllers\Admin;

use App\Relatiemanager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRelatiemanagersRequest;
use App\Http\Requests\Admin\UpdateRelatiemanagersRequest;

class RelatiemanagersController extends Controller
{
    /**
     * Display a listing of Relatiemanager.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('relatiemanager_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('relatiemanager_delete')) {
                return abort(401);
            }
            $relatiemanagers = Relatiemanager::onlyTrashed()->get();
        } else {
            $relatiemanagers = Relatiemanager::all();
        }

        return view('admin.relatiemanagers.index', compact('relatiemanagers'));
    }

    /**
     * Show the form for creating new Relatiemanager.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('relatiemanager_create')) {
            return abort(401);
        }
        return view('admin.relatiemanagers.create');
    }

    /**
     * Store a newly created Relatiemanager in storage.
     *
     * @param  \App\Http\Requests\StoreRelatiemanagersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRelatiemanagersRequest $request)
    {
        if (! Gate::allows('relatiemanager_create')) {
            return abort(401);
        }
        $relatiemanager = Relatiemanager::create($request->all());



        return redirect()->route('admin.relatiemanagers.index');
    }


    /**
     * Show the form for editing Relatiemanager.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('relatiemanager_edit')) {
            return abort(401);
        }
        $relatiemanager = Relatiemanager::findOrFail($id);

        return view('admin.relatiemanagers.edit', compact('relatiemanager'));
    }

    /**
     * Update Relatiemanager in storage.
     *
     * @param  \App\Http\Requests\UpdateRelatiemanagersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRelatiemanagersRequest $request, $id)
    {
        if (! Gate::allows('relatiemanager_edit')) {
            return abort(401);
        }
        $relatiemanager = Relatiemanager::findOrFail($id);
        $relatiemanager->update($request->all());



        return redirect()->route('admin.relatiemanagers.index');
    }


    /**
     * Display Relatiemanager.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('relatiemanager_view')) {
            return abort(401);
        }
        $bedrijfs = \App\Bedrijf::where('achternaam_id', $id)->get();

        $relatiemanager = Relatiemanager::findOrFail($id);

        return view('admin.relatiemanagers.show', compact('relatiemanager', 'bedrijfs'));
    }


    /**
     * Remove Relatiemanager from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('relatiemanager_delete')) {
            return abort(401);
        }
        $relatiemanager = Relatiemanager::findOrFail($id);
        $relatiemanager->delete();

        return redirect()->route('admin.relatiemanagers.index');
    }

    /**
     * Delete all selected Relatiemanager at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('relatiemanager_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Relatiemanager::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Relatiemanager from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('relatiemanager_delete')) {
            return abort(401);
        }
        $relatiemanager = Relatiemanager::onlyTrashed()->findOrFail($id);
        $relatiemanager->restore();

        return redirect()->route('admin.relatiemanagers.index');
    }

    /**
     * Permanently delete Relatiemanager from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('relatiemanager_delete')) {
            return abort(401);
        }
        $relatiemanager = Relatiemanager::onlyTrashed()->findOrFail($id);
        $relatiemanager->forceDelete();

        return redirect()->route('admin.relatiemanagers.index');
    }
}
