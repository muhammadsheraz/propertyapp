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
                'already_exists'     => 'Bu rol zaten mevcut, lütfen başka bir rol adı seçin',
                'cant_delete_admin'  => 'Yönetici rolünü silemezsiniz',
                'create_error'       => 'Bu rolün oluşturulması sırasında bir hata oluştu, lütfen daha sonra tekrar deneyin',
                'delete_error'       => 'Bu rolün silinmesi sırasında bir hata oluştu, lütfen daha sonra tekrar deneyin',
                'has_users'          => 'Kullanıcılarla ilişkisi olan bir rolü silemezsiniz',
                'needs_permission'   => 'Bu rol için en azından bir görev yetkisi vermelisiniz',
                'not_found'          => 'Böyle bir tanımlanmış rol yok',
                'update_error'       => 'Bu rolün güncellenmesi sırasında bir hata oluştu, lütfen daha sonra tekrar deneyin',
            ],

            'users' =>[
                'already_confirmed'     => 'Bu kullanıcı zaten doğrulandı',
                'cant_confirm'  => 'Bu kullanıcı hesabının doğrulanması sırasında bir hata oluştu',
                'cant_deactivate_self'   => 'Hesabınızı kendini etkisizleştiremezsiniz, yönetimden rica edin',
                'cant_delete_admin'   => 'Süper yöneticiyi silemezsiniz',
                'cant_delete_self'       => 'Kendi hesabınızı silemezsiniz,yönetimden rica edin',
                'cant_delete_own_session'  => 'Kendi oturumunuzu silemezsiniz',
                'cant_restore'           => 'Bu hesap henüz silinmediği için kurtarmaya gerek yok',
                'cant_unconfirm_admin'  => 'Süper yöneticiyi geçersizleştiremezsiniz',
                'cant_unconfirm_self'  => 'Geçersizleştirmeyi kendiniz yapamazsınız',
                'create_error'           => 'Bu kullanıcıyı oluştururken bir hata oluştu, lütfen daha sonra tekrar deneyin',
                'delete_error'           => 'Bu kullanıcıyı silerken bir hata oluştu, lütfen daha sonra tekrar deneyin',
                'delete_first'           => 'Bu kullanıcıyı tamamen silmeden önce basit silme işlemi yapılmalı',
                'email_error'            => 'Bu email adresi başka bir kullanıcıya ait',
                'mark_error'             => 'Bu kullanıcı bilgilerini güncellerken bir hata oluştu, lütfen daha sonra tekrar deneyin',
                'not_confirmed'             => 'Bu kullanıcı hesabı henüz doğrulanmadı',
                'not_found'              => 'Böyle bir kullanıcı yok',
                'restore_error'          => 'Bu kullanıcı hesabını kurtarırken bir hata oluştu, lütfen daha sonra tekrar deneyin',
                'role_needed_create'     => 'En azından bir rol seçmelisiniz',
                'role_needed'            => 'En azından bir rol seçmelisiniz',
                'session_wrong_driver'   => 'Bu sürücüyü kullanmak için oturum sürücünüzün veritabanı olarak ayarlanması gerekiyor',
                'social_delete_error'  => 'Sosyal hesabın kaldırılması sırasında bir sorun oluştu, lütfen daha sonra tekrar deneyin',
                'update_error'           => 'Bu hesabın güncellenmesi sırasında bir hata oluştu, lütfen daha sonra tekrar deneyin',
                'update_password_error'  => 'Bu hesabın şifre değiştirme işlemi sırasında bir hata oluştu lütfen daha sonra tekrar deneyin',
            ],
        ],
    ],

    'frontend' =>[
        'auth' =>[
            'confirmation' =>[
                'already_confirmed'  => 'Bu hesap zaten doğrulandı',
                'created'            => 'Hesap oluşturuldu',
                'confirm'            => 'Hesabınızın doğrulanması gerekiyor',
                'created_confirm'    => 'Hesabınız başarıyla oluşturuldu, size bir onay emaili gönderdik',
                'created_pending'    => 'Hesabınız başarıyla oluşturuldu ancak yönetim incelemesi halen sürmekte. İşlem bittiğinde size bir onay emaili göndereceğiz',
                'mismatch'           => 'Doğrulama kodu yanlış girilmiş, kontrol edin',
                'not_found'          => 'Böyle bir doğrulama kodu göndermedik, kendiniz uydurmuşsunuz',
                'pending'             => 'İncelememiz sürüyor, ancak bu işlem bittiğinde sisteme giriş yapabilirsiniz. Bittiğinde size bir email göndereceğiz.',
                'resend'             => 'Henüz hesabınız doğrulanmadı. Doğrulamak için size gönderilen emailin içindeki doğrulama bağlatısına tıklayın, ya da yeni bir doğrulama emaili için <a href="'.route('frontend.auth.account.confirm.resend', ':user_uuid').'">buraya tıklayın</a>',
                'success'            => 'Hesabınız başarıyla doğrulandı',
                'resent'             => 'Kayıtlarımızdaki email adresinize yeni bir doğrulama emaili gönderdik',
            ],

            'deactivated'  => 'Hesabınız askıya alındı',
            'email_taken'  => 'Bu email adresi zaten kullanımda',

            'password' =>[
                'change_mismatch'  => 'Bu sizin eski şifreniz değil',
                'reset_problem'  => 'Şifre sıfırlanması sırasında bir hata oluştu, lütfen sıfırlama emailini tekrar talep edin',
            ],

            'registration_disabled'  => 'Şuan için yeni kayıt kabul etmiyoruz',
        ],
    ],
];
