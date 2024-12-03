<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class AjaxController extends Controller
{
    public function sendExpertEmail(Request $request)
    {
        $validated = $request->validate(
            ['client_email' => 'required'],
            ['client_email.required' => __('Please enter your email')]
        );

        $message = $request->input('message');

        if (is_null($message)) {
            $message = __('Some one requests to contact you holding tho follwoing email') . ': ' . $validated['client_email'];
        }

        $expert = Expert::where('id', $request->input('expert_id'))->first();

        if ($expert) {
            \Mail::to($expert->email)->send(
                new \App\Mail\RequestCertificateMail(
                    client_email: $validated['client_email'],
                    client_message: $message
                )
            );

            Notification::make()
                ->title('Request Expert Contact')
                ->body('A user with email ' . $validated['client_email'] . ' wants to contact the expert ' . $expert->name . '.')
                ->actions([
                    Action::make('View Expert')
                        ->url('/experts/' . $expert->id),
                ])
                ->sendToDatabase(\App\Models\SystemUser::first());

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 422);
    }

    public function logError(Request $request)
    {
        \Log::channel('frontend')->error($request->input('error'));
        return response()->json(['success' => true]);
    }

    public function requestCertificate(Request $request)
    {
        $validated = $request->validate(
            ['client_email' => 'required|email'],
            ['client_email.required' => __('Please enter your email')]
        );

        $expert = Expert::where('id', $request->input('expert_id'))->first();
        if ($expert) {
            Notification::make()
                ->title('Request Certificate')
                ->body('A user with email ' . $validated['client_email'] . ' wants to contact the expert ' . $expert->name . '.')
                ->actions([
                    Action::make('View Expert')
                        ->url('/experts/' . $expert->id),
                ])
                ->sendToDatabase(\App\Models\SystemUser::first());

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 422);
    }
}
