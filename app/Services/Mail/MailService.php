<?php

namespace App\Services\Mail;

use App\Mail\DefaultMail;
use App\Services\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailService extends Service
{
    /**
     * send email to user
     *
     * @param $email
     * @param $subject
     * @param $body
     * @param null $name
     * @param null $image
     * @return bool
     */
  public function sendMail($email,$subject,$body,$name = null,$image = null) : bool
  {
    try {
      Mail::to($email)->send(new DefaultMail([
        'subject' => $subject,
        'name' => $name,
        'content' => $body,
        'image' => $image
      ]));
      return true;
    }catch (\Exception $error){
      Log::info('Email not sent to : '.$email.' due to '.$error->getMessage());
    }

    return false;
  }
}
