<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;

/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request)
    {
        $output = $this->userRepository->update(
            $request->user()->id,
            $request->only(
                'first_name',
                'last_name', 
                'email', 
                'avatar_type', 
                'avatar_location', 
                'contract_file', 
                'timezone',
                'commission_sale_landlord',
                'commission_sale_buyer',
                'commission_rent_landlord',
                'commission_rent_tenant'
            ),

            $request->has('avatar_location') ? $request->file('avatar_location') : false,
            $request->has('contract_file') ? $request->file('contract_file') : false
        );

        // E-mail address was updated, user has to reconfirm
        if (is_array($output) && $output['email_changed']) {
            auth()->logout();

            return redirect()->route('frontend.auth.login')->withFlashInfo(__('strings.frontend.user.email_changed_notice'));
        }

        return redirect()->route('admin.account')->withFlashSuccess(__('strings.frontend.user.profile_updated'));
    }
}
