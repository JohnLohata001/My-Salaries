<?php include('inc/header.php'); ?><br>

<main class="forms">
    <section>
        <div class="bcontent">
            <div class="container">

                <div class="menu_home">
                    <div class="box_home">
                        <a href="<?=ROOT?>/user">
                            <ul class="users_home">
                                <li class="img_users"><i class="fas fa-users"></i></li>
                                <li class="number_users">
                                    <h3>3 users</h3>
                                </li>
                            </ul>
                        </a>
                    </div>
                    <div class="box_home">
                        <a href="">
                            <ul class="month_home">
                                <li class="img_month"><i class="far fa-calendar-alt"></i></li>
                                <li class="number_month">
                                    <h3><?= date('F') ?></h3>
                                </li>
                            </ul>
                        </a>
                    </div>
                    <div class="box_home">
                        <a href="">
                            <ul class="year_home">
                                <li class="img_year"><i class="far fa-calendar-alt"></i></li>
                                <li class="number_year">
                                    <h3><?= date('Y') ?></h3>
                                </li>
                            </ul>
                        </a>
                    </div>
                    <div class="box_hom last_box">
                        <ul class="last_box_home">
                            <li class="img_last">
                                <marquee behavior="1" scrollamount="2">Welcome <?= strtoupper($_SESSION['USER']['username'])?> in our financialy space</marquee>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </section>
</main>
<?php

// function resizeImageToSquare($file, $size) {
//     list($width, $height, $type) = getimagesize($file);
//     $types = [1 => 'gif', 2 => 'jpeg', 3 => 'png']; // Supported formats
//     if (!isset($types[$type])) die("Unsupported format");

//     $createFunc = "imagecreatefrom" . $types[$type];
//     $outputFunc = "image" . $types[$type];

//     $src = $createFunc($file);

//     // Calculate the dimensions for cropping the image to square
//     $cropSize = min($width, $height); // Take the smaller dimension (width or height)

//     // Calculate the coordinates to crop the image from the center
//     $cropX = ($width - $cropSize) / 2;
//     $cropY = ($height - $cropSize) / 2;

//     // Create a new image resource for the cropped image
//     $dst = imagecreatetruecolor($cropSize, $cropSize);

//     // Crop the image to the center
//     imagecopyresampled($dst, $src, 0, 0, $cropX, $cropY, $cropSize, $cropSize, $cropSize, $cropSize);

//     // Now resize the cropped image to the target size (e.g., 1000x1000)
//     $resizedDst = imagecreatetruecolor($size, $size);
//     imagecopyresampled($resizedDst, $dst, 0, 0, 0, 0, $size, $size, $cropSize, $cropSize);

//     // Save the resized image
//     $newFile = "resized_square.{$types[$type]}";
//     $outputFunc($resizedDst, $newFile); // Save resized image

//     imagedestroy($src);
//     imagedestroy($dst);
//     imagedestroy($resizedDst);

//     return $newFile; // Return file path
// }



// if (isset($_POST['upload']) && $_FILES['image']['tmp_name']) {
//     $resizedFile = resizeImageToSquare($_FILES['image']['tmp_name'], 250);
//     echo "<p>Image resized successfully. <a href='$resizedFile'>View Image</a></p>";
// }
?>
<!-- HTML Form -->
<!-- <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image">
    <input type="submit" name="upload" value="Resize Image">
</form> -->



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
<?php include('inc/footer.php'); ?>