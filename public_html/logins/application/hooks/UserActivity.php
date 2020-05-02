<?php

class UserActivity
{
    public function saveActivity()
    {	
        $ci = & get_instance();

        /// ignore controller

        $activeClass = $ci->router->fetch_class();
        $activeClass = strtolower($activeClass);
        if($activeClass == strtolower('Upload') || $activeClass == strtolower('TestUpload')){
            return;
        }

        /// save activity only for candidate
        

        if(isset($ci->session->userdata['user_type']) && $ci->session->userdata['user_type'] != 'CANDIDATE'){
            return;
        }

        if(isset($ci->session->userdata['user']) && $ci->session->userdata['user']){
            $activity = [
            'user_id' => $ci->session->userdata['user'],
            'activity_url' => current_url(),
            'agent_string' => $ci->agent->agent,        
            ];

            if(isset($ci->session->userdata['interview_user'])){
                $candidate_id = $ci->session->userdata['interview_user'];
                $interview_detail = $ci->interview_model->getInterviewDetails($candidate_id);
                $activity['invite_interview_id'] = $interview_detail['invite_id'];            
            }

            $activity['activity_message'] = $ci->User_activity_model->getActivityMessage($activity['activity_url'], $ci->router);
            $ci->User_activity_model->addActivity($activity);
        }

        return;
    }
}