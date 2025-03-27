<?php

class User
{
    public static function login($username, $password)
    {
        Session::start();
        $conn = Database::getConnect();
        
        $sql = "SELECT `id`, `password` FROM `auth` WHERE `username` = '$username' OR `email` = '$username'";
        $res = $conn->query($sql);
        if ($res->num_rows === 1)
        {
            $row = $res->fetch_assoc();
            if ($password === $row['password'])
            {
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

        // Insert data into database
        $sql = "INSERT INTO `cate` (`page`, `category`, `created_at`)
                VALUES ('$page', '$title', NOW())";

        if ($conn->query($sql)) {
            header("Location: addCate.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $conn->error;
        }
    }
    public static function updatePageCategory($getID, $page, $title, $conn)
    {
        // Update data into database
        $sql = "UPDATE `cate` SET `page` = '$page', `category` = '$title', `created_at` = NOW() WHERE `id` = '$getID'";

        if ($conn->query($sql)) {
            header("Location: viewPS.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $conn->error;
        }
    }
    public static function setCategory($cate, $category)
    {
        $conn = Database::getConnect();

        // Insert data into database
        $sql = "INSERT INTO `ps-category` (`cate`, `category`, `created_at`)
                VALUES ('$cate', '$category', NOW())";

        if ($conn->query($sql)) {
            header("Location: viewPS.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $conn->error;
        }
    }
    public static function updateCategory($getID, $cate, $category, $conn)
    {
        // Update data into database
        $sql = "UPDATE `ps-category` SET `cate` = '$cate', `category` = '$category', `created_at` = NOW() WHERE `id` = '$getID'";

        if ($conn->query($sql)) {
            header("Location: viewPS.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $conn->error;
        }
    }

    public static function setPS($title, $dec, $file, $img, $cate, $conn)
    {
        // $conn = Database::getConnect();

        // Define upload directories
        $targetDirImg = "../uploads/Products_Services/"; // Image directory
        $targetDirPDF = "../uploads/Products_Services/PDF/"; // PDF directory

        // Create directories if not exist
        if (!is_dir($targetDirImg)) {
            mkdir($targetDirImg, 0777, true);
        }

        if (!is_dir($targetDirPDF)) {
            mkdir($targetDirPDF, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $allowPDFTypes = ['pdf'];

        $imgPath = ""; // Default empty if no image is uploaded
        $filePath = ""; // Default empty if no PDF is uploaded

        // Check and upload image if provided
        if (!empty($_FILES["img"]["name"])) {
            $imgName = basename($_FILES["img"]["name"]);
            $imgPath = $targetDirImg . $imgName;
            $imgType = pathinfo($imgName, PATHINFO_EXTENSION);

            // Validate image
            if (!in_array($imgType, $allowImageTypes)) {
                return "Error: Only JPG, JPEG, PNG, and GIF files are allowed for images.";
            }

            if (!move_uploaded_file($_FILES["img"]["tmp_name"], $imgPath)) {
                return "Error: Failed to upload image.";
            }
        }

        // Check and upload PDF if provided
        if (!empty($_FILES["file"]["name"])) {
            $fileName = basename($_FILES["file"]["name"]);
            $filePath = $targetDirPDF . $fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // Validate PDF
            if (!in_array($fileType, $allowPDFTypes)) {
                return "Error: Only PDF files are allowed.";
            }

            if (!move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
                return "Error: Failed to upload PDF.";
            }
        }

        // Insert data into the database
        $sql = "INSERT INTO `product-service`(`title`, `dec`, `file`, `img`, `category`, `created_at`) 
                VALUES ('$title', '$dec', '$filePath', '$imgPath', '$cate', NOW())";

        if ($conn->query($sql)) {
            header("Location: viewPS.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $conn->error;
        }
    }
    public static function updatePS($title, $dec, $file, $img, $cate, $getID, $conn)
    {
        // $conn = Database::getConnect();

        // Define upload directories
        $targetDirImg = "../uploads/Products_Services/"; // Image directory
        $targetDirPDF = "../uploads/Products_Services/PDF/"; // PDF directory

        // Create directories if not exist
        if (!is_dir($targetDirImg)) {
            mkdir($targetDirImg, 0777, true);
        }

        if (!is_dir($targetDirPDF)) {
            mkdir($targetDirPDF, 0777, true);
        }

        // Fetch existing data
        $qry = $conn->query("SELECT * FROM `product-service` WHERE `id` = '$getID'")->fetch_array();

        $imgPath = $qry['img'];  // Default to existing image if no new one
        $filePath = $qry['file']; // Default to existing PDF if no new one

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
        $allowPDFTypes = ['pdf'];

        // Check if a new image is uploaded
        if (!empty($_FILES["img"]["name"])) {
            $imgName = basename($_FILES["img"]["name"]);
            $imgPath = $targetDirImg . $imgName;
            $imgType = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

            // Validate image type
            if (!in_array($imgType, $allowImageTypes)) {
                return "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            }

            // Move new image and delete old one if it exists
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $imgPath)) {
                if (!empty($qry['img']) && file_exists($qry['img'])) {
                    unlink($qry['img']);
                }
            } else {
                return "Error: Failed to upload new image.";
            }
        }

        // Check if a new PDF file is uploaded
        if (!empty($_FILES["file"]["name"])) {
            $fileName = basename($_FILES["file"]["name"]);
            $filePath = $targetDirPDF . $fileName;
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Validate PDF type
            if (!in_array($fileType, $allowPDFTypes)) {
                return "Error: Only PDF files are allowed.";
            }

            // Move new PDF and delete old one if it exists
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
                if (!empty($qry['file']) && file_exists($qry['file'])) {
                    unlink($qry['file']);
                }
            } else {
                return "Error: Failed to upload new PDF file.";
            }
        }

        // Prepare SQL query
        $sql = "UPDATE `product-service` 
                SET `title` = ?, `dec` = ?, `file` = ?, `img` = ?, `category` = ?, `created_at` = NOW() 
                WHERE `id` = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $title, $dec, $filePath, $imgPath, $cate, $getID);

        // Execute the statement
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

        // If no images are uploaded, insert only category
        if (empty($img['name'][0])) {
            $sql = "INSERT INTO `gallery` (`img`, `created_at`) 
                    VALUES (NULL, NOW())";
            if ($conn->query($sql)) {
                header("Location: viewGallery.php");
                exit;
            } else {
                return "Error occurred while saving data: " . $conn->error;
            }
        }

        // Upload multiple images
        foreach ($img['name'] as $key => $fileName) {
            $fileTmp = $img['tmp_name'][$key];
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            if (in_array($fileType, $allowTypes)) {
                $uniqueName = time() . "_" . basename($fileName);
                $filePath = $targetDir . $uniqueName;

                if (move_uploaded_file($fileTmp, $filePath)) {
                    // Insert each image separately
                    $sql = "INSERT INTO `gallery` (`img`, `created_at`) 
                            VALUES ('$filePath', NOW())";
                    $conn->query($sql);
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
        $stmt->bind_param("ssss", $map, $number, $email, $address); // Use "s" for string parameters
        
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
                SET `map` = ?, 
                    `number` = ?, 
                    `email` = ?, 
                    `address` = ?, 
                    `created_at` = NOW() 
                WHERE `id` = ?"; // Assuming you're updating a single record with ID = 1

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $map, $number, $email, $address, $getID); // Use "s" for string parameters
        
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
        $stmt->bind_param("ssss", $fb, $insta, $wa, $yt); // Use "s" for string parameters
        
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
                SET `facebook` = ?, 
                    `instagram` = ?, 
                    `whatsapp` = ?, 
                    `youtube` = ?, 
                    `created_at` = NOW() 
                WHERE `id` = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $fb, $insta, $wa, $yt, $getID); // "s" for strings, "i" for integer

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
        $targetDir = "../uploads/Review/"; // Define your upload directory

        // Create directory if not exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];

        // Default image path if no file uploaded
        $filePath = "assets/images/user.png"; // Default image if no upload

        // Check if an image is uploaded
        if (isset($_FILES["img"]) && $_FILES["img"]["error"] == 0) {
            $fileName = basename($_FILES["img"]["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // Validate file type
            if (in_array($fileType, $allowImageTypes)) {
                // Move uploaded file to target directory
                if (!move_uploaded_file($_FILES["img"]["tmp_name"], $filePath)) {
                    return "Error uploading the image.";
                }
            } else {
                return "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            }
        }

        // Insert data into the `review` table
        $sql = "INSERT INTO `review` (`image`, `review`, `name`, `rating`, `created_at`) 
                VALUES (?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $filePath, $review, $name, $rating);

        // Execute and redirect if successful
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
        $targetDir = "../uploads/Review/"; // Define your upload directory

        // Get current review details to check the existing image
        $qry = $conn->query("SELECT `image` FROM `review` WHERE `id` = '$getID'")->fetch_assoc();
        $currentImage = $qry['image'];

        // Handle file upload if a new image is provided
        $filePath = $currentImage; // Keep the old image by default

        if ($img && $_FILES["img"]["name"] !== "") {
            if (!is_dir($targetDir)) {
                // Create directory with proper permissions
                mkdir($targetDir, 0777, true);
            }

            $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];
            $fileName = basename($_FILES["img"]["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            // Check file type and upload file if valid
            if (in_array($fileType, $allowImageTypes)) {
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $filePath)) {
                    // Delete old image if it’s not the default
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

        // Prepare SQL query
        if ($filePath !== $currentImage) {
            // Update including image if a new one is provided
            $sql = "UPDATE `review` 
                    SET `image` = ?, 
                        `review` = ?, 
                        `name` = ?, 
                        `rating` = ?, 
                        `created_at` = NOW() 
                    WHERE `id` = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssii", $filePath, $review, $name, $rating, $getID);
        } else {
            // Update without changing the image
            $sql = "UPDATE `review` 
                    SET `review` = ?, 
                        `name` = ?, 
                        `rating` = ?, 
                        `created_at` = NOW() 
                    WHERE `id` = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssii", $review, $name, $rating, $getID);
        }

        // Execute query
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
        $targetDir = "../uploads/AboutUs/"; // Define your upload directory

        // Create directory if not exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];

        // Handle first image upload
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

        // Handle second image upload
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

        // Insert data into the `about_us` table
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
    public static function updateAboutUs($getID, $img1, $img2, $exp, $title, $dec, $point)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/AboutUs/"; // Define your upload directory

        // Get current data to retain old images if no new image is provided
        $qry = $conn->query("SELECT `img1`, `img2` FROM `aboutus` WHERE `id` = '$getID'")->fetch_assoc();
        $currentImg1 = $qry['img1'];
        $currentImg2 = $qry['img2'];

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];

        // Handle first image upload (only replace if a new valid image is uploaded)
        $filePath1 = $currentImg1;
        if ($img1 && $_FILES["img1"]["name"] !== "") {
            $fileName1 = basename($_FILES["img1"]["name"]);
            $filePath1 = $targetDir . $fileName1;
            $fileType1 = pathinfo($fileName1, PATHINFO_EXTENSION);

            if (in_array($fileType1, $allowImageTypes)) {
                if (move_uploaded_file($_FILES["img1"]["tmp_name"], $filePath1)) {
                    // Delete old image if not empty and exists
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

        // Handle second image upload (only replace if a new valid image is uploaded)
        $filePath2 = $currentImg2;
        if ($img2 && $_FILES["img2"]["name"] !== "") {
            $fileName2 = basename($_FILES["img2"]["name"]);
            $filePath2 = $targetDir . $fileName2;
            $fileType2 = pathinfo($fileName2, PATHINFO_EXTENSION);

            if (in_array($fileType2, $allowImageTypes)) {
                if (move_uploaded_file($_FILES["img2"]["tmp_name"], $filePath2)) {
                    // Delete old image if not empty and exists
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

        // Prepare dynamic SQL query to exclude empty image values
        $sql = "UPDATE `aboutus` 
                SET `exp` = ?, 
                    `title` = ?, 
                    `dec` = ?, 
                    `points` = ?, 
                    `created_at` = NOW()";

        $params = ["ssss", $exp, $title, $dec, $point]; // Initial parameters

        // Check if new images were uploaded
        if ($filePath1 !== $currentImg1) {
            $sql .= ", `img1` = ? ";
            $params[0] .= "s";
            $params[] = $filePath1;
        }
        if ($filePath2 !== $currentImg2) {
            $sql .= ", `img2` = ? ";
            $params[0] .= "s";
            $params[] = $filePath2;
        }

        $sql .= "WHERE `id` = ?";
        $params[0] .= "i";
        $params[] = $getID;

        // Prepare and bind dynamically
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(...$params);

        // Execute query
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
        $targetDir = "../uploads/Home_AboutUs/"; // Define your upload directory

        // Create directory if not exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];

        // Handle first image upload
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

        // Handle second image upload
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

        // Insert data into the `about_us` table
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
    public static function updateHomeAboutUs($getID, $img1, $img2, $exp, $title, $dec, $point)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/Home_AboutUs/"; // Define your upload directory

        // Get current data to retain old images if no new image is provided
        $qry = $conn->query("SELECT `img1`, `img2` FROM `home-about` WHERE `id` = '$getID'")->fetch_assoc();
        $currentImg1 = $qry['img1'];
        $currentImg2 = $qry['img2'];

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];

        // Handle first image upload (only replace if a new valid image is uploaded)
        $filePath1 = $currentImg1;
        if ($img1 && $_FILES["img1"]["name"] !== "") {
            $fileName1 = basename($_FILES["img1"]["name"]);
            $filePath1 = $targetDir . $fileName1;
            $fileType1 = pathinfo($fileName1, PATHINFO_EXTENSION);

            if (in_array($fileType1, $allowImageTypes)) {
                if (move_uploaded_file($_FILES["img1"]["tmp_name"], $filePath1)) {
                    // Delete old image if not empty and exists
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

        // Handle second image upload (only replace if a new valid image is uploaded)
        $filePath2 = $currentImg2;
        if ($img2 && $_FILES["img2"]["name"] !== "") {
            $fileName2 = basename($_FILES["img2"]["name"]);
            $filePath2 = $targetDir . $fileName2;
            $fileType2 = pathinfo($fileName2, PATHINFO_EXTENSION);

            if (in_array($fileType2, $allowImageTypes)) {
                if (move_uploaded_file($_FILES["img2"]["tmp_name"], $filePath2)) {
                    // Delete old image if not empty and exists
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

        // Prepare dynamic SQL query to exclude empty image values
        $sql = "UPDATE `home-about` 
                SET `exp` = ?, 
                    `title` = ?, 
                    `dec` = ?, 
                    `points` = ?, 
                    `created_at` = NOW()";

        $params = ["ssss", $exp, $title, $dec, $point]; // Initial parameters

        // Check if new images were uploaded
        if ($filePath1 !== $currentImg1) {
            $sql .= ", `img1` = ? ";
            $params[0] .= "s";
            $params[] = $filePath1;
        }
        if ($filePath2 !== $currentImg2) {
            $sql .= ", `img2` = ? ";
            $params[0] .= "s";
            $params[] = $filePath2;
        }

        $sql .= "WHERE `id` = ?";
        $params[0] .= "i";
        $params[] = $getID;

        // Prepare and bind dynamically
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(...$params);

        // Execute query
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
        $targetDir = "../uploads/Home_Feateres/"; // Define your upload directory
        
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
            
            if (!in_array($fileType, $allowImageTypes) || !move_uploaded_file($file["tmp_name"], $filePath)) {
                return "Error uploading required file: $key.";
            }
            $$key = $filePath; // Dynamically assign variable with directory
        }

        // Insert data into database
        $sql = "INSERT INTO `home-feateres`(`title`, `dec`, `points`, `img`, `created_at`)
                VALUES ('$title', '$dec', '$points', '$filePath', NOW())";

        if ($conn->query($sql)) {
            header("Location: viewFeateres.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $conn->error;
        }
    }
    public static function updateFeateres($getID, $title, $dec, $points, $img)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/Home_Feateres/"; // Define your upload directory
        
        if (!is_dir($targetDir)) {
            // Create directory with proper permissions
            mkdir($targetDir, 0777, true);
        }

        $qry = $conn->query("SELECT * FROM `home-feateres` WHERE `id` = '$getID'")->fetch_array();

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];

        // Check if a file was uploaded
        if (!empty($_FILES["img"]["name"])) {
            $fileName = basename($_FILES["img"]["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Validate file type
            if (!in_array($fileType, $allowImageTypes)) {
                return "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            }

            // Validate file size (e.g., 5MB max)
            if ($_FILES["img"]["size"] > 5 * 1024 * 1024) {
                return "Error: File size exceeds the maximum limit of 5MB.";
            }

            // Move uploaded file to target directory
            if (!move_uploaded_file($_FILES["img"]["tmp_name"], $filePath)) {
                return "Error: Failed to upload file.";
            }

            // Delete old image if it exists
            if (!empty($qry['img']) && file_exists($qry['img'])) {
                unlink($qry['img']);
            }

            // Update database with new image path
            $sql = "UPDATE `home-feateres` SET `title` = '$title', `dec` = '$dec', `points` = '$points', `img` = '$filePath', `created_at` = NOW() WHERE `id` = '$getID'";
        } else {
            // Update database without changing the image
            $sql = "UPDATE `home-feateres` SET `title` = '$title', `dec` = '$dec', `points` = '$points', `created_at` = NOW() WHERE `id` = '$getID'";
        }

        if ($conn->query($sql)) {
            header("Location: viewFeateres.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $conn->error;
        }
    }

    public static function setHomeHero($img, $header, $title, $dec, $b1, $b2)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/Home_Hero/"; // Define your upload directory
        
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
            
            if (!in_array($fileType, $allowImageTypes) || !move_uploaded_file($file["tmp_name"], $filePath)) {
                return "Error uploading required file: $key.";
            }
            $$key = $filePath; // Dynamically assign variable with directory
        }

        // Insert data into database
        $sql = "INSERT INTO `home-hero`(`img`, `header`, `title`, `dec`, `button_text1`, `button_text2`, `created_at`)
                VALUES ('$filePath', '$header', '$title', '$dec', '$b1', '$b2', NOW())";

        if ($conn->query($sql)) {
            header("Location: viewHero.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $conn->error;
        }
    }
    public static function updateHomeHero($getID, $img, $header, $title, $dec, $b1, $b2)
    {
        $conn = Database::getConnect();
        $targetDir = "../uploads/Home_Hero/"; // Define your upload directory
        
        if (!is_dir($targetDir)) {
            // Create directory with proper permissions
            mkdir($targetDir, 0777, true);
        }

        $qry = $conn->query("SELECT * FROM `home-hero` WHERE `id` = '$getID'")->fetch_array();

        $allowImageTypes = ['jpg', 'png', 'jpeg', 'gif'];

        // Check if a file was uploaded
        if (!empty($_FILES["img"]["name"])) {
            $fileName = basename($_FILES["img"]["name"]);
            $filePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Validate file type
            if (!in_array($fileType, $allowImageTypes)) {
                return "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
            }

            // Validate file size (e.g., 5MB max)
            if ($_FILES["img"]["size"] > 5 * 1024 * 1024) {
                return "Error: File size exceeds the maximum limit of 5MB.";
            }

            // Move uploaded file to target directory
            if (!move_uploaded_file($_FILES["img"]["tmp_name"], $filePath)) {
                return "Error: Failed to upload file.";
            }

            // Delete old image if it exists
            if (!empty($qry['img']) && file_exists($qry['img'])) {
                unlink($qry['img']);
            }

            // Update database with new image path
            $sql = "UPDATE `home-hero` SET `img` = '$filePath', `header` = '$header', `title` = '$title', `dec` = '$dec', `button_text1` = '$b1', `button_text2` = '$b2', `created_at` = NOW() WHERE `id` = '$getID'";
        } else {
            // Update database without changing the image
            $sql = "UPDATE `home-hero` SET `header` = '$header', `title` = '$title', `dec` = '$dec', `button_text1` = '$b1', `button_text2` = '$b2', `created_at` = NOW() WHERE `id` = '$getID'";
        }

        if ($conn->query($sql)) {
            header("Location: viewHero.php");
            exit;
        } else {
            return "Error occurred while saving data: " . $conn->error;
        }
    }

}

?>