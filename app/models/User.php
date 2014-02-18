<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Cartalyst\Sentry\Users\Eloquent\User implements UserInterface, RemindableInterface {

	public static $rules = array(
		'first_name' 	=> 'required',
		'last_name' 	=> 'required',
		'password'		=> 'required',
		'email'			=> 'required|unique:users,email',
		'tin_number'	=> 'required|str_len:12|unique:users,tin_number',
		'home_address'	=> 'required',
		'work_address'  => 'required',
		'company'		=> 'required',
		'mobile'		=> 'required|numeric|str_len:11',
		'landline'		=> 'str_len:7|numeric',
		'occupation'	=> 'required'
	);

	public static function get_rules($id = null)
	{
		$rules = User::$rules;
		if(is_null($id))
		{
			return $rules;
		}else{
			$rules['password'] = 'min:8';
			$rules['email'] = 'required|unique:users,email,'.$id;
			$rules['tin_number'] = 'required|unique:users,tin_number,'.$id;
		}
		return $rules;
	}

	protected $softDelete = true;

	protected $appends = array('status');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getStatusAttribute()
	{
		if($this->activated == false || $this->activated == 0)
		{
			return '<span class="label label-danger">Inactive</span>';
		}else{
			return '<span class="label label-success">Active</span>';
		}
	}
}