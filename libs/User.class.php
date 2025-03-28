<?php

class User
{
    public static function login($username, $password)
    {
        Session::start();
        $conn = Database::getConnect();
        
        $sql = "SELECT `id`, `password` FROM `auth` WHERE `username` = ? OR `email` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($res->num_rows === 1) {
            $row = $res->fetch_assoc();
            if ($password === $row['password']) {
                Session::regenerate();
                Session::set('login_user', $username);
                header("Location: welcome.php");
                exit;
            }
        }

        return "Invalid Username and Password";
    }

    public static function setPageCategory($page, $title)
    {
        $conn = Database::getConnect();

        $sql = "INSERT INTO `cate` (`page`, `category`, `created_at`) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $page, $title);

        if ($stmt->execute()) {
            header("Location: addCate.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function updatePageCategory($getID, $page, $title, $conn)
    {
        $sql = "UPDATE `cate` SET `page` = ?, `category` = ?, `created_at` = NOW() WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $page, $title, $getID);

        if ($stmt->execute()) {
            header("Location: viewPS.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function setCategory($cate, $category)
    {
        $conn = Database::getConnect();

        $sql = "INSERT INTO `ps-category` (`cate`, `category`, `created_at`) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $cate, $category);

        if ($stmt->execute()) {
            header("Location: viewPS.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function updateCategory($getID, $cate, $category, $conn)
    {
        $sql = "UPDATE `ps-category` SET `cate` = ?, `category` = ?, `created_at` = NOW() WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $cate, $category, $getID);

        if ($stmt->execute()) {
            header("Location: viewPS.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function setPS($title, $dec, $file, $img, $cate, $conn)
    {
        $targetDirImg = "../uploads/Products_Services/";
        $targetDirPDF = "../uploads/Products_Services/PDF/";

        if (!is_dir($targetDirImg)) {
            mkdir($targetDirImg, 0777, true);
        }

        if (!is_dir($targetDirPDF)) {
            mkdir($targetDirPDF, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $allowPDFTypes = ['pdf'];

        $imgPath = "";
        $filePath = "";

        if (!empty($_FILES["img"]["name"])) {
            $imgName = basename($_FILES["img"]["name"]);
            $imgPath = $targetDirImg . $imgName;
            $imgType = pathinfo($imgName, PATHINFO_EXTENSION);

            if (!in_array($imgType, $allowImageTypes)) {
                return "Error: Only JPG, JPEG, PNG, and GIF files are allowed for images.";
            }

            if (!move_uploaded_file($_FILES["img"]["tmp_name"], $imgPath)) {
                return "Error: Failed to upload image.";
            }
        }

        if (!empty($_FILES["file"]["name"])) {
            $fileName = basename($_FILES["file"]["name"]);
            $filePath = $targetDirPDF . $fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (!in_array($fileType, $allowPDFTypes)) {
                return "Error: Only PDF files are allowed.";
            }

            if (!move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
                return "Error: Failed to upload PDF.";
            }
        }

        $sql = "INSERT INTO `product-service`(`title`, `dec`, `file`, `img`, `category`, `created_at`) 
                VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $title, $dec, $filePath, $imgPath, $cate);

        if ($stmt->execute()) {
            header("Location: viewPS.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function updatePS($title, $dec, $file, $img, $cate, $getID, $conn)
    {
        $targetDirImg = "../uploads/Products_Services/";
        $targetDirPDF = "../uploads/Products_Services/PDF/";

        if (!is_dir($targetDirImg)) {
            mkdir($targetDirImg, 0777, true);
        }

        if (!is_dir($targetDirPDF)) {
            mkdir($targetDirPDF, 0777, true);
        }

        $qry = $conn->prepare("SELECT * FROM `product-service` WHERE `id` = ?");
        $qry->bind_param("i", $getID);
        $qry->execute();
        $qry = $qry->get_result()->fetch_array();

        $imgPath = $qry['img'];
        $filePath = $qry['file'];

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $allowPDFTypes = ['pdf'];

        if (!empty($_FILES["img"]["name"])) {
            $imgName = basename($_FILES["img"]["name"]);
            $imgPath = $targetDirImg . $imgName;
            $imgType = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

            if (!in_array($imgType, $allowImageTypes)) {
                return "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            }

            if (move_uploaded_file($_FILES["img"]["tmp_name"], $imgPath)) {
                if (!empty($qry['img']) && file_exists($qry['img'])) {
                    unlink($qry['img']);
                }
            } else {
                return "Error: Failed to upload new image.";
            }
        }

        if (!empty($_FILES["file"]["name"])) {
            $fileName = basename($_FILES["file"]["name"]);
            $filePath = $targetDirPDF . $fileName;
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!in_array($fileType, $allowPDFTypes)) {
                return "Error: Only PDF files are allowed.";
            }

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
                if (!empty($qry['file']) && file_exists($qry['file'])) {
                    unlink($qry['file']);
                }
            } else {
                return "Error: Failed to upload new PDF file.";
            }
        }

        $sql = "UPDATE `product-service` 
                SET `title` = ?, `dec` = ?, `file` = ?, `img` = ?, `category` = ?, `created_at` = NOW() 
                WHERE `id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $title, $dec, $filePath, $imgPath, $cate, $getID);

        if ($stmt->execute()) {
            header("Location: viewPS.php");
            exit;
        } else {
            return "Error occurred while updating data: " . $stmt->error;
        }
    }

    public static function setGallery($img)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/gallery/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];

        if (empty($img['name'][0])) {
            $sql = "INSERT INTO `gallery` (`img`, `created_at`) VALUES (NULL, NOW())";
            if ($conn->query($sql)) {
                header("Location: viewGallery.php");
                exit;
            } else {
                return "Error occurred while saving data: " . $conn->error;
            }
        }

        $sql = "INSERT INTO `gallery` (`img`, `created_at`) VALUES (?, NOW())";
        $stmt = $conn->prepare($sql);

        foreach ($img['name'] as $key => $fileName) {
            $fileTmp = $img['tmp_name'][$key];
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowTypes)) {
                $uniqueName = time() . "_" . basename($fileName);
                $filePath = $targetDir . $uniqueName;

                if (move_uploaded_file($fileTmp, $filePath)) {
                    $stmt->bind_param("s", $filePath);
                    $stmt->execute();
                }
            }
        }

        header("Location: viewGallery.php");
        exit;
    }

    public static function setContact($map, $number, $email, $address)
    {
        $conn = Database::getConnect();
        $sql = "INSERT INTO `contact`(`map`, `number`, `email`, `address`, `created_at`) 
                VALUES (?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $map, $number, $email, $address);
        
        if ($stmt->execute()) {
            header("Location: viewContact.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        } 
    }

    public static function updateContact($map, $number, $email, $address, $getID)
    {
        $conn = Database::getConnect();
        $sql = "UPDATE `contact` 
                SET `map` = ?, `number` = ?, `email` = ?, `address` = ?, `created_at` = NOW() 
                WHERE `id` = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $map, $number, $email, $address, $getID);
        
        if ($stmt->execute()) {
            header("Location: viewContact.php");
            exit;
        } else {
            return "Error occurred while updating data: " . $stmt->error;
        }
    }

    public static function setSocial($fb, $insta, $wa, $yt)
    {
        $conn = Database::getConnect();
        $sql = "INSERT INTO `social` (`facebook`, `instagram`, `whatsapp`, `youtube`, `created_at`) 
                VALUES (?, ?, ?, ?, NOW())";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fb, $insta, $wa, $yt);
        
        if ($stmt->execute()) {
            header("Location: viewContact.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function updateSocial($fb, $insta, $wa, $yt, $getID)
    {
        $conn = Database::getConnect();
        $sql = "UPDATE `social` 
                SET `facebook` = ?, `instagram` = ?, `whatsapp` = ?, `youtube` = ?, `created_at` = NOW() 
                WHERE `id` = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $fb, $insta, $wa, $yt, $getID);

        if ($stmt->execute()) {
            header("Location: viewContact.php");
            exit;
        } else {
            return "Error occurred while updating data: " . $stmt->error;
        }
    }

    public static function setReview($img, $review, $name, $rating)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/Review/";
        $filePath = "assets/images/user.png";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];

        if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
            $fileName = basename($_FILES["img"]["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowImageTypes)) {
                if (!move_uploaded_file($_FILES["img"]["tmp_name"], $filePath)) {
                    return "Error uploading the image.";
                }
            } else {
                return "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            }
        }

        $sql = "INSERT INTO `review` (`image`, `review`, `name`, `rating`, `created_at`) 
                VALUES (?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $filePath, $review, $name, $rating);

        if ($stmt->execute()) {
            header("Location: viewReviews.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function updateReview($getID, $review, $name, $rating, $img)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/Review/";

        $stmt = $conn->prepare("SELECT `image` FROM `review` WHERE `id` = ?");
        $stmt->bind_param("i", $getID);
        $stmt->execute();
        $result = $stmt->get_result();
        $qry = $result->fetch_assoc();
        $currentImage = $qry['image'];

        $filePath = $currentImage;

        if ($img && $_FILES["img"]["name"] !== "") {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
            $fileName = basename($_FILES["img"]["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowImageTypes)) {
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $filePath)) {
                    if ($currentImage && $currentImage !== "assets/images/user.png" && file_exists($currentImage)) {
                        unlink($currentImage);
                    }
                } else {
                    return "Error uploading image.";
                }
            } else {
                return "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            }
        }

        if ($filePath !== $currentImage) {
            $sql = "UPDATE `review` 
                    SET `image` = ?, `review` = ?, `name` = ?, `rating` = ?, `created_at` = NOW() 
                    WHERE `id` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssii", $filePath, $review, $name, $rating, $getID);
        } else {
            $sql = "UPDATE `review` 
                    SET `review` = ?, `name` = ?, `rating` = ?, `created_at` = NOW() 
                    WHERE `id` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssii", $review, $name, $rating, $getID);
        }

        if ($stmt->execute()) {
            header("Location: viewReviews.php");
            exit;
        } else {
            return "Error occurred while updating data: " . $stmt->error;
        }
    }

    public static function setAboutUs($img1, $img2, $exp, $title, $dec, $point)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/AboutUs/";
    
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $filePath1 = "";
        $filePath2 = "";

        if ($img1 && $_FILES["img1"]["error"] == 0) {
            $fileName1 = basename($_FILES["img1"]["name"]);
            $filePath1 = $targetDir . $fileName1;
            $fileType1 = pathinfo($fileName1, PATHINFO_EXTENSION);

            if (in_array($fileType1, $allowImageTypes)) {
                move_uploaded_file($_FILES["img1"]["tmp_name"], $filePath1);
            } else {
                return "Invalid file type for Image 1. Only JPG, JPEG, PNG, and GIF are allowed.";
            }
        }

        if ($img2 && $_FILES["img2"]["error"] == 0) {
            $fileName2 = basename($_FILES["img2"]["name"]);
            $filePath2 = $targetDir . $fileName2;
            $fileType2 = pathinfo($fileName2, PATHINFO_EXTENSION);

            if (in_array($fileType2, $allowImageTypes)) {
                move_uploaded_file($_FILES["img2"]["tmp_name"], $filePath2);
            } else {
                return "Invalid file type for Image 2. Only JPG, JPEG, PNG, and GIF are allowed.";
            }
        }
    
        $sql = "INSERT INTO `aboutus` (`img1`, `img2`, `exp`, `title`, `dec`, `points`, `created_at`) 
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $filePath1, $filePath2, $exp, $title, $dec, $point);
    
        if ($stmt->execute()) {
            header("Location: viewAboutus.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function updateAboutUs($getID, $img1, $img2, $exp, $title, $dec, $point, $conn)
    {
        $targetDir = "../uploads/AboutUs/";

        $stmt = $conn->prepare("SELECT `img1`, `img2` FROM `aboutus` WHERE `id` = ?");
        $stmt->bind_param("i", $getID);
        $stmt->execute();
        $result = $stmt->get_result();
        $qry = $result->fetch_assoc();
        $currentImg1 = $qry['img1'];
        $currentImg2 = $qry['img2'];

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $filePath1 = $currentImg1;
        $filePath2 = $currentImg2;

        if ($img1 && $_FILES["img1"]["name"] !== "") {
            $fileName1 = basename($_FILES["img1"]["name"]);
            $filePath1 = $targetDir . $fileName1;
            $fileType1 = pathinfo($fileName1, PATHINFO_EXTENSION);

            if (in_array($fileType1, $allowImageTypes)) {
                if (move_uploaded_file($_FILES["img1"]["tmp_name"], $filePath1)) {
                    if ($currentImg1 && file_exists($currentImg1)) {
                        unlink($currentImg1);
                    }
                } else {
                    return "Error uploading Image 1.";
                }
            } else {
                return "Invalid file type for Image 1.";
            }
        }

        if ($img2 && $_FILES["img2"]["name"] !== "") {
            $fileName2 = basename($_FILES["img2"]["name"]);
            $filePath2 = $targetDir . $fileName2;
            $fileType2 = pathinfo($fileName2, PATHINFO_EXTENSION);

            if (in_array($fileType2, $allowImageTypes)) {
                if (move_uploaded_file($_FILES["img2"]["tmp_name"], $filePath2)) {
                    if ($currentImg2 && file_exists($currentImg2)) {
                        unlink($currentImg2);
                    }
                } else {
                    return "Error uploading Image 2.";
                }
            } else {
                return "Invalid file type for Image 2.";
            }
        }

        $sql = "UPDATE `aboutus` 
                SET `exp` = ?, `title` = ?, `dec` = ?, `points` = ?, `created_at` = NOW()";
        $params = ["ssss", $exp, $title, $dec, $point];

        if ($filePath1 !== $currentImg1) {
            $sql .= ", `img1` = ?";
            $params[0] .= "s";
            $params[] = $filePath1;
        }
        if ($filePath2 !== $currentImg2) {
            $sql .= ", `img2` = ?";
            $params[0] .= "s";
            $params[] = $filePath2;
        }

        $sql .= " WHERE `id` = ?";
        $params[0] .= "i";
        $params[] = $getID;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(...$params);

        if ($stmt->execute()) {
            header("Location: viewAboutus.php");
            exit;
        } else {
            return "Error occurred while updating data: " . $stmt->error;
        }
    }

    public static function setHomeAboutUs($img1, $img2, $exp, $title, $dec, $point)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/Home_AboutUs/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $filePath1 = "";
        $filePath2 = "";

        if ($img1 && $_FILES["img1"]["error"] == 0) {
            $fileName1 = basename($_FILES["img1"]["name"]);
            $filePath1 = $targetDir . $fileName1;
            $fileType1 = pathinfo($fileName1, PATHINFO_EXTENSION);

            if (in_array($fileType1, $allowImageTypes)) {
                move_uploaded_file($_FILES["img1"]["tmp_name"], $filePath1);
            } else {
                return "Invalid file type for Image 1. Only JPG, JPEG, PNG, and GIF are allowed.";
            }
        }

        if ($img2 && $_FILES["img2"]["error"] == 0) {
            $fileName2 = basename($_FILES["img2"]["name"]);
            $filePath2 = $targetDir . $fileName2;
            $fileType2 = pathinfo($fileName2, PATHINFO_EXTENSION);

            if (in_array($fileType2, $allowImageTypes)) {
                move_uploaded_file($_FILES["img2"]["tmp_name"], $filePath2);
            } else {
                return "Invalid file type for Image 2. Only JPG, JPEG, PNG, and GIF are allowed.";
            }
        }

        $sql = "INSERT INTO `home-about` (`img1`, `img2`, `exp`, `title`, `dec`, `points`, `created_at`) 
                VALUES (?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $filePath1, $filePath2, $exp, $title, $dec, $point);

        if ($stmt->execute()) {
            header("Location: viewAbout.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function updateHomeAboutUs($getID, $img1, $img2, $exp, $title, $dec, $point, $conn)
    {
        $targetDir = "../uploads/Home_AboutUs/";

        $stmt = $conn->prepare("SELECT `img1`, `img2` FROM `home-about` WHERE `id` = ?");
        $stmt->bind_param("i", $getID);
        $stmt->execute();
        $result = $stmt->get_result();
        $qry = $result->fetch_assoc();
        $currentImg1 = $qry['img1'];
        $currentImg2 = $qry['img2'];

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $filePath1 = $currentImg1;
        $filePath2 = $currentImg2;

        if ($img1 && $_FILES["img1"]["name"] !== "") {
            $fileName1 = basename($_FILES["img1"]["name"]);
            $filePath1 = $targetDir . $fileName1;
            $fileType1 = pathinfo($fileName1, PATHINFO_EXTENSION);

            if (in_array($fileType1, $allowImageTypes)) {
                if (move_uploaded_file($_FILES["img1"]["tmp_name"], $filePath1)) {
                    if ($currentImg1 && file_exists($currentImg1)) {
                        unlink($currentImg1);
                    }
                } else {
                    return "Error uploading Image 1.";
                }
            } else {
                return "Invalid file type for Image 1.";
            }
        }

        if ($img2 && $_FILES["img2"]["name"] !== "") {
            $fileName2 = basename($_FILES["img2"]["name"]);
            $filePath2 = $targetDir . $fileName2;
            $fileType2 = pathinfo($fileName2, PATHINFO_EXTENSION);

            if (in_array($fileType2, $allowImageTypes)) {
                if (move_uploaded_file($_FILES["img2"]["tmp_name"], $filePath2)) {
                    if ($currentImg2 && file_exists($currentImg2)) {
                        unlink($currentImg2);
                    }
                } else {
                    return "Error uploading Image 2.";
                }
            } else {
                return "Invalid file type for Image 2.";
            }
        }

        $sql = "UPDATE `home-about` 
                SET `exp` = ?, `title` = ?, `dec` = ?, `points` = ?, `created_at` = NOW()";
        $params = ["ssss", $exp, $title, $dec, $point];

        if ($filePath1 !== $currentImg1) {
            $sql .= ", `img1` = ?";
            $params[0] .= "s";
            $params[] = $filePath1;
        }
        if ($filePath2 !== $currentImg2) {
            $sql .= ", `img2` = ?";
            $params[0] .= "s";
            $params[] = $filePath2;
        }

        $sql .= " WHERE `id` = ?";
        $params[0] .= "i";
        $params[] = $getID;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(...$params);

        if ($stmt->execute()) {
            header("Location: viewAbout.php");
            exit;
        } else {
            return "Error occurred while updating data: " . $stmt->error;
        }
    }

    public static function setFeateres($title, $dec, $points, $img)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/Home_Feateres/";
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $filePath = "";

        if (!empty($_FILES["img"]["name"])) {
            $fileName = basename($_FILES["img"]["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            
            if (!in_array($fileType, $allowImageTypes) || !move_uploaded_file($_FILES["img"]["tmp_name"], $filePath)) {
                return "Error uploading required file: img.";
            }
        }

        $sql = "INSERT INTO `home-feateres`(`title`, `dec`, `points`, `img`, `created_at`)
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $title, $dec, $points, $filePath);

        if ($stmt->execute()) {
            header("Location: viewFeateres.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function updateFeateres($getID, $title, $dec, $points, $img)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/Home_Feateres/";
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $stmt = $conn->prepare("SELECT * FROM `home-feateres` WHERE `id` = ?");
        $stmt->bind_param("i", $getID);
        $stmt->execute();
        $result = $stmt->get_result();
        $qry = $result->fetch_array();

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];

        if (!empty($_FILES["img"]["name"])) {
            $fileName = basename($_FILES["img"]["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!in_array($fileType, $allowImageTypes)) {
                return "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            }

            if ($_FILES["img"]["size"] > 5 * 1024 * 1024) {
                return "Error: File size exceeds the maximum limit of 5MB.";
            }

            if (!move_uploaded_file($_FILES["img"]["tmp_name"], $filePath)) {
                return "Error: Failed to upload file.";
            }

            if (!empty($qry['img']) && file_exists($qry['img'])) {
                unlink($qry['img']);
            }

            $sql = "UPDATE `home-feateres` SET `title` = ?, `dec` = ?, `points` = ?, `img` = ?, `created_at` = NOW() WHERE `id` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $title, $dec, $points, $filePath, $getID);
        } else {
            $sql = "UPDATE `home-feateres` SET `title` = ?, `dec` = ?, `points` = ?, `created_at` = NOW() WHERE `id` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $title, $dec, $points, $getID);
        }

        if ($stmt->execute()) {
            header("Location: viewFeateres.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function setHomeHero($img, $header, $title, $dec, $b1, $b2)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/Home_Hero/";
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $filePath = "";

        if (!empty($_FILES["img"]["name"])) {
            $fileName = basename($_FILES["img"]["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            
            if (!in_array($fileType, $allowImageTypes) || !move_uploaded_file($_FILES["img"]["tmp_name"], $filePath)) {
                return "Error uploading required file: img.";
            }
        }

        $sql = "INSERT INTO `home-hero`(`img`, `header`, `title`, `dec`, `button_text1`, `button_text2`, `created_at`)
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $filePath, $header, $title, $dec, $b1, $b2);

        if ($stmt->execute()) {
            header("Location: viewHero.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }

    public static function updateHomeHero($getID, $img, $header, $title, $dec, $b1, $b2)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/Home_Hero/";
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $stmt = $conn->prepare("SELECT * FROM `home-hero` WHERE `id` = ?");
        $stmt->bind_param("i", $getID);
        $stmt->execute();
        $result = $stmt->get_result();
        $qry = $result->fetch_array();

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];

        if (!empty($_FILES["img"]["name"])) {
            $fileName = basename($_FILES["img"]["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if (!in_array($fileType, $allowImageTypes)) {
                return "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            }

            if ($_FILES["img"]["size"] > 5 * 1024 * 1024) {
                return "Error: File size exceeds the maximum limit of 5MB.";
            }

            if (!move_uploaded_file($_FILES["img"]["tmp_name"], $filePath)) {
                return "Error: Failed to upload file.";
            }

            if (!empty($qry['img']) && file_exists($qry['img'])) {
                unlink($qry['img']);
            }

            $sql = "UPDATE `home-hero` SET `img` = ?, `header` = ?, `title` = ?, `dec` = ?, `button_text1` = ?, `button_text2` = ?, `created_at` = NOW() WHERE `id` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $filePath, $header, $title, $dec, $b1, $b2, $getID);
        } else {
            $sql = "UPDATE `home-hero` SET `header` = ?, `title` = ?, `dec` = ?, `button_text1` = ?, `button_text2` = ?, `created_at` = NOW() WHERE `id` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $header, $title, $dec, $b1, $b2, $getID);
        }

        if ($stmt->execute()) {
            header("Location: viewHero.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $stmt->error;
        }
    }
    
    public static function setBGHero($img)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/bg_Hero/"; // Define your upload directory
    
        if (!is_dir($targetDir)) {
            // Create directory with proper permissions
            mkdir($targetDir, 0777, true);
        }
    
        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
    
        // Required file uploads
        $requiredFiles = [
            'img' => $_FILES["img"]
        ];
    
        foreach ($requiredFiles as $key => $file) {
            $fileName = basename($file["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    
            // Check for valid image type and successful upload
            if (!in_array(strtolower($fileType), $allowImageTypes) || !move_uploaded_file($file["tmp_name"], $filePath)) {
                return "Error uploading required file: $key.";
            }
        }
    
        // Prepare SQL statement
        $sql = "INSERT INTO `bg-hero` (`img`, `created_at`) VALUES (?, NOW())";
    
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("s", $filePath);
    
            // Execute and check success
            if ($stmt->execute()) {
                $stmt->close();
                header("Location: viewBGHero.php");
                exit;
            } else {
                return "Error occurred while saving data: " . $stmt->error;
            }
        } else {
            return "Error preparing SQL statement: " . $conn->error;
        }
    }

}