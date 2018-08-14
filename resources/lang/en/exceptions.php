<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' =>[
        'access' =>[
            'roles' =>[
                'already_exists'     => 'That role is already exists. Please rename the new role',
                'cant_delete_admin'  => 'You can not delete administrator role',
                'create_error'       => 'There was a problem creating this role. Please try again',
                'delete_error'       => 'There was a problem deleting this role. Please try again',
                'has_users'          => 'You can not delete a role with associated users',
                'needs_permission'   => 'You must select at least one permission for this role',
                'not_found'          => 'That role does not exist',
                'update_error'       => 'There was a problem updating this role. Please try again',
            ],

            'users' =>[
                'already_confirmed'     => 'This user is already confirmed',
                'cant_confirm'  => 'There is a problem confirming the user account',
                'cant_deactivate_self'   => 'You can not do that to yourself',
                'cant_delete_admin'   => 'You can not delete super administrator',
                'cant_delete_self'       => 'You can not delete yourself',
                'cant_delete_own_session'  => 'You can not delete your own session',
                'cant_restore'           => 'This user is not deleted so it can not be restored',
                'cant_unconfirm_admin'  => 'You can not un-confirm super administrator',
                'cant_unconfirm_self'  => 'You can not un-confirm yourself',
                'create_error'           => 'There is a problem creating this user. Please try again',
                'delete_error'           => 'There is a problem deleting this user. Please try again',
                'delete_first'           => 'This user must be deleted first before it can be destroyed permanently',
                'email_error'            => 'That email address belongs to a different user',
                'mark_error'             => 'There is a problem updating this user. Please try again',
                'not_confirmed'             => 'This user is not confirmed yet',
                'not_found'              => 'That user does not exist',
                'restore_error'          => 'There is a problem restoring this user. Please try again',
                'role_needed_create'     => 'You must choose at least one role',
                'role_needed'            => 'You must choose at least one role',
                'session_wrong_driver'   => 'Your session driver must be set to database to use this feature',
                'social_delete_error'  => 'There is a problem removing the social account from the user',
                'update_error'           => 'There is a problem updating this user. Please try again',
                'update_password_error'  => "There is a problem changing this user's password. Please try again"
            ],
        ],
    ],

    'frontend' =>[
        'auth' =>[
            'confirmation' =>[
                'already_confirmed'  => 'Your account is already confirmed',
                'created'            => 'Account is created',
                'confirm'            => 'Please confirm your account',
                'created_confirm'    => 'Your account was successfully created. We sent you an email , please check your email inbox',
                'created_pending'    => 'Your account was successfully created but approval is still pending. An email will be sent when your account is approved',
                'mismatch'           => 'Your confirmation code does not match',
                'not_found'          => 'That confirmation code does not exist',
                'pending'             => 'Approval is pending, you can login after approval only, please wait for an acknowledgement message from system administrator',
                'resend'             => 'Your account is not confirmed yet. Please click the confirmation link in your e-mail body, or <a href="'.route('frontend.auth.account.confirm.resend', ':user_uuid').'">click here</a> to resend the confirmation e-mail',
                'success'            => 'Your account has been successfully confirmed',
                'resent'             => 'A new confirmation e-mail has been sent ',
            ],

            'deactivated'  => 'Your account has been deactivated',
            'email_taken'  => 'That email address is already taken',

            'password' =>[
                'change_mismatch'  => 'That is not your old password',
                'reset_problem'  => 'There is a problem resetting your password. Please resend the password reset email',
            ],

            'registration_disabled'  => 'Registration is currently closed',
        ],
    ],
];
