<?php

namespace App\Http\Controllers;
use App\ProductEvaluation;
use Illuminate\Http\Request;

class ProductEvaluationController extends Controller
{
    // List
    public function index()
    {   
        if(request()->ajax())
        {
            return datatables()->of(ProductEvaluation::latest()->get())
                    ->addColumn('action', function($data){
                        $buttons = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary">Edit</button>';
                        $buttons .= '&nbsp;&nbsp;';
                        $buttons .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger">Delete</button>';
                        return $buttons;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('product_evaluations.index'); 
    }
}
