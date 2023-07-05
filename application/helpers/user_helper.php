<?php


function insertUpdateUserOrExpert($postData): array
{
    $ci = &get_instance();
    $ci->load->helper('status_helper');
    $filePath = '';
    $getFileName = '';
    $uniqueNumber = random_num(10);
    $date='0000-00-00';
    if (isset($post['dob']) && !empty($post['dob'])) {
       $date = date('Y-m-d', strtotime($post['date']));
       //$date = date_format(date_create_from_format('d/m/Y', stripslashes($post['dob'])), 'Y-m-d');
    }
    $data = array(
        'u_e_id' => $uniqueNumber,
        'name' => $postData['name'] ?? '',
        'email_id' => $postData['email_id'] ?? '',
        'password' => $postData['password'] ?? '',
        'user_type' => $postData['user_type'] ?? '',
        'login_type' => $postData['login_type'] ?? '',
        'firebase_id' => $postData['firebaseid'] ?? '',
        'nick_name' => $postData['nick_name'] ?? '',
        'dob' => $date ?? '',
        'phone_number' => $postData['phone_number'] ?? '',
        'address' => $postData['address'] ?? '',
        'gender' => $postData['gender'] ?? '',
        'expert_sports' => $postData['expert_sports'] ?? ''
    );
    log_message('error',"expert value :::::".trim(strtoupper($postData['user_type'])));
        if (empty($postData['id']) && trim(strtoupper($postData['user_type'])) == 'EXPERT' && empty($postData['password'])) {
            log_message('error','password update ');
            $data['password'] = random_num(10);
        }
  
// $postData['id'] this means update user or expert
    if (empty($postData['id'])) {
        $getValidationData = userMailMobileValidation($data);
        if (!empty($getValidationData)) {
            return $getValidationData;
        }
    }
    if (isset($_FILES["profile_photo"]) && !empty($_FILES['profile_photo']['name'])) {
        $filePath = "images/img_user/";
        $getFileName = imageUpload(
            $_FILES['profile_photo']['name'],
            $_FILES["profile_photo"]["tmp_name"],
            "./images/img_user/"
        );
        if (empty($getFileName)) {
            return getStatusCodes('203');
        }
        $data['profile_photo'] = $filePath . $getFileName;
    }
    if (!empty($postData['id'])) {
        unset($data['u_e_id'],$data['email_id'], $data['password'], $data['user_type'],
            $data['phone_number']);
        updateData($data, $postData['id']);
        return getRegistrationData($postData['id'], $filePath . $getFileName, 1);
    }
    $getInsertId = insertData($data);
    if (empty($getInsertId)) {
        $statusMsg = getStatusCodes('203');
        $statusMsg['msg'] = 'Registration insert failed';
        return $statusMsg;
    }

    $getData = getRegistrationData($getInsertId, $filePath . $getFileName);
    if (trim(strtoupper($postData['user_type'])) == 'EXPERT') {
        log_message('error','mail function calling');
        $getData['mailStatus'][]=sendMailToExpert($data);
    }
    return $getData;
}

function getRegistrationData($id, $imageFullPath, $update = 0): array
{
    $ci = &get_instance();

    $getData = $ci->db->select('*')
        ->where('id', $id)
        ->get('reg_user_ept');
    $getUserData = !empty($getData) ? $getData->row_array() : [];

    $status = getStatusCodes('200');
    $status['msg'] = "Successfully Registered " . $getUserData['user_type'];
    if ($update == 1) {
        $status['msg'] = "Successfully Updated " . $getUserData['user_type'];
    }
    $status['name'] = $getUserData['name'];
    $status['email_id'] = $getUserData['email_id'];
    $status['dob'] = $getUserData['dob'];
    $status['nick_name'] = $getUserData['nick_name'];
    $status['phone_number'] = $getUserData['phone_number'];
    $status['address'] = $getUserData['address'];
    $status['gender'] = $getUserData['gender'];
    $status['expert_sports'] = $getUserData['expert_sports'];
    $status['token'] = $getUserData['token'];
    $status['img'] = base_url() . $imageFullPath ?? '';
    return $status;
}

function imageUpload($fileName, $tempFileName, $filePath)
{
    $ci = &get_instance();
    $fileInfo = pathinfo($fileName);
    $fileExtension = $fileInfo['extension'];
    $allowed = array('jpeg', 'jpg', "png", "gif", "bmp", "JPEG", "JPG", "PNG", "GIF", "BMP");
    if (in_array($fileExtension, $allowed)) {
        $move = move_uploaded_file($tempFileName, $filePath . $fileName);
        if ($move) {
            return $fileName;
        }
    }
    return '';

}

function userMailMobileValidation($data): array
{
    $ci = &get_instance();
    $ci->load->model('Reg_u_e_model');
    $status = [];
    $email_res = $ci->Reg_u_e_model->email_check($data);
    $mob_check = $ci->Reg_u_e_model->mob_check($data);
    if ($email_res != true) {
        $status['code'] = 208;
        $status['msg'] = "email Already Registered";
        return $status;
    }
    if ($mob_check != true) {
        $status['code'] = 208;
        $status['msg'] = "mobile Already Registered";
        return $status;
    }
    return $status;
}

function insertData($data): int
{
    $ci = &get_instance();
    $ci->load->model('Masterdata_model');
    return $ci->Masterdata_model->insertData('reg_user_ept', $data);
}

function updateData($data, $id): bool
{
    $ci = &get_instance();
    $ci->load->model('Masterdata_model');
    return $ci->Masterdata_model->updatedata('reg_user_ept', $data, ['id' => $id]);
}

function random_num($size): string
{
    $alpha_key = '';
    $keys = range('A', 'Z');
    for ($i = 0; $i < 6; $i++) {
        $alpha_key .= $keys[array_rand($keys)];
    }
    $length = $size - 6;
    $key = '';
    $keys = range(0, 9);
    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    return  $alpha_key . $key;
}

function sendMailToExpert($getData)
{
    $password = $getData['password'];
    $data['subject'] = "Sports astro expert login password";
    $data['emailId'] = $getData['email_id'];
    $data['userName'] = $getData['name'];
    $data['body'] = "<p> Hi </p> <br><br>
<p> Thanks for showing interest to be part of sports astro team,
 Please login with your current password:.</p> 
<p>Your password is: $password </p>";
    return sendMail($data);
}

function sendMail(array $data): array
{
    $ci =& get_instance();
    $ci->load->library('email');
    $ci->load->library('MailLib');
    $ci->email->from('sportsastro77@gmail.com', 'Sports Astro');
    $ci->email->to($data['emailId'], $data['userName']);
    $ci->email->subject($data['subject']);
    $ci->email->set_mailtype("html");
    $ci->email->message($data['body']);
    if (isset($data['attachment']) && !empty($data['attachment'])) {
        $ci->email->attach($data['attachment']);
    }
    if (!$ci->email->send()) {
        $returnData = getStatusCodes("201");
    } else {
        $returnData = getStatusCodes("200");
    }
    return $returnData;
}
