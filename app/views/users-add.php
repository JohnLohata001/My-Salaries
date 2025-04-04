<?php if ($page_name == 'users-add'): ?>
<?php include('inc/header.php'); ?>   
<main class="forms"> 
    <section>
        <div class="bcontent">

            <div class="container">
                <div class="form-">
                    <form action="" method="post">                   
                        <input type="submit" name="btn_seach_year" class="box_btn btnSbmt" value="print List" style="max-width: 150px;padding:0.5rem;width:7rem;background:rgba(83, 83, 83, 0.33);border:solid 1px rgba(83, 83, 83, 0.33);color:#fff;font-size:16px;cursor:pointer ">
                        <a href="<?=ROOT?>/user"  class="box_btn btnSbmt" style="max-width: 150px;padding:0.5rem;width:7rem;background:rgba(83, 83, 83, 0.33);border:solid 1px rgba(83, 83, 83, 0.33);color:#fff;font-size:16px;cursor:pointer ;text-decoration:none"> Users list</a>  &nbsp;                   
                        <a href="<?=ROOT?>/home" class="box_btn btnSbmt"  style="max-width: 150px;padding:0.5rem;width:7rem;background:rgba(83, 83, 83, 0.33);border:solid 1px rgba(83, 83, 83, 0.33);color:#fff;font-size:16px;cursor:pointer;text-decoration:none ">  Back Home </a>                     
                    </form> <br>
                </div>
                <hr>
               <form action="" method="post" enctype="multipart/form-data">
                    <div style="display:flex;border:solid 1px #c2c0c0;">
                        <div style="padding:1rem;background-color:#fbfbfb;">
                            <input type="file" name="file" id="filet" style="display:none">
                            <label for="filet" id="image_tag" style="width:160px; height:160px; border: solid 1px #c2c0c0;; padding: 1rem; display: flex; justify-content: center; align-items: center; cursor: pointer;">
                                <img id="imgPlace" src="" alt="Image preview will appear here" style="display:none; width: 160px; height: 160px; ">
                            </label>
                        </div>

                        <table border="0" style="width:100%;border-collapse:collapse">
                            
                            <tr style="border:none;background-color:#fbfbfb;">
                                <td width="5%" style="padding:0.5rem;text-align:right;padding-right:3rem">username</td>
                                <td width="20%" style="padding:0.5rem"><input type="text" name="username" value="<?php isset($_POST['username']) ? $_POST['username'] : ''; ?>" style="padding:0.5rem;width:60%;font-size:16px"></td>  
                            </tr>
                            <tr style="border:none;background-color:#fbfbfb">
                                <td width="5%" style="padding:0.5rem;text-align:right;padding-right:3rem">Email</td>
                                <td width="20%" style="padding:0.5rem"><input type="text" name="email" style="padding:0.5rem;width:60%;font-size:16px"></td>  
                            </tr>
                            <tr style="border:none;background-color:#fbfbfb">
                                <td width="5%" style="padding:0.5rem;text-align:right;padding-right:3rem">Password</td>
                                <td width="20%" style="padding:0.5rem"><input type="password" name="password" style="padding:0.5rem;width:60%;font-size:16px"></td>  
                            </tr>
                            <tr style="border:none;background-color:#fbfbfb">
                                <td width="5%" style="padding:0.5rem"><button type="submit" name="btn-submit" style="float:right;padding:0.5rem 2rem;font-size:16px;cursor:pointer">Insert</button></td>
                                <td width="10%" style="padding:0.5rem"><button type="reset" name="btn-reset" style="padding:0.5rem 2rem;font-size:16px;cursor:pointer">Cancel</button></td>
                            </tr>
                            
                        </table>
                    </div>
               </form>
            </div>
        </div>
    </section>
</main>
<?php include('inc/footer.php'); ?>
<?php endif; ?>
<script>
    document.getElementById("filet").addEventListener("change", function(e) {
        let file = e.target.files[0];  // Access the first selected file
        let reader = new FileReader();
        
        reader.onload = function(e) {
            let img = document.getElementById("imgPlace");
            img.src = e.target.result;  // Set the image preview
            img.style.display = "block";  // Make the image visible after it is loaded
        };
        
        reader.readAsDataURL(file);  // Read the file as a data URL
    });

</script>
