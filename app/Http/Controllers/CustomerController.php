<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Validator;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{

    public function gridconfig()
    {
        $json = Storage::json('assets/js/gridconfig.json', JSON_THROW_ON_ERROR);
        return response()->json($json);
    }

    public function formconfig()
    {
        $json = Storage::json('assets/js/formconfig.json', JSON_THROW_ON_ERROR);
        return response()->json($json);
    }

    public function gets(Request $request)
    {
        $customers = Customer::orderBy('id', 'desc');
        $where = $request->Where;
        if($where){
            $filter = $where['Items'][0]['Value'][0];
            $customers = $customers->where('name', 'like', '%' . $filter . '%')
            ->orWhere('email', 'like', '%' . $filter . '%');
        }
        $customers = $customers->get();
        
        foreach( $customers as &$row) {
            $row->_id = $row->id;
        }
        
        return response()->json([
            'count' => count($customers),
            'data' => $customers,
        ]);
    }

    public function get(Request $request)
    {   
        $customer = Customer::find($request[0]);
        return response()->json($customer);
    }

    public function insert(Request $request)
    {   
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
        ]);
  
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        
        $payload = [
            'name' => $request->name,
            'email' => $request->email,
            'mothers_maiden_name' => $request->mothers_maiden_name,
            'dob' => $request->dob,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'national_id' => $request->national_id,
            'occupation' => $request->occupation,
        ];


        $customer = Customer::create($payload);

        return response()->json($payload);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $customer = Customer::find($request->id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mothers_maiden_name = $request->mothers_maiden_name;
        $customer->dob = $request->dob;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone_number;
        $customer->national_id = $request->national_id;
        $customer->occupation = $request->occupation;
        $customer->save();

        return response()->json($request);
    }

    public function delete(Request $request)
    {
        $customer = Customer::find($request->id);
        $customer->delete();

        return response()->json($customer);
    }
}