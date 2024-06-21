<?php

namespace App\Http\Controllers;

use App\Models\payemnt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class payemntController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $payemnt = payemnt::all();
        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => $payemnt
        ], 202);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }
    
        try {
            $validator = Validator::make($request->all(), [
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ], 422);
            }
    
            $payment = new payemnt;
            $payment->transaction_id = Str::uuid()->toString();
            $payment->users_id = Auth::user()->id; 
            $payment->transaction_ammount = $request->transaction_ammount;
            $payment->pay_status = $request->pay_status;
            $payment->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Payment Created Successfully',
                'data' => $payment,
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function show(string $id)
    {
        //
        $payemnt = payemnt::where('transaction_id',$id)->first();
        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => $payemnt,
        ], 201);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payemnt = payemnt::where('transaction_id', $id)->first();
    
        if (!$payemnt) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found',
            ], 404);
        }
    
        // Validate the request data
        $validator = Validator::make($request->all(), [
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $payemnt->update([
            'pay_status' => $request->pay_status,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Payment updated successfully',
            'data' => $payemnt, 
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
