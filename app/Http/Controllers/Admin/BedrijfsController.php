<?php

namespace App\Http\Controllers\Admin;

use App\Bedrijf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBedrijfsRequest;
use App\Http\Requests\Admin\UpdateBedrijfsRequest;

class BedrijfsController extends Controller
{
    /**
     * Display a listing of Bedrijf.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('bedrijf_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('bedrijf_delete')) {
                return abort(401);
            }
            $bedrijfs = Bedrijf::onlyTrashed()->get();
        } else {
            $bedrijfs = Bedrijf::all();
        }

        return view('admin.bedrijfs.index', compact('bedrijfs'));
    }

    /**
     * Show the form for creating new Bedrijf.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('bedrijf_create')) {
            return abort(401);
        }
        
        $achternaams = \App\Relatiemanager::get()->pluck('achternaam', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.bedrijfs.create', compact('achternaams'));
    }

    /**
     * Store a newly created Bedrijf in storage.
     *
     * @param  \App\Http\Requests\StoreBedrijfsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBedrijfsRequest $request)
    {
        if (! Gate::allows('bedrijf_create')) {
            return abort(401);
        }
        $bedrijf = Bedrijf::create($request->all());



        return redirect()->route('admin.bedrijfs.index');
    }


    /**
     * Show the form for editing Bedrijf.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('bedrijf_edit')) {
            return abort(401);
        }
        
        $achternaams = \App\Relatiemanager::get()->pluck('achternaam', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $bedrijf = Bedrijf::findOrFail($id);

        return view('admin.bedrijfs.edit', compact('bedrijf', 'achternaams'));
    }

    /**
     * Update Bedrijf in storage.
     *
     * @param  \App\Http\Requests\UpdateBedrijfsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBedrijfsRequest $request, $id)
    {
        if (! Gate::allows('bedrijf_edit')) {
            return abort(401);
        }
        $bedrijf = Bedrijf::findOrFail($id);
        $bedrijf->update($request->all());



        return redirect()->route('admin.bedrijfs.index');
    }


    /**
     * Display Bedrijf.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('bedrijf_view')) {
            return abort(401);
        }
        
        $achternaams = \App\Relatiemanager::get()->pluck('achternaam', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$klantens = \App\Klanten::where('naam_id', $id)->get();

        $bedrijf = Bedrijf::findOrFail($id);

        return view('admin.bedrijfs.show', compact('bedrijf', 'klantens'));
    }


    /**
     * Remove Bedrijf from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('bedrijf_delete')) {
            return abort(401);
        }
        $bedrijf = Bedrijf::findOrFail($id);
        $bedrijf->delete();

        return redirect()->route('admin.bedrijfs.index');
    }

    /**
     * Delete all selected Bedrijf at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('bedrijf_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Bedrijf::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Bedrijf from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('bedrijf_delete')) {
            return abort(401);
        }
        $bedrijf = Bedrijf::onlyTrashed()->findOrFail($id);
        $bedrijf->restore();

        return redirect()->route('admin.bedrijfs.index');
    }

    /**
     * Permanently delete Bedrijf from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('bedrijf_delete')) {
            return abort(401);
        }
        $bedrijf = Bedrijf::onlyTrashed()->findOrFail($id);
        $bedrijf->forceDelete();

        return redirect()->route('admin.bedrijfs.index');
    }
}
