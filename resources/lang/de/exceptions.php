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
                'already_exists'     => 'Diese Rolle besteht bereits, bitte wählen Sie einen anderen Rollennamen',
                'cant_delete_admin'  => 'Sie können die Rolle des Administrators nicht löschen',
                'create_error'       => 'Bei der Erstellung dieser Rolle ist ein Fehler entstanden, bitte versuchen Sie es später erneut',
                'delete_error'       => 'Beim Löschen dieser Rolle ist ein Fehler entstanden, bitte versuchen Sie es später erneut',
                'has_users'          => 'Sie können keine Rolle löschen, die in Beziehung zu anderen Nutzern steht',
                'needs_permission'   => 'Dieser Rolle müssen Sie zumindest eine Befugnis geben',
                'not_found'          => 'Eine solch definierte Rolle existiert nicht',
                'update_error'       => 'Bei der Aktualisierung dieser Rolle ist ein Fehler entstanden, bitte versuchen Sie es später erneut',
            ],

            'users' =>[
                'already_confirmed'     => 'Dieser Benutzer wurde bereits verifiziert',
                'cant_confirm'  => 'Bei der Verifizierung dieses Nutzerkontos ist ein Fehler entstanden',
                'cant_deactivate_self'   => 'Sie können ein Konto nicht selbst passivieren, bitte wenden Sie sich an das Management',
                'cant_delete_admin'   => 'Sie können den Super-Administrator nicht löschen',
                'cant_delete_self'       => 'Sie können Ihr eigenes Konto nicht löschen, bitte wenden Sie sich an das Management',
                'cant_delete_own_session'  => 'Sie können Ihre eigene Sitzung nicht löschen',
                'cant_restore'           => 'Dieses Konto ist noch nicht gelöscht und muss daher nicht gerettet werden',
                'cant_unconfirm_admin'  => 'Sie können den Super-Administrator nicht außer Kraft setzen',
                'cant_unconfirm_self'  => 'Sie können die außer Kraft Setzung nicht selbst durchführen',
                'create_error'           => 'Bei der Erstellung dieses Nutzers ist ein Fehler entstanden, bitte versuchen Sie es später erneut',
                'delete_error'           => 'Beim Löschen dieses Nutzers ist ein Fehler entstanden, bitte versuchen Sie es später erneut',
                'delete_first'           => 'Bevor Sie diesen Benutzer komplett löschen können, müssen Sie ihn zuvor normal löschen',
                'email_error'            => 'Diese E-Mail gehört einem anderen Nutzer',
                'mark_error'             => 'Bei der Aktualisierung dieser Nutzerinformationen ist ein Fehler entstanden, bitte versuchen Sie es später erneut',
                'not_confirmed'             => 'Dieses Benutzerkonto wurde noch nicht verifiziert',
                'not_found'              => 'Dieser Nutzer existiert nicht',
                'restore_error'          => 'Beim Retten dieses Nutzerkontos ist ein Fehler entstanden, bitte versuchen Sie es später erneut',
                'role_needed_create'     => 'Sie müssen mindestens eine Rolle wählen',
                'role_needed'            => 'Sie müssen mindestens eine Rolle wählen',
                'session_wrong_driver'   => 'Um diesen Treiber nutzen zu können, muss er als Datenbank Ihres Sitzungstreibers eingestellt werden',
                'social_delete_error'  => 'Bei der Aufhebung des sozialen-Medienkontos ist ein Fehler entstanden, bitte versuchen Sie es später erneut',
                'update_error'           => 'Bei der Aktualisierung dieses Kontos ist ein Fehler entstanden, bitte versuchen Sie es später erneut',
                'update_password_error'  => 'Bei der Änderung des Passworts dieses Kontos ist ein Fehler entstanden, bitte versuchen Sie es später erneut',
            ],
        ],
    ],

    'frontend' =>[
        'auth' =>[
            'confirmation' =>[
                'already_confirmed'  => 'Dieses Konto wurde bereits verifiziert',
                'created'            => 'Konto erstellt',
                'confirm'            => 'Ihr Konto muss verifiziert werden',
                'created_confirm'    => 'Ihr Konto wurde erfolgreich erstellt, Ihnen wird eine E-Mail zur Verifizierung geschickt',
                'created_pending'    => 'Ihr Konto wurde erfolgreich erstellt, jedoch läuft die Überprüfung des Managements noch. Nach Abschluss wird Ihnen eine Bestätigungsmail geschickt',
                'mismatch'           => 'Der Bestätigungscode ist falsch, bitte kontrollieren Sie',
                'not_found'          => 'Wir haben einen solchen Bestätigungscode nicht verschickt, diesen haben Sie selbst erfunden',
                'pending'             => 'Ihre Überprüfung läuft, nur danach können Sie sich beim System anmelden. Nach Abschluss werden wir Ihnen eine E-Mail schicken.',
                'resend'             => 'Ihr Konto wurde noch nicht verifiziert. Zur Verifizierung klicken Sie auf die Verifizierungsverbindung in der E-Mail, die wir Ihnen geschickt haben oder klicken Sie  <a href="'.route('frontend.auth.account.confirm.resend', ':user_uuid').'"> hier für eine neue E-Mail',
                'success'            => 'Ihr Konto wurde erfolgreich verifiziert',
                'resent'             => 'Wir haben eine neue E-Mail zur Verifizierung an die bei uns registrierte E-Mail geschickt',
            ],

            'deactivated'  => 'Ihr Konto wurde suspendiert' ,
            'email_taken'  => 'Diese E-Mail Adresse wird bereits verwendet',

            'password' =>[
                'change_mismatch'  => 'Dies ist nicht Ihr altes Passwort',
                'reset_problem'  => 'Beim zurückstellen des Passworts ist ein Fehler entstanden, lassen Sie sich bitte eine neue E-Mail zur Zurückstellung des Passworts schicken',
            ],

            'registration_disabled'  => 'Im Moment erlauben wir keine neuen Registrierungen',
        ],
    ],
];
