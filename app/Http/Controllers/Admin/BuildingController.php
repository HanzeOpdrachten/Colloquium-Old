<?php
/**
 * BuildingController
 * @author       Rens Santing
 */


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BuildingRequest;
use App\Models\Building;
use App\Models\Location;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class BuildingController
 * @package App\Http\Controllers\Admin
 */
class BuildingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Displays the view list of all buildings with the appropriate action buttons: edit and delete.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.building.list', ['buildings' => Building::all()]);
    }

    /**
     * Shows the form for creating a new building.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.building.create', ['locations' => Location::all()]);
    }

    /**
     * Stores the newly created building
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuildingRequest $request)
    {
        try {
            Building::create($request->all());
        } catch (QueryException $exception) {
            if ($exception->getCode() == 23000) {
                $request->session()->flash('uniqueError', '{{ trans(\'admin/building/create.not-unique\') }}');
                return redirect()->action('Admin\BuildingController@create');
            }
        }

        Session::flash('custom_error', [
            'type' => 'success',
            'message' => trans('common.modelcreated', ['modelName' => trans('common.building')]),
        ]);

        return view('admin.building.list', ['buildings' => Building::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // we don't display a single building, doesn't require implementation.
        throw new NotFoundHttpException();
    }

    /**
     * Show the form for editing the building (identified by $id)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.building.edit', [
            'building' => Building::findOrFail($id),
            'locations' => Location::all(),
        ]);
    }

    /**
     * Updates the building after the editing form is submitted.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BuildingRequest $request, $id)
    {
        try {
            $building = Building::findOrFail($id);
            $building->name = $request->get('name');
            $building->abbreviation = $request->get('abbreviation');
            $building->location_id = $request->get('location_id');
            $building->save();
        } catch (QueryException $exception) {
            if ($exception->getCode() == 23000) {
                $request->session()->flash('error', '{{ trans(\'admin/building/create.not-unique\') }}');
                //redirect()->back();
            }
        }

        Session::flash('custom_error', [
            'type' => 'success',
            'message' => trans('common.modelupdated', ['modelName' => trans('common.building')]),
        ]);

        return redirect()->action('Admin\BuildingController@index');
    }

    /**
     * Remove the specified building from storage.
     *
     * @param  Request $request
     * @param  Building $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Building $building)
    {
        if ($building->rooms->count() === 0 || $request->force) {
            $building->rooms()->delete();
            $building->delete();

            Session::flash('custom_error', [
                'type' => 'success',
                'message' => trans('common.modeldeleted', ['modelName' => trans('common.building')]),
            ]);
            return redirect()->back();
        }

        Session::flash('custom_error', [
            'type' => 'warning',
            'message' => trans('common.stillhasroomsforcedelete', ['link' => view('admin.building.force_delete', ['building' => $building])]),
        ]);

        return redirect()->back();
    }
}
