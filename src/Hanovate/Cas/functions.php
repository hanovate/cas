<?php
/***********************************
 * Author: Zach
 * Date: 4/11/16
 * Licence: MIT
 *
 * updated by
 * Michael Han (mhan1@unm.edu)
 * on 2020-04-14
 ***********************************/

if ( ! function_exists('cas')) {
    /**
     * Initiate CAS hook.
     *
     * @return \Hanovate\Cas\CasManager
     */
    function cas()
    {
        return app('cas');
    }
}
