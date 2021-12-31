<?php 

	Class Model{

		private $server = "localhost";
		private $username = "root";
		private $password;
		private $db = "mdwanaBeta";
		private $conn;

		public function __construct(){
			try {
				
				$this->conn = new mysqli($this->server,$this->username,$this->password,$this->db);
			} catch (Exception $e) {
				echo "connection failed" . $e->getMessage();
			}
		}

		public function insert(){

			if (isset($_POST['log'])) {
				
				if (isset($_POST['Name']) && isset($_POST['Email']) && isset($_POST['Subject']) && isset($_POST['Message'])) {

					if (!empty($_POST['Name']) && !empty($_POST['Email']) && !empty($_POST['Subject']) && !empty($_POST['Message']) ) {
						
						$Name = $_POST['Name'];
						$Email = $_POST['Email'];
						$Subject = $_POST['Subject'];
						$Message = $_POST['Message'];

						$query = "INSERT INTO message (Name,Email,Subject,Message) VALUES ('$Name','$Email','$Subject','$Message')";
						if ($sql = $this->conn->query($query)) {
							echo "<script>alert('records added successfully');</script>";
							echo "<script>window.location.href = 'index.php';</script>";
						}else{
							echo "<script>alert('failed');</script>";
							echo "<script>window.location.href = 'index.php';</script>";
						}

					}else{
						echo "<script>alert('empty');</script>";
						echo "<script>window.location.href = 'index.php';</script>";
					}
				}
			}
		}

		public function fetch(){
			$data = null;

			$query = "SELECT * FROM message";
			if ($sql = $this->conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
		}

		public function delete($id){

			$query = "DELETE FROM message where id = '$id'";
			if ($sql = $this->conn->query($query)) {
				return true;
			}else{
				return false;
			}
		}

		public function fetch_single($id){

			$data = null;

			$query = "SELECT * FROM message WHERE id = '$id'";
			if ($sql = $this->conn->query($query)) {
				while ($row = $sql->fetch_assoc()) {
					$data = $row;
				}
			}
			return $data;
		}

		public function edit($id){

			$data = null;

			$query = "SELECT * FROM message WHERE id = '$id'";
			if ($sql = $this->conn->query($query)) {
				while($row = $sql->fetch_assoc()){
					$data = $row;
				}
			}
			return $data;
		}

		public function update($data){

			$query = "UPDATE message SET name='$data[name]', email='$data[email]', mobile='$data[mobile]', address='$data[address]' WHERE id='$data[id] '";

			if ($sql = $this->conn->query($query)) {
				return true;
			}else{
				return false;
			}
		}
	}

 ?>