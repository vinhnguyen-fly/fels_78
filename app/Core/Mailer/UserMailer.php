<?php

namespace FELS\Core\Mailer;

use FELS\Core\Mailer\Contracts\UserMailer as UserMailerContract;

class UserMailer extends AbstractMailer implements UserMailerContract
{
    /**
     * Send an email with account activation link to user.
     *
     * @param $user
     * @param $code
     * @return mixed
     */
    public function sendActivationURL($user, $code)
    {
        $subject = trans('mailer.account.activation.subject');
        $view = 'emails.auth.account_activation';
        $data = ['activationUrl' => route('auth.activate', $code)];
        $this->sendTo($user, $subject, $view, $data);
    }
}
