<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\WebsiteFormMail;
use App\Mail\WebsiteUserConfirmation;
use App\Models\EmailVerification;
use Carbon\Carbon;


use App\Models\FormSubmission;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
   public function sendEmail(Request $request)
    {
        $data = $request->all();

        // Save to DB
        FormSubmission::create(['data' => $data]);

        // Send email to admin
        //Mail::to('husein.m.hammoud@gmail.com')->send(new WebsiteFormMail($data));

	Mail::to([
			'husein.m.hammoud@gmail.com',
			// 'info@pluggedx.com'
	])->send(new WebsiteFormMail($data));

        // Send to User (if email is provided)
        if (!empty($data['email'])) {
            Mail::to($data['email'])->send(new WebsiteUserConfirmation($data));
        }

        return response()->json(['message' => 'Email sent successfully']);
    }

     public function requestVerification(Request $request)
    {
        $request->validate([
            'from_email' => 'required|email'
        ]);

        $code = random_int(100000, 999999);

        EmailVerification::updateOrCreate(
            ['email' => $request->from_email],
            [
                'code' => $code,
                'payload' => $request->all(),
                'expires_at' => Carbon::now()->addMinutes(10)
            ]
        );

        Mail::raw("Your verification code is: $code", function ($message) use ($request) {
            $message->to($request->from_email)
                ->subject('Email Verification Code');
        });

        return response()->json([
            'message' => 'Verification code sent'
        ]);
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required'
        ]);

        $record = EmailVerification::where('email', $request->email)
            ->where('code', $request->code)
            ->first();

        if (!$record) {
            return response()->json([
                'message' => 'Invalid verification code'
            ], 400);
        }

        if ($record->expires_at < now()) {
            return response()->json([
                'message' => 'Code expired'
            ], 400);
        }

        $data = $record->payload;

        // Save submission
        FormSubmission::create(['data' => $data]);

        // Send to admin
        Mail::to([
            'husein.m.hammoud@gmail.com',
            'info@pluggedx.com'
        ])->send(new WebsiteFormMail($data));

        // Send confirmation to user
        if (!empty($data['from_email'])) {
            Mail::to($data['from_email'])->send(new WebsiteUserConfirmation($data));
        }

        $record->delete();

        return response()->json([
            'message' => 'Email sent successfully'
        ]);
    }
}
