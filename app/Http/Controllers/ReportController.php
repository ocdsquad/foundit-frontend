<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{

    function sendReport(Request $request, $id)
    {
        $email = session('auth.user.email');
        $body = [
            'fullname' => $request->input('fullname'),
            'email' => $email,
            'message' => $request->input('message')
        ];
        // Send the report to the API
        $token = session('auth.token');
        $response = Http::withToken($token)
            ->post("http://localhost:8080/report/{$id}", $body);

        return back()->with('report',['message' => $response->json()['message']]);
    }
    

    function sendReportGuest(Request $request, $id)
    {
   
        $body = [
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'message' => $request->input('message')
        ];
  
        $response = Http::post("http://localhost:8080/report/{$id}", $body);

        if ($response->created()) {
            return redirect("/report/{$id}/verify-otp")->with('flash', ['success', $response->json()['message']])
                ->withInput(['data' => $body]);
        }

        return back()->with('report',['message' => $response->json()['message']]);
    }


    function showVerifyOtpForm(Request $request, $id)
    {
        $data = old('data');
        return view('report.otp', compact('id', 'data'));
    }

    function verifyOtp(Request $request, $id)
    {
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $message = $request->input('message');
        $otp = $request->input('otp');


        $body = [
            'fullname' => $fullname,
            'email' => $email,
            'message' => $message,
            'otp' => $otp
        ];

        $response = Http::post("http://localhost:8080/report/{$id}/verify-and-send", $body);

        if ($response->created()) {
            return redirect("/items/{$id}")->with('report', ['message'=> $response->json()['message']]);
        } else {
            return back()->with('flash', ['danger', 'Verification failed, please try again'])->withInput();
        }
    }
    
}
