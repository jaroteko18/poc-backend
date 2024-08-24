<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json([
            'status' => 'success',
            'customers' => $customers,
        ]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
        ]);
  
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'mothers_maiden_name' => $request->mothers_maiden_name,
            'dob' => $request->dob,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'national_id' => $request->national_id,
            'occupation' => $request->occupation,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Customer created successfully',
            'customer' => $customer,
        ]);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return response()->json([
            'status' => 'success',
            'customer' => $customer,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mothers_maiden_name = $request->mothers_maiden_name;
        $customer->dob = $request->dob;
        $customer->address = $request->address;
        $customer->phone_number = $request->phone_number;
        $customer->national_id = $request->national_id;
        $customer->occupation = $request->occupation;
        $customer->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Customer updated successfully',
            'customer' => $customer,
        ]);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Customer deleted successfully',
            'customer' => $customer,
        ]);
    }
}