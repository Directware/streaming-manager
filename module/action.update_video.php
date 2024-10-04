<?php

if (isset($_POST['submit_cancel_edit_video'])) {
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
    return;
}

if (isset($_POST['submit_update_video'])) {
    $videoId = $_POST['video_id'];

    if (!$videoId) {
        $params['error'] = $this->Lang('ErrorVideoIdNotProvided');
        $this->Redirect($id, 'edit_video', $returnid, $params);
        return;
    }

    // TODO: implement 

    $params['message'] = $this->Lang('SuccessVideoUpdated');
    $this->Redirect($id, 'defaultadmin', $returnid, $params);
}
