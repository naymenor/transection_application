<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mockResponceController extends Controller
{
    //
    public function mockresp(Request $request)
    {
        if($request->header('payment_status'))
        {
            return response()->json([
                'success' => true,
                'message' => 'Accepted',
            ], 202);
        }
        else
        {
            return response()->json([
                'success' => true,
                'message' => 'Not Acceptable',
                'data' => $request->status
            ], 406);
        }
    }
}
