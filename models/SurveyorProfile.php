<?php

class SurveyorProfile{

    //Upload File - Dynamic and Reusable
    public function uploadFile($file, $upload_dir, $allowed_extensions = [], $max_size = 5242880, $prefix = ''){
        
        //Check if file was uploaded
        if(!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE){
            return ['success' => false, 'message' => 'No file uploaded'];
        }

        //Check for upload errors
        if($file['error'] !== UPLOAD_ERR_OK){
            return ['success' => false, 'message' => 'File upload error'];
        }

        //Get file info
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        //Validate file extension
        if(!empty($allowed_extensions) && !in_array($file_ext, $allowed_extensions)){
            return ['success' => false, 'message' => 'Invalid file type. Allowed: ' . implode(', ', $allowed_extensions)];
        }

        //Validate file size
        if($file_size > $max_size){
            $max_size_mb = $max_size / 1048576;
            return ['success' => false, 'message' => "File size exceeds limit of {$max_size_mb}MB"];
        }

        //Create upload directory if it doesn't exist
        if(!is_dir($upload_dir)){
            mkdir($upload_dir, 0777, true);
        }

        //Generate unique filename
        $unique_name = $prefix . uniqid() . '_' . time() . '.' . $file_ext;
        $destination = $upload_dir . $unique_name;

        //Move uploaded file
        if(move_uploaded_file($file_tmp, $destination)){
            return ['success' => true, 'filename' => $unique_name, 'path' => $destination];
        } else {
            return ['success' => false, 'message' => 'Failed to move uploaded file'];
        }
    }

    //Get Surveyor Profile By Account ID
    public function getSurveyorProfileByAccountId($account_id, $pdo){
        $sql = "SELECT * FROM surveyors_profile WHERE account_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$account_id]);
        $surveyor_profile = $stmt->fetch(PDO::FETCH_ASSOC);
        return $surveyor_profile;
    }

    //Create Surveyor Profile
    public function createSurveyorProfile($account_id, $first_name, $surname, $other_names, $phone_number, $whatsapp_number, $years_of_experience, $bio, $state, $lga, $address, $profile_image, $id_type, $id_document, $surcon_number, $pdo){
        
        $sql = "INSERT INTO surveyors_profile (account_id, first_name, surname, other_names, phone_number, whatsapp_number, years_of_experience, bio, state, lga, address, profile_image, id_type, id_document, surcon_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            $account_id,
            $first_name,
            $surname,
            $other_names,
            $phone_number,
            $whatsapp_number,
            $years_of_experience,
            $bio,
            $state,
            $lga,
            $address,
            $profile_image,
            $id_type,
            $id_document,
            $surcon_number
        ]);
        
        return $result ? $pdo->lastInsertId() : false;
    }

    //Edit Surveyor Profile by Account ID
    public function editSurveyorProfileByAccountId($account_id, $first_name, $surname, $other_names, $phone_number, $whatsapp_number, $years_of_experience, $bio, $state, $lga, $address, $profile_image, $id_type, $id_document, $surcon_number, $pdo){
        
        $sql = "UPDATE surveyors_profile SET first_name = ?, surname = ?, other_names = ?, phone_number = ?, whatsapp_number = ?, years_of_experience = ?, bio = ?, state = ?, lga = ?, address = ?, profile_image = ?, id_type = ?, id_document = ?, surcon_number = ? WHERE account_id = ?";
        
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            $first_name,
            $surname,
            $other_names,
            $phone_number,
            $whatsapp_number,
            $years_of_experience,
            $bio,
            $state,
            $lga,
            $address,
            $profile_image,
            $id_type,
            $id_document,
            $surcon_number,
            $account_id
        ]);
        
        return $stmt->rowCount() > 0;
    }
}