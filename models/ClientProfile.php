<?php

class ClientProfile{

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

    //Get Client Profile By Account ID
    public function getClientProfileByAccountId($account_id, $pdo){
        $sql = "SELECT * FROM clients_profile WHERE account_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$account_id]);
        $client_profile = $stmt->fetch(PDO::FETCH_ASSOC);
        return $client_profile;
    }
    
    //Create Client Profile
    public function createClientProfile($account_id, $first_name, $surname, $other_names, $phone_number, $whatsapp_number, $bio, $state, $lga, $address, $profile_image, $id_type, $id_document, $pdo) {
        
        $sql = "INSERT INTO clients_profile (account_id, first_name, surname, other_names, phone_number, whatsapp_number, bio, state, lga, address, profile_image, id_type, id_document) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            $account_id,
            $first_name,
            $surname,
            $other_names,
            $phone_number,
            $whatsapp_number,
            $bio,
            $state,
            $lga,
            $address,
            $profile_image,
            $id_type,
            $id_document
        ]);
        
        return $result ? $pdo->lastInsertId() : false;
    }

    //Edit Client Profile by Account ID
    public function editClientProfileByAccountId($account_id, $first_name, $surname, $other_names, $phone_number, $whatsapp_number, $bio, $state, $lga, $address, $profile_image, $id_type, $id_document, $pdo) {
        
        $sql = "UPDATE clients_profile SET first_name = ?, surname = ?, other_names = ?, phone_number = ?, whatsapp_number = ?, bio = ?, state = ?, lga = ?, address = ?, profile_image = ?, id_type = ?, id_document = ? WHERE account_id = ?";
        
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            $first_name,
            $surname,
            $other_names,
            $phone_number,
            $whatsapp_number,
            $bio,
            $state,
            $lga,
            $address,
            $profile_image,
            $id_type,
            $id_document,
            $account_id
        ]);
        
        return $stmt->rowCount() > 0;
    }
}