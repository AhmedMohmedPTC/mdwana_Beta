<?php 

class Posts extends Dbh {
  public function getPost() {
    $sql = "SELECT * FROM posts";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();

    while($result = $stmt->fetchAll()) {
      return $result;
    };
  }

  public function addPost($postTitle, $postCat, $postContent, $postCover) {
    $sql = "INSERT INTO posts(postTitle, postCat, postContent, postCover) VALUES (?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$title, $body, $author]);
  }

  public function editPost($id) {
    $sql = "SELECT * FROM posts WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    return $result;
  }

  public function updatePost($id, $title, $body, $postContent, $postCover) {
    $sql = "UPDATE posts SET title = ?, body = ?, postContent = ?, postCover = ? WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$postTitle, $postCat, $postContent, $postCover ,$id]);
  }

  public function delPost($id) {
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id]);
  }
}
?>