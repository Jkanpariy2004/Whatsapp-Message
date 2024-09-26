<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use GuzzleHttp\Client as GuzzleClient;
use Twilio\Http\GuzzleClient as TwilioGuzzleClient;

class WhatsAppController extends Controller
{
    public function sendWhatsAppMessage()
    {
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER');
        $recipientNumber = 'whatsapp:+917862882054';
        $message = "Hello from Jenish Kanpariya.";

        // Create a custom Guzzle client with SSL verification disabled
        $guzzleClient = new GuzzleClient([
            'verify' => false,  // Disable SSL verification
        ]);

        // Wrap the Guzzle client in Twilio's GuzzleClient
        $twilioHttpClient = new TwilioGuzzleClient($guzzleClient);

        // Pass the TwilioGuzzleClient to the Twilio Client
        $twilio = new Client($twilioSid, $twilioToken, null, null, $twilioHttpClient);

        try {
            $twilio->messages->create(
                $recipientNumber,
                [
                    "from" => 'whatsapp:' . $twilioWhatsAppNumber,
                    "body" => $message,
                ]
            );

            return response()->json(['message' => 'WhatsApp message sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
