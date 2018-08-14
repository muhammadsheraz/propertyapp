<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\ApiController;
use App\Repositories\Api\Auth\UserRepository;
use App\Http\Requests\Api\User\UpdateProfileRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Auth\User;

/**
 * Class ProfileController.
 */
class ProfileController extends ApiController
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
    public function index()
    {
		return response()->json([
			'data' => [
				'customer'=>auth()->user()->getUserData(),
				'message'=>__('strings.frontend.user_found'),
				'status'=>'success'
			]
		]);	
	}

    public function update(UpdateProfileRequest $request)
    {
		try {
			$output = $this->userRepository->update(
				$request->user()->id,
				$request->only(
					'first_name',
					'last_name',
					'city_id',
					'district_id',
					'phone_no'
				),
				$request->has('avatar_location') ? $request->file('avatar_location') : false
			);

			if (!empty($request->input('password'))) {
				$this->userRepository->updatePassword($request->only('password'));
			}

			// E-mail address was updated, user has to reconfirm
			if (is_array($output) && $output['email_changed']) {
				auth()->logout();

				// E-mail address was updated, user has to reconfirm
				if (is_array($output) && $output['email_changed']) {
					auth()->logout();

					return response()->json([
						'data' => [
							'customer'=>auth()->user()->getUserData(),
							'message'=>__('strings.frontend.user.email_changed_notice'),
							'status'=>'success'
						]
					]);			
				}
			}

			return response()->json([
				'data' => [
					'customer'=>auth()->user()->getUserData(),
					'message'=>__('strings.frontend.user.profile_updated'),
					'status'=>'success'
				]
			]);		
		} catch (\Exception $e) {
			return response()->json([
				'data' => [
					'message'=>$e->getMessage() . " at :" . $e->getLine(),
					'status'=>'error'
				]
			]);
		}
	}
	
    public function avatar(UpdateProfileRequest $request)
    {		
		$error = [];

		try {
			$request->validate([
				'profile_image' => 'required|image',
			]);

			$output = $this->userRepository->updateAvatar(
				$request->user()->id,
				$request->has('profile_image') ? $request->file('profile_image') : false
			);

			if ($output) {
				return response()->json([
					'data' => [
						'message'=>__('strings.frontend.user.profile_image_updated'),
						'customer'=>auth()->user()->getUserData(),
						'status'=>'success'
					]
				]);
			} else {
				return response()->json([
					'data' => [
							'message'=>__('strings.frontend.user.profile_image_not_updated'),
							'status'=>'error'
						]
					], 422, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			}
		} catch (\Exception $e) {
			return response()->json([
				'data' => [
						'message'=>$e->getMessage() . " at :" . $e->getLine(),
						'status'=>'error'
					]
				], 422, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
			}
    }

    public function show(Request $request)	{
    	return response()->json([
			'data' => [
				'message'=>'Success GET'
			]
        ]);

	}


	public function create(Request $request)
	{
		return response()->json([
			'data' => [
				'message'=>'Success POST'
			]
        ]);
	}	
	


}
