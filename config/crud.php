<?php

class CRUD {
    
    public $conn;
    
    private function fetch_id_count($column) {

        $query = "SELECT $column FROM IDCounters";
        $result = mysqli_query($this->conn, $query);

        return $result;
    }
    
    public function id_count_old($column) {
        
        $result = $this->fetch_id_count($column);        
        $row_id = mysqli_fetch_array($result);
        $old_count = $row_id[0];
        
        return $old_count;
    }
    
    public function id_count_new($column) {
        
        $result = $this->fetch_id_count($column);        
        $row_id = mysqli_fetch_array($result);
        $id_count = $row_id[0];
        $new_count = $id_count + 1;
        
        return $new_count;
    }    

    public function id_count_update($column, $new_id) {
        
        $query = "UPDATE IDCounters SET $column = '$new_id'";
        $result = mysqli_query($this->conn, $query);
        
        return $result;
    }
    
    public function customer_new($id, $email, $fname, $lname, $contact) {
        
        $query = "INSERT INTO Customers ("
                . "CustomersID"
                . ", Email"
                . ", Firstname"
                . ", Lastname"
                . ", LandlineNum"
                . ", NewsletterSubscription"
                . ", DateJoined)"
                . "VALUES ("
                . "'$id'"
                . ",'$email'"
                . ",'$fname'"
                . ",'$lname'"
                . ",'$contact'"
                . ",'1'"
                . ",now())";
        
        $result = mysqli_query($this->conn, $query);
        
        return $result;
    }
    
    public function customer_update($id, $email, $fname, $lname, $subscription) {
        
        $query = "UPDATE Customer SET"
                . "Email = '$email'"
                . ", Firstname = '$fname'"
                . ", Lastname = '$lname'"
                . ", NewsletterSubscripiont = '$subscription'"
                . "WHERE CustomersID = '$id'";
        
        $result = mysqli_query($this->conn, $query);
        
        return $result;
    }    
    
    public function customer_remove($id) {
        
        $query = "DELETE FROM Customers WHERE CustomersID = '$id'";
        $result = mysqli_query($this->conn, $query);
        
        return $result;
    }
    
    public function customer_fetch($id) {
        $query = "SELECT * FROM Customers WHERE CustomersID = '$id'";
        $result = mysqli_query($this->conn, $query);
        
        return $result;
    }
    
    public function user_new($id, $email, $key) {
        
        $query = "INSERT INTO UserLogin ("
                . "UserNumber"
                . ", UserName"
                . ", Password"
                . ", SystemLevel"
                . ", CreatedBy"
                . ", Timestamp"
                . ", Status)"
                . "VALUES ("
                . "'$id'"
                . ", '$email'"
                . ", AES_ENCRYPT('default', '$key')"
                . ", '3'"
                . ", 'Customer'"
                . ", now()"
                . ", '1')";
        
        $result = mysqli_query($this->conn, $query);
        
        return $result;
    }
    
    public function user_remove($id) {
        
        $query = "DELETE FROM UserLogin WHERE UserNumber = '$id'";
        $result = mysqli_query($this->conn, $query);

        return $result;
    }
    
    public function user_fetch($id) {
        
        $query = "SELECT * FROM UserLogin WHERE UserNumber = '$id'";
        $result = mysqli_query($this->conn, $query);
        
        return $result;        
    }
    
    public function newsletter_unsubcribe($email) {
        $query = "UPDATE Customers SET NewsletterSubscription = '0'"
                . "WHERE Email = '$email'";
        
        $result = mysqli_query($this->conn, $query);
        
        return $result;
    }

    public function article_fetch($id) {
        
        $query = "SELECT * FROM NewsletterArticle WHERE ArticleID = '$id'";
        $result = mysqli_query($this->conn, $query);        
        $fields = mysqli_fetch_array($result);
        
        return $fields;
    }
}

