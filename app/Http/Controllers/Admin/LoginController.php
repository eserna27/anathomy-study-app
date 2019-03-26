<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Input;
use Redirect;
use Auth;

class LoginController extends Controller
{
  public function login()
  {
      return view('admin.login.show');
  }

  public function log()
  {
    // validate the info, create rules for the inputs
    $rules = array(
        'email'    => 'required|email', // make sure the email is an actual email
        'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
    );

    // run the validation rules on the inputs from the form
    $validator = Validator::make(Input::all(), $rules);

    // if the validator fails, redirect back to the form
    if ($validator->fails()) {
        return Redirect::to(route('admin.login'))
            ->withErrors($validator) // send back all errors to the login form
            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
    } else {
        // create our user data for the authentication
        $admindata = array(
          'email'     => Input::get('email'),
          'password'  => Input::get('password')
        );
        // attempt to do the login
        if (Auth::attempt($admindata)) {
            dd("hola");
            // validation successful!
            // redirect them to the secure section or whatever
            // return Redirect::to('secure');
            // for now we'll just echo success (even though echoing in a controller is bad)
            echo 'SUCCESS!';

        } else {
            // validation not successful, send back to form
            return Redirect::to(route('admin.login'));

        }

    }
  }
}
