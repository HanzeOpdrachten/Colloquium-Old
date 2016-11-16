<?php
/**
 * Api\RoomController
 *
 * @author       Sander van Kasteel
 */
namespace app\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Building;
use App\Models\Room;

/**
 * Class RoomController
 * @package app\Http\Controllers\API
 */
class RoomController extends Controller
{

    /**
     * Get all rooms in a certain building
     *
     * @param Building $building
     * @return \App\Models\Building[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getRoomsBasedOnBuilding(Building $building)
    {
        return $building->rooms;
    }

}