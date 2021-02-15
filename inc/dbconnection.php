<?php


class dbconnection extends PDO //PDO= PHP DATA OBJECT, dit is een bestaand class die heel veel PHP-programmeurs gebruiken
{
    private string $host = "localhost";
    private string $dbname = "reserveren";
    private string $user = "webgebruiker_reserveren";
    private string $pass = "VX7jQHWRSRNeQX47";

    public function __construct()
    {
        parent::__construct("mysql:host=" . $this->host . ";dbname=" . $this->dbname . "; charset=utf8", $this->user, $this->pass);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // always disable emulated prepared statement when using the MySQL driver
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function checkEmailadres($emailadres)
    {
        $dbconnect = new dbconnection();
        $sql = "SELECT COUNT(*) FROM user WHERE user_email = :mail";
        $query = $dbconnect -> prepare($sql);
        $query->bindParam(":mail", $emailadres);
        $query ->execute();
        return $query->fetchColumn();
    }


    public function insertUser($mail, $password): int
    {
        $dbconnect = new dbconnection();
        $sql = "INSERT INTO user (user_email, user_password) VALUES(:mailadres,:wachtwoord)";
        $query = $dbconnect -> prepare($sql);
        $query->bindParam(":mailadres", $mail);
        $query->bindParam(":wachtwoord", $password);
        $query ->execute();
        return $dbconnect -> lastInsertId();
    }

    public function haalWachtwoordOp($emailadres): string
    {
        $dbconnect = new dbconnection();
        $sql = "SELECT user_password, user_status FROM user WHERE user_email=:mail";
        $query = $dbconnect -> prepare($sql);
        $query->bindParam(":mail", $emailadres);
        $query ->execute();
        $recset = $query->fetch(PDO::FETCH_ASSOC);
        if($recset['user_status'] == 1) {
            //dan is de user dus geverifieerd en kan het wachtwoord geretourneerd worden
            return $recset['user_password'];
        }
        else {
            return "idsisgek";
        }
    }

    public function haalUseridOp($emailadres): int
    {
        $dbconnect = new dbconnection();
        $sql = "SELECT user_id FROM user WHERE user_email=:mail";
        $query = $dbconnect -> prepare($sql);
        $query->bindParam(":mail", $emailadres);
        $query ->execute();
        return $query->fetchColumn();
    }

    public function verifieerUser($id,$hash)
    {
        $dbconnect = new dbconnection();
        $pass = "%".$hash."%";
        $sql = "SELECT COUNT(*) FROM user WHERE user_id=:id AND user_password LIKE :pass";
        $query = $dbconnect -> prepare($sql);
        $query->bindParam(":id", $id);
        $query->bindParam(":pass", $pass);
        $query ->execute();
        $aantalgevonden = $query->fetchColumn();
        if($aantalgevonden==1){
            //user_status van 0 naar 1 zetten
            $sql = "UPDATE user SET user_status=1 WHERE user_id=:id";
            $query = $dbconnect -> prepare($sql);
            $query->bindParam(":id", $id);
            $query ->execute();
        }
        return $aantalgevonden;
    }

}
