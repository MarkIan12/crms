<?php

namespace App\Http\Controllers;
use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    // List
    public function index()
    {
        $areas = Area::with('region')->latest()->get();
        if(request()->ajax())
        {
            return datatables()->of($areas)
                ->addColumn('action', function($data){
                    $buttons = '<button type="button" name="edit" id="'.$data->Id.'" class="edit btn btn-primary">Edit</button>';
                    $buttons .= '&nbsp;&nbsp;';
                    $buttons .= '<button type="button" name="delete" id="'.$data->Id.'" class="delete btn btn-danger">Delete</button>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        // Pass the areas and regions to the view
        return view('areas.index', compact('areas'));
    }
}
