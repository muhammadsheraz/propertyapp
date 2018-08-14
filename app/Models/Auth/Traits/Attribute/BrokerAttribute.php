<?php

namespace App\Models\Auth\Traits\Attribute;

/**
 * Trait UserAttribute.
 */
trait BrokerAttribute
{
    /**
     * @return string
     */
    public function getStatusLabelBrokerAttribute()
    {
        if ($this->isActive()) {
            return "<span class='badge badge-success'>".__('labels.general.active').'</span>';
        }

        return "<span class='badge badge-danger'>".__('labels.general.inactive').'</span>';
    }

    /**
     * @return string
     */
    public function getConfirmedLabelBrokerAttribute()
    {
        if ($this->isConfirmed()) {
            if ($this->id != 1 && $this->id != auth()->id()) {
                return '<a href="'.route('admin.auth.broker.unconfirm',
                        $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.users.unconfirm').'" name="confirm_item"><span class="badge badge-success" style="cursor:pointer">'.__('labels.general.yes').'</span></a>';
            } else {
                return '<span class="badge badge-success">'.__('labels.general.yes').'</span>';
            }
        }

        return '<a href="'.route('admin.auth.broker.confirm', $this).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.users.confirm').'" name="confirm_item"><span class="badge badge-danger" style="cursor:pointer">'.__('labels.general.no').'</span></a>';
    }

    /**
     * @return string
     */
    public function getRolesLabelBrokerAttribute()
    {
        $roles = $this->getRoleNames()->toArray();

        if (count($roles)) {
            return implode(', ', array_map(function ($item) {
                return ucwords($item);
            }, $roles));
        }

        return 'N/A';
    }

    /**
     * @return string
     */
    public function getPermissionsLabelBrokerAttribute()
    {
        $permissions = $this->getDirectPermissions()->toArray();

        if (count($permissions)) {
            return implode(', ', array_map(function ($item) {
                return ucwords($item['name']);
            }, $permissions));
        }

        return 'N/A';
    }

    /**
     * @return string
     */
    public function getFullNameBrokerAttribute()
    {
        return $this->last_name
            ? $this->first_name.' '.$this->last_name
            : $this->first_name;
    }

    /**
     * @return string
     */
    public function getNameBrokerAttribute()
    {
        return $this->full_name;
    }

    /**
     * @return mixed
     */
    public function getPictureBrokerAttribute()
    {
        return $this->getPicture();
    }

    /**
     * @return string
     */
    public function getSocialButtonsBrokerAttribute()
    {
        $accounts = [];

        foreach ($this->providers as $social) {
            $accounts[] = '<a href="'.route('admin.auth.broker.social.unlink',
                    [$this, $social]).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.users.unlink').'" data-method="delete"><i class="fa fa-'.$social->provider.'"></i></a>';
        }

        return count($accounts) ? implode(' ', $accounts) : 'None';
    }

    /**
     * @return string
     */
    public function getLoginAsButtonBrokerAttribute()
    {
        /*
         * If the admin is currently NOT spoofing a user
         */
        // if (! session()->has('admin_user_id') || ! session()->has('temp_user_id')) {
        //     //Won't break, but don't let them "Login As" themselves
        //     if ($this->id != auth()->id()) {
        //         return '<a href="'.route('admin.auth.broker.login-as',
        //                 $this).'" class="dropdown-item">'.__('buttons.backend.access.users.login_as', ['user' => $this->full_name]).'</a> ';
        //     }
        // }

        return '';
    }

    /**
     * @return string
     */
    public function getClearSessionButtonBrokerAttribute()
    {
        if ($this->id != auth()->id() && config('session.driver') == 'database') {
            return '<a href="'.route('admin.auth.broker.clear-session', $this).'"
			 	 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="'.__('buttons.general.continue').'"
                 data-trans-title="'.__('strings.backend.general.are_you_sure').'"
                 class="dropdown-item" name="confirm_item">'.__('buttons.backend.access.users.clear_session').'</a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getShowButtonBrokerAttribute()
    {
        return '<a href="'.route('admin.auth.broker.show', $this).'" class="btn btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.view').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonBrokerAttribute()
    {
        return '<a href="'.route('admin.auth.broker.edit', $this).'" class="btn btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.edit').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getChangePasswordButtonBrokerAttribute()
    {
        return '<a href="'.route('admin.auth.broker.change-password', $this).'" class="dropdown-item">'.__('buttons.backend.access.users.change_password').'</a> ';
    }

    /**
     * @return string
     */
    public function getStatusButtonBrokerAttribute()
    {
        // if ($this->id != auth()->id()) {
        //     switch ($this->active) {
        //         case 0:
        //             return '<a href="'.route('admin.auth.broker.mark', [
        //                     $this,
        //                     1,
        //                 ]).'" class="dropdown-item">'.__('buttons.backend.access.users.activate').'</a> ';
        //         // No break

        //         case 1:
        //             return '<a href="'.route('admin.auth.broker.mark', [
        //                     $this,
        //                     0,
        //                 ]).'" class="dropdown-item">'.__('buttons.backend.access.users.deactivate').'</a> ';
        //         // No break

        //         default:
        //             return '';
        //         // No break
        //     }
        // }

        return '';
    }

    /**
     * @return string
     */
    public function getConfirmedButtonBrokerAttribute()
    {
        if (! $this->isConfirmed() && ! config('access.users.requires_approval')) {
            return '<a href="'.route('admin.auth.broker.account.confirm.resend', $this).'" class="dropdown-item">'.__('buttons.backend.access.users.resend_email').'</a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonBrokerAttribute()
    {
        if ($this->id != auth()->id() && $this->id != 1) {


            $properties_count = 0;
            $broker_delete_class = 'broker-delete';

            if (config('app.safe_broker_delete')) {
                $properties_count = $this->properties_count;
            }

            if ($properties_count > 0) {
                $button_title = __('strings.backend.general.are_you_sure_assign_properties');
                $button_delete = __('buttons.general.assign_and_delete');
            } else {
                $button_title = __('strings.backend.general.are_you_sure');
                $button_delete = __('buttons.general.delete');
            }            

            $attrHtml = '<a href="' . route('admin.auth.broker.destroy', $this) . '"
                 data-method="delete"
                 data-broker-id="' . $this->id . '"
                 data-properties-count="' . $properties_count . '"
                 data-trans-button-cancel="'.__('buttons.general.cancel').'"
                 data-trans-button-confirm="' . $button_delete . '"
                 data-trans-title="' . $button_title . '"
                 class="dropdown-item ' . $broker_delete_class . '">' . __('buttons.general.delete') . '</a>';

            
            return $attrHtml;
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeletePermanentlyButtonBrokerAttribute()
    {
        return '<a href="'.route('admin.auth.broker.delete-permanently', $this).'" name="confirm_item" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.users.delete_permanently').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getRestoreButtonBrokerAttribute()
    {
        return '<a href="'.route('admin.auth.broker.restore', $this).'" name="confirm_item" class="btn btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="'.__('buttons.backend.access.users.restore_user').'"></i></a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsBrokerAttribute()
    {
        if ($this->trashed()) {
            return '
				<div class="btn-group btn-group-sm" role="group" aria-label="User Actions">
				  '.$this->restore_button_broker.'
				  '.$this->delete_permanently_button_broker.'
				</div>';
        }

        return '
    	<div class="btn-group btn-group-sm" role="group" aria-label="User Actions">
		  '.$this->show_button_broker.'
		  '.$this->edit_button_broker.'
		
		  <div class="btn-group" role="group">
			<button id="userActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  ' . __('strings.frontend.more') . '
			</button>
			<div class="dropdown-menu" aria-labelledby="userActions">
			  '.$this->clear_session_button_broker.'
			  '.$this->login_as_button_broker.'
			  '.$this->change_password_button_broker.'
			  '.$this->status_button_broker.'
			  '.$this->confirmed_button_broker.'
			  '.$this->delete_button_broker.'
			</div>
		  </div>
		</div>';
    }
}
