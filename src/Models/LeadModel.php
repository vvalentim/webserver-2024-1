<?php

namespace Models;

use Core\Database;

class LeadModel {
    protected Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function create() {
        return $this->db->query("INSERT INTO leads (name,
                                                    phone,
                                                    email,
                                                    subject,
                                                    message)
                                                    VALUES
                                (:name, :phone, :email, :subject, :message)",
        [$_POST['name'], $_POST['phone'], $_POST['email'], $_POST['subject'], $_POST['message']]);
    }

    public function get(){
        return $this->db->query("select * from leads")->findAll();
    }

    public function destroy(int $id){
        if(!$id){
            return null;
        }

        $this->db->query("delete from leads where id = :id", [$id]);
    }

    public function validate(){
        $e = [];
        if($_POST['name'] == ''){
            $e[] = 'name';
        }
        if($_POST['phone'] == '' || strlen($_POST['phone']) < 16){
            $e[] = 'phone';
        }
        if($_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $e[] = 'email';
        }
        if($_POST['subject'] == ''){
            $e[] = 'subject';
        }

        return $e;
    }
}