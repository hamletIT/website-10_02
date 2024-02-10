<?php

namespace App\Services\Email;

use App\Jobs\SendEmailNotification;

class EmailService
{
    /**
     * Sends email notifications.
     *
     * @param array $data An array containing email addresses and post data.
     *                    The array structure should be:
     * [
     *     'email' => array|string, // An array of email addresses or a single email address.
     *     'post' => array, // An array containing post data with 'title' and 'description' keys.
     * ]
     * @return void
     */
    public function sendMail(array $data): void
    {
        $emailRes = $data['email'];
        $postRes = $data['post'];
        $content = [
            'title' => $postRes['title'],
            'description' => $postRes['description'],
        ];

        foreach ($emailRes as $email) {
            SendEmailNotification::dispatch($email, $content);
        }
    }
}
