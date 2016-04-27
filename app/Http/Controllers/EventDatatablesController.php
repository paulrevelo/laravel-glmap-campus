<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Model\Event;
use Yajra\Datatables\Datatables;

class EventDatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('main.events');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(Event::query())->make(true);
    }

    // public function getAddEditRemoveColumn()
    // {
    //     return view('main.buildings');
    // }

    // public function getAddEditRemoveColumnData()
    // {
    //     $buildings = Building::select(['id', 'name', 'description'])->get();

    //     return Datatables::of($buildings)
    //         ->addColumn('action', function ($building) {
    //             return '<a href="#edit-'.$building->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
    //         })
    //         ->editColumn('id', 'ID: {{$id}}')
    //         ->make(true);
    // }
}