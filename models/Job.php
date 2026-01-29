<?php

class Job {
    
    //Get all jobs
    public function getAllJobs($pdo){
        $sql = "SELECT jobs.*, clients_profile.*, jobs.id AS job_id, clients_profile.id AS client_profile_id 
                FROM jobs 
                INNER JOIN clients_profile ON jobs.client_profile_id = clients_profile.id 
                WHERE jobs.job_status = 'available' 
                ORDER BY jobs.created_at DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $jobs;
    }

    //Get job by ID
    public function getJobById($job_id, $pdo){
        $sql = "SELECT jobs.*, clients_profile.*, jobs.id AS job_id, clients_profile.id AS client_profile_id
                FROM jobs 
                INNER JOIN clients_profile ON jobs.client_profile_id = clients_profile.id 
                WHERE jobs.id = :job_id AND jobs.job_status = 'available'";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':job_id', $job_id);
        $stmt->execute();
        $job = $stmt->fetch(PDO::FETCH_ASSOC);
        return $job;
    }

    //Add a new job
    public function addJob($client_profile_id, $job_title, $job_description, $proposed_budget, $job_state, $job_lga, $job_address, $pdo){
        $sql = "INSERT INTO jobs (client_profile_id, job_title, job_description, proposed_budget, job_state, job_lga, job_address) 
                VALUES (:client_profile_id, :job_title, :job_description, :proposed_budget, :job_state, :job_lga, :job_address)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':client_profile_id', $client_profile_id);
        $stmt->bindParam(':job_title', $job_title);
        $stmt->bindParam(':job_description', $job_description);
        $stmt->bindParam(':proposed_budget', $proposed_budget);
        $stmt->bindParam(':job_state', $job_state);
        $stmt->bindParam(':job_lga', $job_lga);
        $stmt->bindParam(':job_address', $job_address);
        return $stmt->execute();
    }
}