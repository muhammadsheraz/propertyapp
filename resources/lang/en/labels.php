<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' =>[
        'all'      => 'All',
        'yes'      => 'Yes',
        'no'       => 'No',
        'copyright'  => 'Copyright',
        'custom'   => 'Custom',
        'actions'  => 'Actions',
        'active'   => 'Active',
        'canceled'   => 'Canceled',
        'completed'   => 'Completed',
        'buttons' =>[
            'close'    => 'Close',
            'save'    => 'Save',
            'update'  => 'Update',
        ],
        'hide'               => 'Hide',
        'inactive'           => 'Inactive',
        'none'               => 'None',
        'show'               => 'Show',
        'view_property'  => 'View Property',
        'commission_sale'  => 'Commission For Sale',
        'commission_rent'  => 'Commission For Rent',
        'commission_from_landlord'  => 'From Landlord',
        'commission_from_buyer'  => 'From Buyer',
        'commission_from_tenant'  => 'From Tenant',
        'property_type'  => 'Property Type',
        'rooms'  => 'Rooms',
        'price'  => 'Price',
        'search'  => 'Search',
        'property_purpose'  => 'Property Purpose',
        'property_limit'  => 'Property Limit',
    ],

    'location' =>[
        'city'      => 'City',
        'district'      => 'District',
    ],

    'properties' =>[
        'management'      => 'Properties Management',
        'create'      => 'Create Property',
        'view'      => 'View Property',
    ],

    'backend' =>[
        'access' =>[
            'roles' =>[
                'create'      => 'Create Role',
                'edit'        => 'Edit Role',
                'management'  => 'Role Management',

                'table' =>[
                    'number_of_users'  => 'Number of Users',
                    'permissions'      => 'Permissions',
                    'role'             => 'Role',
                    'sort'             => 'Sort',
                    'total'            => 'role total|roles total',
                ],
            ],

            'users' =>[
                'active'               => 'Active Users',
                'all_permissions'      => 'All Permissions',
                'change_password'      => 'Change Password',
                'change_password_for'  => 'Change Password for :user',
                'create'               => 'Create User',
                'deactivated'          => 'Deactivated Users',
                'deleted'              => 'Deleted Users',
                'edit'                 => 'Edit User',
                'management'           => 'User Management',
                'no_permissions'       => 'No Permissions',
                'no_roles'             => 'No Roles to set.',
                'permissions'          => 'Permissions',

                'table' =>[
                    'confirmed'       => 'Confirmed',
                    'created'         => 'Created',
                    'email'           => 'E-mail',
                    'id'              => 'ID',
                    'last_updated'    => 'Last Updated',
                    'name'            => 'Name',
                    'first_name'      => 'First Name',
                    'last_name'       => 'Last Name',
                    'no_deactivated'  => 'No Deactivated Users',
                    'no_deleted'      => 'No Deleted Users',
                    'other_permissions'  => 'Other Permissions',
                    'permissions'  => 'Permissions',
                    'social'  => 'Social',
                    'total'           => 'user total|users total',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Overview',
                        'history'   => 'History',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Avatar',
                            'confirmed'     => 'Confirmed',
                            'created_at'    => 'Created At',
                            'deleted_at'    => 'Deleted At',
                            'email'         => 'E-mail',
                            'last_updated'  => 'Last Updated',
                            'name'          => 'Name',
                            'first_name'    => 'First Name',
                            'last_name'     => 'Last Name',
                            'status'        => 'Status',
                        ],
                    ],
                ],

                'view'  => 'View User',
            ],

            'brokers' =>[
                'active'               => 'Active Brokers',
                'all_permissions'      => 'All Permissions',
                'change_password'      => 'Change Password',
                'change_password_for'  => 'Change Password for :user',
                'create'               => 'Create Broker',
                'deactivated'          => 'Deactivated Brokers',
                'deleted'              => 'Deleted Brokers',
                'edit'                 => 'Edit User',
                'management'           => 'Broker Management',
                'no_permissions'       => 'No Permissions',
                'no_roles'             => 'No Roles to set.',
                'permissions'          => 'Permissions',

                'table' =>[
                    'confirmed'       => 'Confirmed',
                    'created'         => 'Created',
                    'email'           => 'E-mail',
                    'id'              => 'ID',
                    'last_updated'    => 'Last Updated',
                    'name'            => 'Name',
                    'first_name'      => 'First Name',
                    'properties'  => 'Properties',
                    'last_name'       => 'Last Name',
                    'no_deactivated'  => 'No Deactivated Brokers',
                    'no_deleted'      => 'No Deleted Brokers',
                    'other_permissions'  => 'Other Permissions',
                    'permissions'  => 'Permissions',
                    'roles'           => 'Roles',
                    'social'  => 'Social',
                    'total'           => 'user total|brokers total',
                    'broker_no'           => 'Broker Id',
                    'customer_no'           => 'Customer Id',
                    'profile_photo'           => 'Profile Photo',
                    'change_profile_photo'           => 'Change Profile Photo',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Overview',
                        'history'   => 'History',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Avatar',
                            'confirmed'     => 'Confirmed',
                            'created_at'    => 'Created At',
                            'deleted_at'    => 'Deleted At',
                            'email'         => 'E-mail',
                            'last_updated'  => 'Last Updated',
                            'name'          => 'Name',
                            'first_name'    => 'First Name',
                            'last_name'     => 'Last Name',
                            'status'        => 'Status',
                        ],
                    ],
                ],

                'view'  => 'View Broker',
            ],

            'customers' =>[
                'active'               => 'Active Customers',
                'all_permissions'      => 'All Permissions',
                'change_password'      => 'Change Password',
                'change_password_for'  => 'Change Password for :user',
                'create'               => 'Create Broker',
                'deactivated'          => 'Deactivated Customers',
                'deleted'              => 'Deleted Customers',
                'edit'                 => 'Edit User',
                'management'           => 'Customer Management',
                'no_permissions'       => 'No Permissions',
                'no_roles'             => 'No Roles to set.',
                'permissions'          => 'Permissions',

                'table' =>[
                    'confirmed'       => 'Confirmed',
                    'created'         => 'Created',
                    'email'           => 'E-mail',
                    'id'              => 'ID',
                    'last_updated'    => 'Last Updated',
                    'name'            => 'Name',
                    'first_name'      => 'First Name',
                    'properties'  => 'Properties',
                    'last_name'       => 'Last Name',
                    'no_deactivated'  => 'No Deactivated Customers',
                    'no_deleted'      => 'No Deleted Customers',
                    'other_permissions'  => 'Other Permissions',
                    'permissions'  => 'Permissions',
                    'roles'           => 'Roles',
                    'social'  => 'Social',
                    'total'           => 'user total|customers total',
                    'broker_no'           => 'Broker Id',
                    'customer_no'           => 'Customer Id',
                    'profile_photo'           => 'Profile Photo',
                    'change_profile_photo'           => 'Change Profile Photo',
                ],

                'tabs' =>[
                    'titles' =>[
                        'overview'  => 'Overview',
                        'history'   => 'History',
                    ],

                    'content' =>[
                        'overview' =>[
                            'avatar'        => 'Avatar',
                            'confirmed'     => 'Confirmed',
                            'created_at'    => 'Created At',
                            'deleted_at'    => 'Deleted At',
                            'email'         => 'E-mail',
                            'last_updated'  => 'Last Updated',
                            'name'          => 'Name',
                            'first_name'    => 'First Name',
                            'last_name'     => 'Last Name',
                            'status'        => 'Status',
                        ],
                    ],
                ],

                'view'  => 'View Broker',
            ],
        ],
    ],

    'frontend' =>[

        'auth' =>[
            'login_box_title'     => 'Login',
            'login_button'        => 'Login',
            'download_contract'        => 'Download Contract',
            'login_with'          => 'Login with :social_media',
            'register_box_title'  => 'Register',
            'register_button'     => 'Register',
            'remember_me'         => 'Remember Me',
        ],

        'contact' =>[
            'box_title'  => 'Contact Us',
            'button'  => 'Send Information',
        ],

        'passwords' =>[
            'expired_password_box_title'  => 'Your password has expired.',
            'forgot_password'                  => 'Forgot Your Password?',
            'reset_password_box_title'         => 'Reset Password',
            'reset_password_button'            => 'Reset Password',
            'update_password_button'            => 'Update Password',
            'send_password_reset_link_button'  => 'Send Password Reset Link',
        ],

        'user' =>[
            'passwords' =>[
                'change'  => 'Change Password',
            ],

            'profile' =>[
                'avatar'              => 'Avatar',
                'created_at'          => 'Created At',
                'edit_information'    => 'Edit Information',
                'email'               => 'E-mail',
                'last_updated'        => 'Last Updated',
                'name'                => 'Name',
                'first_name'          => 'First Name',
                'last_name'           => 'Last Name',
                'update_information'  => 'Update Information',
            ],
        ],

    ],
];
