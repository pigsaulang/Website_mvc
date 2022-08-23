<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');


?>

<?php
	/**
	 * 
	 */
	class product 
	{
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_product($data, $files){
			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category 	 = mysqli_real_escape_string($this->db->link, $data['category']);
			$brand 	 	 = mysqli_real_escape_string($this->db->link, $data['brand']);
			$productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
			$price 		 = mysqli_real_escape_string($this->db->link, $data['price']);
			$type 		 = mysqli_real_escape_string($this->db->link, $data['type']);
			//kiểm tra hình ảnh và upload hình ảnh vào folder uploads
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $_FILES['image']['name'];
		    $file_size = $_FILES['image']['size'];
		    $file_temp = $_FILES['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;
		 		


			if($productName=="" || $category=="" || $brand=="" || $productDesc=="" || $price=="" || $type=="" || $file_name==""){

				$alert = "<span class='error'> Fiels must be not empty </span>";
				return $alert;
			}else{

				 move_uploaded_file($file_temp,$uploaded_image);
				
				$query = "INSERT INTO tbl_product(productName,catId,brandId,productDesc,price,type,image) VALUES('$productName','$category','$brand','$productDesc','$price','$type','$unique_image')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'> Insert Product Successfully</span>";
					return $alert;

				}else{
					$alert = "<span class='error'> Insert Product Not Successfully</span>";
					return $alert;
				}
				
			}
		}
		public function show_product()
		{
			$query = "
			SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
			ORDER BY tbl_product.productId DESC";
			//$query = "SELECT * FROM tbl_product ORDER BY productId DESC";
			$result = $this->db->select($query);
			return $result;
		}
	

	

		public function update_product($data,$files, $id)
		{
			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category 	 = mysqli_real_escape_string($this->db->link, $data['category']);
			$brand 	 	 = mysqli_real_escape_string($this->db->link, $data['brand']);
			$productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
			$price 		 = mysqli_real_escape_string($this->db->link, $data['price']);
			$type 		 = mysqli_real_escape_string($this->db->link, $data['type']);
			//kiểm tra hình ảnh và upload hình ảnh vào folder uploads
			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $_FILES['image']['name'];
		    $file_size = $_FILES['image']['size'];
		    $file_temp = $_FILES['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "uploads/".$unique_image;

			if($productName=="" || $category=="" || $brand=="" || $productDesc=="" || $price=="" || $type==""){
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					//nếu người dùng chọn ảnh		
					if($file_size > 20480){
						$alert = "<span class='error'>Image Size should be less then 2MB! </span>";
						return $alert;
					}
					elseif(in_array($file_ext, $permited) === false){
						$alert = "<span class='success'>You can upload only:-".imlode(',', $permited)."</span>";
						return $alert;
					}
					move_uploaded_file($file_temp, $uploaded_image);
					$query = "UPDATE tbl_product
						SET
						productName = '$productName',
						brandId = '$brand',
						catId = '$category',
						type = '$type',
						price = '$price',
						image = '$unique_image',
						productDesc = '$productDesc'
						WHERE productId = '$id'";
				}else{
					//nếu người dùng không chọn ảnh	
					$query = "UPDATE tbl_product
						SET
						productName = '$productName',
						brandId = '$brand',
						catId = '$category',
						type = '$type',
						price = '$price',
						productDesc = '$productDesc'
						WHERE productId = '$id'";	
			}
					$result = $this->db->update($query);
					if ($result) {
						$alert = "<span class='success'> Product Update  Successfully</span>";
						return $alert;
					}else{
						$alert = "<span class='error'> Product Update Not Successfully</span>";
					return $alert;
				}
			}	
		}
		public function del_product($id)
		{
			$query = "DELETE FROM tbl_product WHERE productId = '$id'";
			$result = $this->db->delete($query);
			if ($result) {
				$alert = "<span class='success'>  Product Delete Successfully</span>";
						return $alert;
			}else{
				$alert = "<span class='success'>  Product Delete Not Successfully</span>";
						return $alert;
			}
		}
		public function getproductbyId($id){
			$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		//END BACKEND
		public function getproduct_feathered(){
			$query = "SELECT * FROM tbl_product WHERE type = '0'";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function getproduct_new(){
			$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_details($id){
			$query = "
			SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName 
			FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
			INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId WHERE tbl_product.productId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestDell(){
			$query = "SELECT * FROM tbl_product WHERE brandId='10' ORDER BY productId DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestMsi(){
			$query = "SELECT * FROM tbl_product WHERE brandId='16' ORDER BY productId DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestAsus(){
			$query = "SELECT * FROM tbl_product WHERE brandId='15' ORDER BY productId DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
		public function getLastestApple(){
			$query = "SELECT * FROM tbl_product WHERE brandId='17' ORDER BY productId DESC LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>
	
