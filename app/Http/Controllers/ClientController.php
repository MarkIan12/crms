<?php

namespace App\Http\Controllers;
use App\Client;
use Validator;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // List
    public function index()
    {   
        if(request()->ajax())
        {
            return datatables()->of(Client::latest()->get())
                    ->addColumn('action', function($data){
                        $buttons = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary">Edit</button>';
                        $buttons .= '&nbsp;&nbsp;';
                        $buttons .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger">Delete</button>';
                        return $buttons;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('clients.index'); 
    }
}
