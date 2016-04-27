<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Model\Building;
use Yajra\Datatables\Datatables;

class BuildingDatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('main.buildings');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $buildings = Building::select(['id', 'name', 'description'])->get();

        return Datatables::of($buildings)
        ->addColumn('action', function ($building) {
          return 
            '<a href="#edit-'.$building->id.'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
            <a href="#delete-'.$building->id.'" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>';
        })
        ->make(true);
    }

    // public function getAddEditRemoveColumn()
    // {
    //     return view('main.buildings');
    // }

    // public function getAddEditRemoveColumnData()
    // {
    //     

    //     return Datatables::of($buildings)
    //         ->addColumn('action', function ($building) {
    //             return '<a href="#edit-'.$building->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
    //         })
    //         ->editColumn('id', 'ID: {{$id}}')
    //         ->make(true);
    // }
}