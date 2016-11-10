<?php
if(!function_exists('user'))
{
    /**
     * Quick method for returning the user
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function user()
    {
        return auth()->user();
    }
}