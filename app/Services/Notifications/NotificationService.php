<?php

namespace App\Services\Notifications;

use App\Models\Device;
use App\Services\Service;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class NotificationService extends Service
{
    public function sendNotification($title, $body)
    {
        $devices = Device::all();
        if ($devices->count() > 0) {
            foreach ($devices as $device) {
                $deviceToken = $device->firebase_token;

                $notification = [
                    'title' => $title,
                    'body' => $body,
                ];

                $data = [
                    'key' => 'value', // Optional data payload
                ];

                $cloudMessage = CloudMessage::withTarget('token', $deviceToken)
                    ->withNotification(Notification::fromArray($notification))
                    ->withApnsConfig([
                        "payload" => [
                            "aps" => [
                                "sound" => "monzo.wav",
                            ]
                        ]
                    ])
                    ->withData($data);

                try {
                    // Send the FCM notification to the specified device token
                    $messaging = app('firebase.messaging');
                    $messaging->send($cloudMessage);
                }catch (\Exception $error){
                    Log::error('Notification not sent due to :'.$error->getMessage());
                }
            }
        }
    }
}
