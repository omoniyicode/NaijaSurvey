<?php

class Account{
    
    //Get account by email
    public function getAccountByEmail($email, $pdo){
        $sql = "SELECT * FROM accounts WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $account = $stmt->fetch(PDO::FETCH_ASSOC);
        return $account;
    }

    //Create a new account
    public function createAccount($email, $password, $user_type, $pdo){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO accounts (email, password, user_type) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$email, $hashedPassword, $user_type]);
    }

    //Mark account as inactive
    public function deactivateAccount($account_id, $pdo){
        $sql = "UPDATE accounts SET status = 'inactive' WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$account_id]);
    }

    //Mark account as active
    public function activateAccount($account_id, $pdo){
        $sql = "UPDATE accounts SET status = 'active' WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$account_id]);
    }

    //Delete account
    public function deleteAccount($account_id, $pdo){
        $sql = "DELETE FROM accounts WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$account_id]);
    }
}