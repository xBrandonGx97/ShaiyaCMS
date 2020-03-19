<?php
  class Auth
  {
      // similar to laravels auth class
      public function check()
      {
          // Check if user is logged in
      }

      public function attempt($credentials)
      {
          // Authentication passed
      }

      public function login($user, $remember = false)
      {
          // Log user in
      }

      public function loginUsingId($user, $remember = false)
      {
          // Log user in using their primary id
      }

      public function logout()
      {
          // Log user out
      }

      public function viaRemember()
      {
          // was authenticated from remember me cookie
      }
  }
