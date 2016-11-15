<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseTypeController;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoomController extends BaseTypeController
{
    protected $modelClass = 'App\Models\Room';

    protected $editView = 'admin.room.edit';
    protected $createView = 'admin.room.create';
    protected $overviewView = 'admin.room.overview';

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'capacity' => 'required|numeric|min:0',
            'building_id' => 'required|exists:buildings,id',
        ]);

        Session::flash('custom_error', [
            'type' => 'success',
            'message' => trans('common.modelcreated', ['modelName' => trans('common.room')]),
        ]);

        return parent::store($request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'capacity' => 'required|numeric|min:0',
            'building_id' => 'required|exists:buildings,id',
        ]);

        Session::flash('custom_error', [
            'type' => 'success',
            'message' => trans('common.modelupdated', ['modelName' => trans('common.room')]),
        ]);

        return parent::update($request, $id);
    }

    /**
     * Remove the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Room::findOrFail($id)->colloquia()->count() != 0) {
            Session::flash('custom_error', [
                'type' => 'info',
                'message' => trans('common.stillhascolloquia'),
            ]);
            return back();
        }

        Session::flash('custom_error', [
            'type' => 'success',
            'message' => trans('common.modeldeleted', ['modelName' => trans('common.room')]),
        ]);

        return parent::destroy($id);
    }

}
