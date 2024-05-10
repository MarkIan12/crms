<?php

namespace App\Http\Controllers;
use App\CrrPriority;
use Illuminate\Http\Request;

class CrrPriorityController extends Controller
{
    // List
    public function index()
    {   
        if(request()->ajax())
        {
            return datatables()->of(CrrPriority::query())
                    ->addColumn('action', function($data){
                        $buttons = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary">Edit</button>';
                        $buttons .= '&nbsp;&nbsp;';
                        $buttons .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger">Delete</button>';
                        return $buttons;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('crr_priorities.index'); 
    }
}
