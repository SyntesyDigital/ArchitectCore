<?php

namespace Modules\Architect\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Architect\Http\Requests\Tools\SiteList\CreateSiteListRequest;
use Modules\Architect\Http\Requests\Tools\SiteList\UpdateSiteListRequest;
use Modules\Architect\Jobs\Tools\SiteList\CreateSiteList;
use Modules\Architect\Jobs\Tools\SiteList\DeleteSiteList;
use Modules\Architect\Jobs\Tools\SiteList\UpdateSiteList;
use Modules\Architect\Entities\Tools\SiteList;
use Illuminate\Http\Request;
use Session;

class SiteListController extends Controller
{
    public function index(Request $request)
    {
        return view('architect::sitelists.index', [
            'sitelists' => SiteList::where('type', '!=', 'documents')->paginate(20),
        ]);
    }

    public function create(Request $request)
    {
        return view('architect::sitelists.form');
    }

    public function store(CreateSiteListRequest $request)
    {
        try {
            $sitelist = $this->dispatchNow(CreateSiteList::fromRequest($request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');

            return redirect()->route('sitelists.show', $sitelist);
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('sitelists.create');
    }

    public function show($id, Request $request)
    {
        return view('architect::sitelists.form', [
            'sitelist' => SiteList::find($id),
        ]);
    }

    public function update(SiteList $sitelist, UpdateSiteListRequest $request)
    {
        try {
            $this->dispatchNow(UpdateSiteList::fromRequest($sitelist, $request));
            Session::flash('notify_success', 'Enregistrement effectué avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('sitelists.show', $sitelist);
    }

    public function delete(SiteList $sitelist)
    {
        return $this->dispatchNow(new DeleteSiteList($sitelist)) ? response()->json([
            'success' => true
        ]) : response()->json([
            'success' => false
        ], 500);
    }
}
