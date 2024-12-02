<?php
class etudiants {

    private object $pdo;
    private int $admin;
    private int $rowid;
    private int $numetu;
    private int $year;
    private int $zipcode;
    private int $fk_user;

    private string $firstname;
    private string $lastname;
    private string $birthday;
    private string $diploma;
    private string $td;
    private string $tp;
    private string $adress;
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

    public function setDiploma(string $diploma) {
        $this->diploma = $diploma;
    }

    public function setYear(int $year) {
        $this->year = $year;
    }

    public function setTd(string $td) {
        $this->td = $td;
    }

    public function setTp(string $tp) {
        $this->tp = $tp;
    }

    public function setAdress(string $adress) {
        $this->adress = $adress;
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

    public static $t_diplomas = array(
        'BUT',
        'License',
        'Master'
    );

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->rowid = 0;
        $this->numetu = 0;
        $this->year = 0;
        $this->zipcode = 0;
        $this->fk_user = 0;
        $this->admin = 0;
        $this->firstname = "";
        $this->lastname = "";
        $this->birthday = "";
        $this->diploma = "";
        $this->td = "";
        $this->tp = "";
        $this->adress = "";
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
            
            $stmtUser->execute([
                ':username' => $this->username,
                ':password' => $this->password,
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':admin' => $this->admin,
            ]);

            $this->fk_user = $this->pdo->lastInsertId();

            $stmtStudent = $this->pdo->prepare("
                INSERT INTO mp_etudiants (numetu, firstname, lastname, birthday, diploma, year, td, tp, adress, zipcode, town, fk_user) 
                VALUES (:numetu, :firstname, :lastname, :birthday, :diploma, :year, :td, :tp, :adress, :zipcode, :town, :fk_user)
            ");
            $stmtStudent->execute([
                ':numetu' => $this->numetu,
                ':firstname' => $this->firstname,
                ':lastname' => $this->lastname,
                ':birthday' => $this->birthday,
                ':diploma' => $this->diploma,
                ':year' => $this->year,
                ':td' => $this->td,
                ':tp' => $this->tp,
                ':adress' => $this->adress,
                ':zipcode' => $this->zipcode,
                ':town' => $this->town,
                ':fk_user' => $this->fk_user,
            ]);

            $this->pdo->commit();
            return "Étudiant créé avec succès.";
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return "Erreur lors de la création de l'étudiant : " . $e->getMessage();
        }
    }

    public function getAllStudents(): array {
        try {
            $stmt = $this->pdo->prepare("
                SELECT e.rowid AS id, e.lastname, e.firstname, e.birthday, e.diploma, e.year, e.td, e.tp, e.adress, e.zipcode, e.town,
                       u.username, u.password
                FROM mp_etudiants e
                LEFT JOIN mp_users u ON e.fk_user = u.rowid
            ");
            $stmt->execute();
    
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if (empty($students)) {
                throw new Exception("Aucun étudiant trouvé.");
            }
    
            return $students;
        } catch (Exception $e) {
            return [];
        }
    }

    public function delete(int $id): bool {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("SELECT fk_user FROM mp_etudiants WHERE rowid = :id");
            $stmt->execute([':id' => $id]);
            $fk_user = $stmt->fetchColumn();

            $stmtDeleteStudent = $this->pdo->prepare("DELETE FROM mp_etudiants WHERE rowid = :id");
            $stmtDeleteStudent->execute([':id' => $id]);

            $stmtDeleteUser = $this->pdo->prepare("DELETE FROM mp_users WHERE rowid = :fk_user");
            $stmtDeleteUser->execute([':fk_user' => $fk_user]);

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    

    public function getStudentById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM mp_etudiants WHERE rowid = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result;
    }
    
    

    private function updateStudentData(array $data): bool {
        $query = "
            UPDATE mp_etudiants 
            SET firstname = :firstname, lastname = :lastname, birthday = :birthday,
                diploma = :diploma, year = :year, td = :td, tp = :tp, adress = :adress, 
                zipcode = :zipcode, town = :town
            WHERE rowid = :id
        ";
    
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':firstname', $data['firstname']);
        $stmt->bindParam(':lastname', $data['lastname']);
        $stmt->bindParam(':birthday', $data['birthday']);
        $stmt->bindParam(':diploma', $data['diploma']);
        $stmt->bindParam(':year', $data['year']);
        $stmt->bindParam(':td', $data['td']);
        $stmt->bindParam(':tp', $data['tp']);
        $stmt->bindParam(':adress', $data['adress']);
        $stmt->bindParam(':zipcode', $data['zipcode']);
        $stmt->bindParam(':town', $data['town']);
        $stmt->bindParam(':id', $data['edit_id'], PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    

    public function updateStudent(array $data): string {
        if (empty($data['edit_id'])) {
            return "L'ID de l'étudiant est manquant.";
        }
    
        try {
            $success = $this->updateStudentData($data);
            if ($success) {
                return "Les informations de l'étudiant ont été mises à jour avec succès.";
            } else {
                return "La mise à jour a échoué. Veuillez vérifier les données saisies.";
            }
        } catch (Exception $e) {
            return "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
    
}
?>
