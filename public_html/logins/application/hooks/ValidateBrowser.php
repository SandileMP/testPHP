<?php

class ValidateBrowser
{
    public function checkBrowser()
    {	
        $ci = & get_instance();

        $desktop = (!$ci->agent->is_mobile() && strpos(strtolower($ci->agent->agent),'chrome'));
        $mobileAnd =  (strpos(strtolower($ci->agent->agent),'android') && strpos(strtolower($ci->agent->agent),'chrome'));
        $mobileIos =  (strpos(strtolower($ci->agent->agent),'mac os') && (!strpos(strtolower($ci->agent->agent),'crios')));
        $mobile = ($mobileAnd || $mobileIos);
        $browser  = ($desktop || $mobile);
        $allow = $ci->router->fetch_class();

        if (!$browser && !in_array($allow, array('browserError', 'BrowserError', 'interview', 'Interview')))
        {
            redirect(site_url('/browserError'));
        }
        return;
    }
}


