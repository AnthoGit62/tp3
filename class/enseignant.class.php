<?php
class enseignants {

    private object $pdo;
    private int $admin;
    private int $rowid;
    private int $employee_id;
    private int $zipcode;
    private int $fk_user;

    private string $firstname;
    private string $lastname;
    private string $birthday;
    private string $subject;
    private string $address;
    private string $town;
    private string $username;
    private string $password;
    private string $date_created;
    private string $date_updated;

    public function setFirstname(string $firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname(string $lastname) {
        $this->lastname = $lastname;
    }

    public function setBirthday(string $birthday) {
        $this->birthday = $birthday;
    }

    public function setSubject(string $subject) {
        $this->subject = $subject;
    }

    public function setAddress(string $address) {
        $this->address = $address;
    }

    public function setZipcode(int $zipcode) {
        $this->zipcode = $zipcode;
    }

    public function setTown(string $town) {
        $this->town = $town;
    }

    public function setUsername(string $username) {
        $this->username = $username;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->rowid = 0;
        $this->employee_id = 0;
        $this->zipcode = 0;
        $this->fk_user = 0;
        $this->admin = 0;
        $this->firstname = "";
        $this->lastname = "";
        $this->birthday = "";
        $this->subject = "";
        $this->address = "";
        $this->town = "";
        $this->username = "";
        $this->password = "";
        $this->date_created = "";
        $this->date_updated = "";
    }

    public function create() {
        try {
            $this->pdo->beginTransaction();
    
            $stmtUser = $this->pdo->prepare("
                INSERT INTO mp_users (username, password, firstname, lastname, date_created, admin) 
                VALUES (:username, :password, :firstname, :lastname, NOW(), :admin)
            ");
            
            $hashedPassword = password_hash($this->password, PASSWORD_BCRYPT);
    
            $stmtUser->execute([
                ':username' => $this->username,
                ':password' => $hashedPassword,
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':admin' => $this->admin,
            ]);
    
            // Obtenir l'ID de l'utilisateur créé
            $this->fk_user = $this->pdo->lastInsertId();
    
            if (!$this->employee_id) {
                $this->employee_id = random_int(100000, 999999); 
            }
    
            $stmtTeacher = $this->pdo->prepare("
                INSERT INTO mp_enseignants (numens, firstname, lastname, birthday, address, zipcode, town, fk_user) 
                VALUES (:numens, :firstname, :lastname, :birthday, :address, :zipcode, :town, :fk_user)
            ");
    
            $stmtTeacher->execute([
                ':numens' => $this->employee_id,
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':birthday' => $this->birthday,
                ':address' => $this->address ?? null,
                ':zipcode' => $this->zipcode ?? null,
                ':town' => $this->town ?? null,
                ':fk_user' => $this->fk_user,
            ]);
    
            $this->pdo->commit();
            return "Enseignant créé avec succès.";
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return "Erreur lors de la création de l'enseignant : " . $e->getMessage();
        }
    }
    
    
    public function getAllTeachers(): array {
        try {
            $stmt = $this->pdo->prepare("
               SELECT e.rowid AS id, e.lastname, e.firstname, e.birthday, e.address, e.zipcode, e.town,
                u.username, u.password
            FROM mp_enseignants e
            LEFT JOIN mp_users u ON e.fk_user = u.rowid;

            ");
            $stmt->execute();
    
            $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if (empty($teachers)) {
                throw new Exception("Aucun enseignant trouvé.");
            }
    
            return $teachers;
        } catch (Exception $e) {
            return [];
        }
    }

    public function delete(int $id): bool {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("SELECT fk_user FROM mp_enseignants WHERE rowid = :id");
            $stmt->execute([':id' => $id]);
            $fk_user = $stmt->fetchColumn();

            $stmtDeleteTeacher = $this->pdo->prepare("DELETE FROM mp_enseignants WHERE rowid = :id");
            $stmtDeleteTeacher->execute([':id' => $id]);

            $stmtDeleteUser = $this->pdo->prepare("DELETE FROM mp_users WHERE rowid = :fk_user");
            $stmtDeleteUser->execute([':fk_user' => $fk_user]);

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function getTeacherById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM mp_enseignants WHERE rowid = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result;
    }

    private function updateTeacherData(array $data): bool {
        $query = "
            UPDATE mp_enseignants 
            SET firstname = :firstname, lastname = :lastname, birthday = :birthday,
                subject = :subject, address = :address, zipcode = :zipcode, town = :town
            WHERE rowid = :id
        ";
    
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':firstname', $data['firstname']);
        $stmt->bindParam(':lastname', $data['lastname']);
        $stmt->bindParam(':birthday', $data['birthday']);
        $stmt->bindParam(':subject', $data['subject']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':zipcode', $data['zipcode']);
        $stmt->bindParam(':town', $data['town']);
        $stmt->bindParam(':id', $data['edit_id'], PDO::PARAM_INT);
    
        return $stmt->execute();
    }

    public function updateTeacher($data) {
        $sql = "UPDATE mp_enseignants 
                SET firstname = :firstname, 
                    lastname = :lastname, 
                    birthday = :birthday, 
                    address = :address, 
                    zipcode = :zipcode, 
                    town = :town
                WHERE rowid = :edit_id";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindValue(':edit_id', $data['edit_id'], PDO::PARAM_INT);
        $stmt->bindValue(':firstname', $data['firstname'], PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $data['lastname'], PDO::PARAM_STR);
        $stmt->bindValue(':birthday', $data['birthday'], PDO::PARAM_STR);
        $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
        $stmt->bindValue(':zipcode', $data['zipcode'], PDO::PARAM_STR);
        $stmt->bindValue(':town', $data['town'], PDO::PARAM_STR);
        
        return $stmt->execute();
    }
    

    public function getTeacherWithUsername($id) {
        $sql = "SELECT e.rowid AS id, e.firstname, e.lastname, e.birthday, e.address, e.zipcode, e.town, 
                       u.username
                FROM mp_enseignants e
                LEFT JOIN mp_users u ON e.fk_user = u.rowid
                WHERE e.rowid = :id";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
}
?>
