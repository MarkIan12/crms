<?php

namespace App\Http\Controllers;
use App\Product;
use Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Current List
    public function index()
    {   
        $products = Product::where('status', '4')->orderBy('id', 'desc')->get();
        if(request()->ajax())
        {
            return datatables()->of($products)
                    ->addColumn('action', function($data){
                        $buttons = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary">Edit</button>';
                        $buttons .= '&nbsp;&nbsp;';
                        $buttons .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger">Delete</button>';
                        return $buttons;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('products.index'); 
    }

    // Draft List 
    public function draft()
    {   
        $products = Product::where('status', '1')->orderBy('id', 'desc')->get();
        if(request()->ajax())
        {
            return datatables()->of($products)
                    ->addColumn('action', function($data){
                        $buttons = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary">Edit</button>';
                        $buttons .= '&nbsp;&nbsp;';
                        $buttons .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger">Delete</button>';
                        return $buttons;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('products.draft'); 
    }

    // Archived List
    public function archived()
    {   
        $products = Product::where('status', '5')->orderBy('id', 'desc')->get();
        if(request()->ajax())
        {
            return datatables()->of($products)
                    ->addColumn('action', function($data){
                        $buttons = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary">Edit</button>';
                        $buttons .= '&nbsp;&nbsp;';
                        $buttons .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger">Delete</button>';
                        return $buttons;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('products.archived'); 
    }
}
