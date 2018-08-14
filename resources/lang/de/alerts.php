<?php

return [

/*
|--------------------------------------------------------------------------
| Alert Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain alert messages for various scenarios
| during CRUD operations. You are free to modify these language lines
| according to your application's requirements.
|
*/

'backend' =>[
    'users' =>[
        'cant_resend_confirmation'  => 'Für diesen Prozess gebraucht es die Genehmigung des Managements, bitte warten Sie auf das Ergebnis der Analyse',
        'confirmation_email'  => 'Wir haben eine E-Mail zur Verifizierung an die bei uns registrierter E-Mail geschickt, bitte kontrollieren Sie Ihr E-Mail-Konto.',
        'confirmed'  => 'Benutzerkonto erfolgreich verifiziert',
        'created'  => 'Benutzerkonto erfolgreich erstellt',
        'deleted'  => 'Benutzerkonto erfolgreich gelöscht',
        'deleted_permanently'  => 'Benutzerkonto komplett gelöscht',
        'restored'  => 'Benutzerkonto gerettet',
        'session_cleared'  => 'Nutzersitzung abgeschlossen',
        'social_deleted'  => 'Das soziale-Medien Konto wurde erfolgreich aufgehoben',
        'unconfirmed'  => 'Das Benutzerkonto wurde noch nicht verifiziert',
        'updated'  => 'Die Benutzerdaten wurden erfolgreich aktualisiert',
        'updated_password'  => 'Passwort erfolgreich aktualisiert',
    ],
    'brokers' =>[
        'cant_resend_confirmation'  => 'Für diesen Prozess gebraucht es die Genehmigung des Managements, bitte warten Sie auf das Ergebnis der Analyse',
        'confirmation_email'  => 'Wir haben eine E-Mail zur Verifizierung an die bei uns registrierter E-Mail geschickt, bitte kontrollieren Sie Ihr E-Mail-Konto',
        'confirmed'  => 'Maklerkonto erfolgreich verifiziert',
        'created'  => 'Maklerkonto erfolgreich erstellt',
        'deleted'  => 'Maklerkonto gelöscht',
        'deleted_permanently'  => 'Maklerkonto komplett gelöscht',
        'restored'  => 'Maklerkonto gerettet',
        'session_cleared'  => 'Maklersitzung abgeschlossen',
        'social_deleted'  => 'Das soziale-Medien Konto wurde erfolgreich aufgehoben',
        'unconfirmed'  => 'Das Maklerkonto wurde noch nicht verifiziert',
        'updated'  => 'Maklerkonto erfolgreich aktualisiert',
        'updated_password'  => 'Maklerpasswort erfolgreich aktualisiert',
    ],
],

'frontend' =>[
    'contact' =>[
        'sent'  => 'Die von Ihnen gesendete Informationen ist bei uns eingegangen, wir werden Ihnen so schnell wie möglich antworten',
    ],
    'reportbroker' =>[
        'sent'  => 'Die von Ihnen gesendete Informationen ist bei uns eingegangen, wir werden den Prozess so schnell wie möglich durchführen',
    ],
],

'general' =>[
    'property_drafted'  => 'Eigenschaft erfolgreich Hinzugefügt wurde als Entwurf',
    'property_created'  => 'Anzeige erfolgreich erstellt',
    'property_created_against_property_request'  => 'Antwort auf die Anfrage auf Anzeigenerstellung :property_request_label Thema ist abgeschlossen da :property_label erstellt wurde.',
    'property_updated'  => 'Anzeige erfolgreich aktualisiert',
    'property_deleted'  => 'Anzeige erfolgreich gelöscht',
    'property_error_contract_not_confirmed'  => 'Sie können keine Anzeige erstellen bevor die Kooperationsvereinbarung, die Sie unterzeichnen müssen, bei uns eingegangen ist',
    'property_error_commission_not_defined'  => 'Sie können keine Anzeige erstellen, ohne Ihre Provisionssätze einzugeben',
    'property_limit_reached'  => 'Sie haben die maximale Anzahl für Anzeigen für Ihre Firma erreicht, Sie können keine weiteren Anzeigen aufgeben.',
    'settings_saved_with_file_error'  => 'Ihre Einstellungen wurden erfolgreich gespeichert, jedoch gab es ein Problem beim Hochladen des Vertrags, bitte versuchen Sie es später erneut',
    'property_type_created'  => 'Immobilienart erfolgreich gespeichert',
    'property_type_updated'  => 'Immobilienart erfolgreich aktualisiert',
    'property_type_deleted'  => 'Immobilienart erfolgreich gelöscht',
    'city_created'  => 'Stadt erfolgreich erstellt',
    'city_updated'  => 'Stadt erfolgreich aktualisiert',
    'city_deleted'  => 'Stadt erfolgreich gelöscht',
    'associated_city_cannot_be_deleted'  => 'Die gewählte Stadt kann nicht gelöscht werden, da mehrere Nutzer/Makler mit ihr verbunden sind. Zunächst müssen die mit dieser Stadt verbundenen Nutzer/Makler gelöscht werden',
    'district_created'  => 'Bezirk/Stadtkreis erfolgreich erstellt',
    'district_updated'  => 'Bezirk/Stadtkreis erfolgreich aktualisiert',
    'district_deleted'  => ' Bezirk/Stadtkreis erfolgreich gelöscht',

    'page_created'  => 'Seite erfolgreich erstellt',
    'page_updated'  => 'Seite erfolgreich aktualisiert',
    'page_deleted'  => 'Seite erfolgreich gelöscht',
    'image_removed'  => 'Das ausgewählte Bild wurde erfolgreich gelöscht',
    'request_in_progress'  => 'Ihre Anfrage wird bearbeitet, die Rechnung wird Sie in Kürze erreichen, bitte warten Sie auf Antwort von uns',
]
];






















