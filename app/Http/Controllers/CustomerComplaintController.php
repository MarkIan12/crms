<?php

namespace App\Http\Controllers;
use App\CustomerComplaint;
use Illuminate\Http\Request;

class CustomerComplaintController extends Controller
{
    // List 
    public function index()
    {   
        if(request()->ajax())
        {
            return datatables()->of(CustomerComplaint::query())
                    ->addColumn('action', function($data){
                        $buttons = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary">View</button>';
                        $buttons .= '&nbsp;&nbsp;';
                        $buttons .= '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-info">Edit</button>';
                        $buttons .= '&nbsp;&nbsp;';
                        $buttons .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger">Delete</button>';
                        return $buttons;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('customer_complaints.index'); 
    }
}
