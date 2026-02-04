<?php

class Request{
    //Get surveyor total incoming requests
    public function getSurveyorTotalIncomingRequests($surveyor_profile_id, $pdo){
        $sql = "SELECT COUNT(*) AS total FROM request_to_surveyors WHERE surveyor_profile_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$surveyor_profile_id]);
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total;
    }

    //Get surveyor total outgoing requests
    public function getSurveyorTotalOutgoingRequests($surveyor_profile_id, $pdo){
        $sql = "SELECT COUNT(*) AS total FROM request_to_clients WHERE surveyor_profile_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$surveyor_profile_id]);
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total;
    }

    //Get surveyor total pending requests
    public function getSurveyorTotalPendingRequests($surveyor_profile_id, $pdo){
        $sql = "SELECT 
                    (SELECT COUNT(*) FROM request_to_surveyors 
                     WHERE surveyor_profile_id = ? AND request_status = 'pending') +
                    (SELECT COUNT(*) FROM request_to_clients 
                     WHERE surveyor_profile_id = ? AND request_status = 'pending') AS total";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$surveyor_profile_id, $surveyor_profile_id]);
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total;
    }

    //Get surveyor total completed requests
    public function getSurveyorTotalCompletedRequests($surveyor_profile_id, $pdo){
        $sql = "SELECT 
                    (SELECT COUNT(*) FROM request_to_surveyors 
                     WHERE surveyor_profile_id = ? AND request_status = 'completed') +
                    (SELECT COUNT(*) FROM request_to_clients 
                     WHERE surveyor_profile_id = ? AND request_status = 'completed') AS total";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$surveyor_profile_id, $surveyor_profile_id]);
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total;
    }

    //Get client total incoming requests
    public function getClientTotalIncomingRequests($client_profile_id, $pdo){
        $sql = "SELECT COUNT(*) AS total FROM request_to_clients WHERE client_profile_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$client_profile_id]);
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total;
    }

    //Get client total outgoing requests
    public function getClientTotalOutgoingRequests($client_profile_id, $pdo){
        $sql = "SELECT COUNT(*) AS total FROM request_to_surveyors WHERE client_profile_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$client_profile_id]);
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total;
    }

    //Get client total pending requests
    public function getClientTotalPendingRequests($client_profile_id, $pdo){
        $sql = "SELECT 
                    (SELECT COUNT(*) FROM request_to_clients 
                     WHERE client_profile_id = ? AND request_status = 'pending') +
                    (SELECT COUNT(*) FROM request_to_surveyors 
                     WHERE client_profile_id = ? AND request_status = 'pending') AS total";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$client_profile_id, $client_profile_id]);
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total;
    }

    //Get client total completed requests
    public function getClientTotalCompletedRequests($client_profile_id, $pdo){
        $sql = "SELECT 
                    (SELECT COUNT(*) FROM request_to_clients 
                     WHERE client_profile_id = ? AND request_status = 'completed') +
                    (SELECT COUNT(*) FROM request_to_surveyors 
                     WHERE client_profile_id = ? AND request_status = 'completed') AS total";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$client_profile_id, $client_profile_id]);
        $total = $stmt->fetch(PDO::FETCH_ASSOC);
        return $total;
    }

    //Get list of surveyor incoming requests
    public function getSurveyorIncomingRequests($surveyor_profile_id, $pdo){
        $sql = "SELECT r.*, c.first_name, c.surname 
                FROM request_to_surveyors r
                LEFT JOIN clients_profile c ON r.client_profile_id = c.id
                WHERE r.surveyor_profile_id = ? 
                ORDER BY r.created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$surveyor_profile_id]);
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $requests;
    }

    //Get list of surveyor outgoing requests
   public function getSurveyorOutgoingRequests($surveyor_profile_id, $pdo){
    $sql = "
        SELECT 
            r.id,
            r.request_status,
            r.created_at,
            c.first_name,
            c.surname,
            j.job_title,
            j.job_state
        FROM request_to_clients r
        LEFT JOIN clients_profile c 
            ON r.client_profile_id = c.id
        LEFT JOIN jobs j 
            ON r.job_id = j.id
        WHERE r.surveyor_profile_id = ?
        ORDER BY r.created_at DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$surveyor_profile_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Get details of a specific surveyor incoming request by ID and surveyor profile id (also get all the profile details of the client who made the request)
    public function getSurveyorIncomingRequestById($request_id, $surveyor_profile_id, $pdo){
        $sql = "SELECT r.*, r.id as rts_table_id, c.*, c.id as cp_table_id, a.email 
                FROM request_to_surveyors r
                LEFT JOIN clients_profile c ON r.client_profile_id = c.id
                LEFT JOIN accounts a ON c.account_id = a.id
                WHERE r.id = ? AND r.surveyor_profile_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$request_id, $surveyor_profile_id]);
        $request = $stmt->fetch(PDO::FETCH_ASSOC);
        return $request;
    }

    //Get details of a specific surveyor outgoing request by ID and surveyor profile id (also get all the profile details of the client who received the request and the job details of the associated job that the request is being raised on)
    public function getSurveyorOutgoingRequestById($request_id, $surveyor_profile_id, $pdo){
        $sql = "SELECT r.*, r.id as rtc_table_id, c.*, c.id as cp_table_id, a.email, j.*, j.id as job_table_id
                FROM request_to_clients r
                LEFT JOIN clients_profile c ON r.client_profile_id = c.id
                LEFT JOIN accounts a ON c.account_id = a.id
                LEFT JOIN jobs j ON r.job_id = j.id
                WHERE r.id = ? AND r.surveyor_profile_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$request_id, $surveyor_profile_id]);
        $request = $stmt->fetch(PDO::FETCH_ASSOC);
        return $request;
    }

    //Get list of client incoming requests
    public function getClientIncomingRequests($client_profile_id, $pdo) {
    $sql = "
        SELECT 
            rtc.id,
            rtc.request_status,
            j.job_title AS job_title,
            sp.first_name,
            sp.surname
        FROM request_to_clients rtc
        JOIN jobs j 
            ON rtc.job_id = j.id
        JOIN surveyors_profile sp 
            ON rtc.surveyor_profile_id = sp.id
        WHERE rtc.client_profile_id = ?
        ORDER BY rtc.created_at DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$client_profile_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

    //Get list of client outgoing requests
    public function getClientOutgoingRequests($client_profile_id, $pdo){
        $sql = "SELECT r.*, s.first_name, s.surname 
                FROM request_to_surveyors r
                LEFT JOIN surveyors_profile s ON r.surveyor_profile_id = s.id
                WHERE r.client_profile_id = ? 
                ORDER BY r.created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$client_profile_id]);
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $requests;
    }

    //Get details of a specific client incoming request by ID and client profile id (also get all the profile details of the surveyor who made the request and the job details of the associated job that the request is being raised on)
    public function getClientIncomingRequestById($request_id, $client_profile_id, $pdo){
        $sql = "SELECT r.*, r.id as rtc_table_id, s.*, s.id as sp_table_id, a.email, j.*, j.id as job_table_id
                FROM request_to_clients r
                LEFT JOIN surveyors_profile s ON r.surveyor_profile_id = s.id
                LEFT JOIN accounts a ON s.account_id = a.id
                LEFT JOIN jobs j ON r.job_id = j.id
                WHERE r.id = ? AND r.client_profile_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$request_id, $client_profile_id]);
        $request = $stmt->fetch(PDO::FETCH_ASSOC);
        return $request;
    }

    //Get details of a specific client outgoing request by ID and client profile id (also get all the profile details of the surveyor who received the request)
    public function getClientOutgoingRequestById($request_id, $client_profile_id, $pdo){
        $sql = "SELECT r.*, r.id as rts_table_id, s.*, s.id as sp_table_id, a.email 
                FROM request_to_surveyors r
                LEFT JOIN surveyors_profile s ON r.surveyor_profile_id = s.id
                LEFT JOIN accounts a ON s.account_id = a.id
                WHERE r.id = ? AND r.client_profile_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$request_id, $client_profile_id]);
        $request = $stmt->fetch(PDO::FETCH_ASSOC);
        return $request;
    }

    //Create a request to surveyor
    public function createRequestToSurveyor($client_profile_id, $surveyor_profile_id, $service_category, $project_state, $project_lga, $project_address, $estimated_budget, $project_description, $pdo){
        $sql = "INSERT INTO request_to_surveyors (client_profile_id, surveyor_profile_id, service_category, project_state, project_lga, project_address, estimated_budget, project_description) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$client_profile_id, $surveyor_profile_id, $service_category, $project_state, $project_lga, $project_address, $estimated_budget, $project_description]);
        return $result ? $pdo->lastInsertId() : false;
    }

    //Create a request to client
    public function createRequestToClient($job_id, $surveyor_profile_id, $client_profile_id, $pdo){
        $sql = "INSERT INTO request_to_clients (job_id, surveyor_profile_id, client_profile_id) 
                VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$job_id, $surveyor_profile_id, $client_profile_id]);
        return $result ? $pdo->lastInsertId() : false;
    }

    //Check if surveyor has already applied for a job
    public function surveyorHasAppliedForThisJob($job_id, $surveyor_profile_id, $pdo){
        $sql = "SELECT id FROM request_to_clients 
                WHERE job_id = ? AND surveyor_profile_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$job_id, $surveyor_profile_id]);
        $existingRequest = $stmt->fetch(PDO::FETCH_ASSOC);
        return $existingRequest ? true : false;
    }

    //Check if client has already sent a request to a surveyor for a specific service
    public function clientHasSentRequestToSurveyorForService($client_profile_id, $surveyor_profile_id, $service_category, $pdo){
        $sql = "SELECT id FROM request_to_surveyors 
                WHERE client_profile_id = ? AND surveyor_profile_id = ? AND service_category = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$client_profile_id, $surveyor_profile_id, $service_category]);
        $existingRequest = $stmt->fetch(PDO::FETCH_ASSOC);
        return $existingRequest ? true : false;
    }

    //Update request to client status (accept/reject) and update corresponding job status
    public function updateRequestToClientStatus($request_id, $client_profile_id, $new_status, $pdo){
        try {
            $pdo->beginTransaction();
            
            // First, get the current request details including job_id
            $sql = "SELECT request_status, job_id FROM request_to_clients 
                    WHERE id = ? AND client_profile_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$request_id, $client_profile_id]);
            $request = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$request) {
                $pdo->rollBack();
                return false;
            }
            
            // Check if request is already rejected - if so, no updates allowed
            if ($request['request_status'] === 'rejected') {
                $pdo->rollBack();
                return false;
            }
            
            // Validate new status
            if (!in_array($new_status, ['accepted', 'rejected'])) {
                $pdo->rollBack();
                return false;
            }
            
            // Update request status
            $sql = "UPDATE request_to_clients 
                    SET request_status = ? 
                    WHERE id = ? AND client_profile_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$new_status, $request_id, $client_profile_id]);
            
            // Update job status based on request status
            $job_status = ($new_status === 'accepted') ? 'taken' : 'available';
            $sql = "UPDATE jobs 
                    SET job_status = ? 
                    WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$job_status, $request['job_id']]);
            
            $pdo->commit();
            return true;
            
        } catch (Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }

    //Update request to surveyor status
    public function updateRequestToSurveyorStatus($request_id, $surveyor_profile_id, $new_status, $pdo){
        try {
            $pdo->beginTransaction();
            
            // Get the current request status
            $sql = "SELECT request_status FROM request_to_surveyors 
                    WHERE id = ? AND surveyor_profile_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$request_id, $surveyor_profile_id]);
            $request = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$request) {
                $pdo->rollBack();
                return false;
            }
            
            // Check if request is already rejected - if so, no updates allowed
            if ($request['request_status'] === 'rejected') {
                $pdo->rollBack();
                return false;
            }
            
            // Validate new status
            if (!in_array($new_status, ['pending', 'accepted', 'rejected', 'completed', 'cancelled'])) {
                $pdo->rollBack();
                return false;
            }
            
            // Update request status
            $sql = "UPDATE request_to_surveyors 
                    SET request_status = ? 
                    WHERE id = ? AND surveyor_profile_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$new_status, $request_id, $surveyor_profile_id]);
            
            $pdo->commit();
            return true;
            
        } catch (Exception $e) {
            $pdo->rollBack();
            return false;
        }
    }

    //Get surveyor recent activity
    public function getRecentActivity($surveyor_profile_id, $pdo, $limit = 5) {
        $limit = (int) $limit; // IMPORTANT

        $sql = "
            SELECT 
                client_profile_id,
                request_status,
                created_at
            FROM request_to_surveyors
            WHERE surveyor_profile_id = ?
            ORDER BY created_at DESC
            LIMIT $limit
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$surveyor_profile_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Upload deliverable
    public function uploadDeliverable(
        $request_id,
        $surveyor_profile_id,
        $file_path,
        $note,
        $pdo
    ) {
        $sql = "INSERT INTO request_deliverables 
                (request_id, surveyor_profile_id, file_path, note)
                VALUES (?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $request_id,
            $surveyor_profile_id,
            $file_path,
            $note
        ]);
    }

       public function updateSurveyorRequestStatus(
        int $request_id,
        int $surveyor_profile_id,
        string $status,
        PDO $pdo
    ) {
        $sql = "
            UPDATE request_to_clients
            SET request_status = ?
            WHERE id = ?
            AND surveyor_profile_id = ?
            AND request_status = 'pending'
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $status,
            $request_id,
            $surveyor_profile_id
        ]);

        return $stmt->rowCount(); // 👈 IMPORTANT
    }




}