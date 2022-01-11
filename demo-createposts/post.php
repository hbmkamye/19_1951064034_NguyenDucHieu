<?php
    class Post{
        private $error="";
        
        public function create_post($userid, $data, $files){
            if(!empty($data['post']) && isset($_FILES['image'])){
                
                $img_name = $_FILES['image']['name'];
	            $img_size = $_FILES['image']['size'];
	            $tmp_name = $_FILES['image']['tmp_name'];

                if ($img_size > 5097152)
                {
                        $em = "Kích thước file không được lớn hơn 2MB.";
                        header("location: home.php?error=$em");
                }else 
                {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
        
                    $allowed_exs = array("jpg", "jpeg", "png"); 
        
                    if (in_array($img_ex_lc, $allowed_exs)) 
                    {
                        $new_img_name = uniqid("Image-", true).'.'.$img_ex_lc;
                        $img_upload_path = 'hinhanh/'.$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
        
                        // Insert into Database
                        $content = addslashes($data['content']);
                        $postid = $this->create_postid();
                        $query = "insert into status (id_status, id_nguoidung, content, image) values ('$postid', '$userid', '$content', '$new_img_name')";
                        $DB = new Database();
                        $DB->save($query);
                        header("location: home.php");
                    }else 
                    {
                        $em = "You can't upload files of this type";
                        header("Location: home.php?error=$em");
                    }
                }

                
            }
            else{
                $this->error .= "Bạn chưa nhập nội dung gì!<br>";
                
            }
            return $this->error;
        }

        
        
        private function create_postid(){
            $length = rand(4,19);
            $number = "";
            for($i=0; $i < $length; $i++){
                $new_rand = rand(0,9);
                $number = $number . $new_rand;
            }
            return $number;
        }
    }

    function get_all_status($conn){
        $sql  = "SELECT * FROM status";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
     
        if ($stmt->rowCount() > 0) {
              $status = $stmt->fetchAll();
        }else {
           $status = 0;
        }
     
        return $status;
     }
?>