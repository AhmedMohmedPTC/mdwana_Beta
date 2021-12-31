<?php 

	Class Model{

		private $server = "localhost";
		private $username = "root";
		private $password;
		private $db = "mdwanabeta";
		private $conn;

		public function __construct(){
			try {
				
				$this->conn = new mysqli($this->server,$this->username,$this->password,$this->db);
			} catch (Exception $e) {
				echo "connection failed" . $e->getMessage();
			}
		}

		public function insert(){

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$postTitle = $_POST['postTitle'];
		
				$postCat = $_POST['postCat'];
				$postContent = $_POST['postContent'];
				// post Cover
				$imageName = $_FILES['postCover']['name'];
				$imageTmp = $_FILES['postCover']['tmp_name'];
		
				if (empty($postTitle) || empty($postCat)  || empty($postContent)) {
					$error = "<div class='alert alert-danger'>" . "الرجاء ملء الحقول أدناه" . "</div>";
				} elseif (empty($imageName)) {
					$error = "<div class='alert alert-danger'>" . "الرجاء إختيار صورة مناسبة" . "</div>";
				}  else {
					// post cover
					$postCover = rand(0, 1000) . "_" . $imageName;
					move_uploaded_file($imageTmp, "../uploads/Covers/" . $postCover);
					// post cover
		
					$query = "INSERT INTO posts(postTitle,postCat,postCover,postContent)
					VALUES('$postTitle','$postCat','$postCover','$postContent')";
					$res = mysqli_query($con, $query);
					if (isset($res)) {
						$success = "<div class='alert alert-success'>" . "تم النشر بنجاح" . "</div>";
					}
				}
			}
		}
        
		public function fetch(){
			$data = null;

			$query = "SELECT * FROM posts";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function delete($id){

			$query = "DELETE FROM posts where id = '$id'";
			if ($sql = $this->conn->query($query)) {
				return true;
			}else{
				return false;
			}
		}

		public function fetch_single($id){

			$data = null;

			$query = "SELECT * FROM posts WHERE id = '$id'";
			if ($sql = $this->conn->query($query)) {
				while ($row = $sql->fetch_assoc()) {
					$data = $row;
				}
			}
			return $data;
		}

		public function edit($id){

			$data = null;

			$query = "SELECT * FROM posts WHERE id = '$id'";
			if ($sql = $this->conn->query($query)) {
				while($row = $sql->fetch_assoc()){
					$data = $row;
				}
			}
			return $data;
		}

		public function update($data){

			$query = "UPDATE posts SET name='$data[name]', email='$data[email]', mobile='$data[mobile]', address='$data[address]' WHERE id='$data[id] '";

			if ($sql = $this->conn->query($query)) {
				return true;
			}else{
				return false;
			}
		}
	}

 ?>