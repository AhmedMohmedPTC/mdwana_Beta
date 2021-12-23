<?php 

class Posts extends Dbh {
  public function getPost() {
    $sql = "SELECT * FROM users";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();

    while($result = $stmt->fetchAll()) {
      return $result;
    };
  }

  public function addUser($userName, $userNum, $userEmail, $userPass) {
    $sql = "INSERT INTO users(userName, userNum, userEmail, userPass) VALUES (?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$userName, $userNum , $userEmail, $userPass]);
  }

  public function editUser($id) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    return $result;
  }

  public function updateUser($id, $userName, $userNum, $userEmail, $userPass) {
    $sql = "UPDATE users SET userName = ?, userNum = ?, userEmail = ?, userPass = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$userName, $userNum, $userEmail, $userPass ,$id]);
  }

  public function delUser($id) {
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
  }
}
?>