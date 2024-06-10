<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Client;
use App\Contact;
use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // List
    public function index(Request $request)
    {   
        $activities = Activity::with(['client'])
            ->when($request->isShowOpen == 'true' && $request->isShowClosed == 'true', function ($query) {
                return $query; // No filtering needed
            })
            ->when($request->isShowOpen == 'true' && $request->isShowClosed == 'false', function ($query) {
                return $query->where('Status', 10); // Only Open
            })
            ->when($request->isShowOpen == 'false' && $request->isShowClosed == 'true', function ($query) {
                return $query->where('Status', '!=', 10); // Only Closed
            })
            ->orderBy('id', 'desc')
            ->get();

        $clients = Client::all();
        $contacts = Contact::all();
        $users = User::where('is_active', '1')->get();
        $currentUser = Auth::user();

        if ($request->ajax()) {
            return datatables()->of($activities)
                ->addColumn('action', function($data){
                    $buttons = '<button type="button" name="view" id="'.$data->id.'" class="view btn btn-success">View</button>';
                    $buttons .= '&nbsp;&nbsp;';
                    $buttons .= '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary">Edit</button>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('activities.index', compact('activities', 'clients', 'contacts', 'users', 'currentUser')); 
    }

    // client contact
    public function getContacts($clientId)
    {
        $contacts = Contact::where('CompanyId', $clientId)->pluck('ContactName', 'id');
        return response()->json($contacts);
    }

    // Store
    public function store(Request $request) 
    {
        $rules = array(
            'ClientId'  =>  'required',
            'Title'     =>  'required'
        );

        $customMessages = array(
            'ClientId.required'     =>      'The client field is required.'
        );

        $error = Validator::make($request->all(), $rules, $customMessages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'Type'                          =>  $request->Type,
            'ClientId'                      =>  $request->ClientId,
            'Title'                         =>  $request->Title,
            'ActivityNumber'                =>  $request->ActivityNumber, 
            'ClientContactId'               =>  $request->ClientContactId,  
            'PrimaryResponsibleUserId'      =>  $request->PrimaryResponsibleUserId,'SecondaryResponsibleUserId'    =>  $request->SecondaryResponsibleUserId,
            'RelatedTo'                     =>  $request->RelatedTo,
            'TransactionNumber'             =>  $request->TransactionNumber,
            'ScheduleFrom'                  =>  $request->ScheduleFrom, 
            'ScheduleTo'                    =>  $request->ScheduleTo,
            'Description'                   =>  $request->Description,
            'Status'                        =>  '10',
        );

        Activity::create($form_data);

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    // Edit
    public function edit($id)
    {
        $activity = Activity::find($id);

        // Assuming you have relationships defined in your Activity model
        $primaryUser = User::where('id', $activity->PrimaryResponsibleUserId)
                            ->orWhere('user_id', $activity->PrimaryResponsibleUserId)
                            ->first();

        $secondaryUser = User::where('id', $activity->SecondaryResponsibleUserId)
                            ->orWhere('user_id', $activity->SecondaryResponsibleUserId)
                            ->first();

        return response()->json([
            'data' => $activity,
            'primaryUser' => $primaryUser,
            'secondaryUser' => $secondaryUser
        ]);
    }    

    public function getContactsByClient($clientId)
    {
        $contacts = Contact::where('client_id', $clientId)->get();
        return response()->json($contacts);
    }
}