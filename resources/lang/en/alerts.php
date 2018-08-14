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
    
    'backend'  => [
        'users'  => [
            'cant_resend_confirmation'  => 'Applications are manually approved by administration so please wait now',
            'confirmation_email'  => 'A confirmation email is sent, please check your email address',
            'confirmed'  => 'User is successfully confirmed',
            'created'  => 'User is successfully created.',
            'deleted'  => 'User is successfully deleted',
            'deleted_permanently'  => 'User is deleted permanently',
            'restored'  => 'User is successfully restored',
            'session_cleared'  => "User's session was successfully cleared",
            'social_deleted'  => 'Social Account is successfully removed',
            'unconfirmed'  => 'User has not been confirmed yet',
            'updated'  => 'User data is successfully updated',
            'updated_password'  => 'Password is successfully updated',
        ],
        'brokers'  => [
            'cant_resend_confirmation'  => 'Applications are manually approved by administration so please wait now',
            'confirmation_email'  => 'A confirmation email is sent, please check your email address',
            'confirmed'  => 'Broker is succesfully confirmed',
            'created'  => 'Broker is successfully created',
            'deleted'  => 'Broker is successfully deleted',
            'deleted_permanently'  => 'Broker is deleted permanently',
            'restored'  => 'Broker is successfully restored',
            'session_cleared'  => "Broker's session is successfully cleared",
            'social_deleted'  => 'Social account is successfully removed',
            'unconfirmed'  => 'Broker has not been confirmed yet',
            'updated'  => 'Broker data is successfully updated',
            'updated_password'  => " Password is successfully updated",
        ],
    ],
    
    'frontend'  => [
        'contact'  => [
            'sent'  => "We received what you've sent and will reply your email as soon as possible"
        ],
        'reportbroker'  => [
            'sent'  => "We received what you've sent and will take necessary action as soon as possible"
        ],
    ],
    
    'general'  => [
        'property_drafted'  => 'Property is successfully added as draft',
        'property_created'  => 'Property is created successfully',
        'property_created_against_property_request'  => 'Property :property_label has been created against Property Request :property_request_label. This thread has been closed now.',
        'property_updated'  => 'Property data is updated successfully',
        'property_deleted'  => 'Property is  deleteted successfully',
        'property_error_contract_not_confirmed'  => ' You can not add a property yet, because your signed contract has not arrived us yet',
        'property_error_commission_not_defined'  => 'You can not add a property before adding your general commission rates on your profile',
        'property_limit_reached'  => 'You can not add a new listing because of your listing limits',
        'settings_saved_with_file_error'  => 'Settings have been saved successfully. But an error is occurred while uploading contract file, please try again soon',
        'property_type_created'  => 'Property type is created successfully',
        'property_type_updated'  => 'Property type is updated successfully',
        'property_type_deleted'  => 'Property type is deleted successfully',
        'city_created'  => 'City is created successfully',
        'city_updated'  => 'City is updated successfully',
        'city_deleted'  => 'City is deleted successfully',
        'associated_city_cannot_be_deleted'  => 'Selected city can not be deleted, there are one or more broker/user associated to that. Please delete that first and then try again',
        'district_created'  => 'District is created successfully',
        'district_updated'  => 'District is updated successfully',
        'district_deleted'  => 'District is deleted successfully', 
        
        'page_created'  => 'Page is created successfully',
        'page_updated'  => 'Page is updated successfully',
        'page_deleted'  => 'Page is deleted successfully', 
        'image_removed'  => 'Selected image has been removed', 
        'request_in_progress'  => 'Your request is in progress, we will create your invoice shortly, please wait now'
    ]
];