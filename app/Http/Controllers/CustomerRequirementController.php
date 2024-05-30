<?php

namespace App\Http\Controllers;
use App\CustomerRequirement;
use App\Client;
use App\User;
use App\PriceCurrency;
use App\NatureRequest;
use App\ProductApplication;
use Illuminate\Http\Request;

class CustomerRequirementController extends Controller
{
    // List
    public function index()
    {   
        $customer_requirements = CustomerRequirement::with(['client', 'product_application'])->orderBy('id', 'desc')->get();
        // dd($customer_requirement);
        $product_applications = ProductApplication::all();
        $clients = Client::all();
        $users = User::all();
        $price_currencies = PriceCurrency::all();
        $nature_requests = NatureRequest::all();
        if(request()->ajax())
        
        {
            return datatables()->of($customer_requirements)
                    ->addColumn('action', function($data){
                        $buttons = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary">Edit</button>';
                        $buttons .= '&nbsp;&nbsp;';
                        $buttons .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger">Delete</button>';
                        return $buttons;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('customer_requirements.index', compact('customer_requirements', 'clients', 'product_applications', 'users', 'price_currencies', 'nature_requests')); 
    }
}
