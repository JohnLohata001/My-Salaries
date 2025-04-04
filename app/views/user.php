    
<?php include('inc/header.php'); ?>
<main class="forms"> 
    <section>
        <div class="bcontent">

            <div class="container">
                <div class="form-">
                    <form action="" method="post">                   
                        <input type="submit" name="btn_seach_year" class="box_btn btnSbmt" value="print List" style="max-width: 150px;padding:0.5rem;width:7rem;background:rgba(83, 83, 83, 0.33);border:solid 1px rgba(83, 83, 83, 0.33);color:#fff;font-size:16px;cursor:pointer ">
                        <a href="<?=ROOT?>/users-add"  class="box_btn btnSbmt" style="max-width: 150px;padding:0.5rem;width:7rem;background:rgba(83, 83, 83, 0.33);border:solid 1px rgba(83, 83, 83, 0.33);color:#fff;font-size:16px;cursor:pointer ;text-decoration:none">  Add Users </a>  &nbsp;                   
                        <a href="<?=ROOT?>/home" class="box_btn btnSbmt"  style="max-width: 150px;padding:0.5rem;width:7rem;background:rgba(83, 83, 83, 0.33);border:solid 1px rgba(83, 83, 83, 0.33);color:#fff;font-size:16px;cursor:pointer;text-decoration:none ">  Back Home </a>                     
                    </form> <br>
                </div>
                <hr>
               
                <table border="0" style="width:100%;border-collapse:collapse">
                    <thead>
                    <tr style="border:solid 1px #c2c0c0;border-left:none;border-right:none;background-color:#fbfbfb">
                            <th width="5%" style="padding:0.7rem">N*</th>
                            <th width="15%">images</th>
                            <th width="25%">Usernames</th>
                            <th width="25%">Emails</th>
                            <th width="20%">Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $results = selectAll('users');?>
                            <?php $i=1; foreach($results as $result): ?>

                                <tr style="border:solid 1px #c2c0c0;border-left:none;border-right:none;background-color:#fbfbfb">
                                    
                                    <td style="padding:0.7rem"><?=$i++?></td>
                                    <td width="20%"><img src="./../public/assets/img/<?=$result['user_image']?>" style="width:50px;height:50px;object-fit:cover;padding:2px;border:solid 1px #eee"></td>
                                    <td width="30%"><?=$result['username']?></td>
                                    <td width="30%"><?=$result['email']?></td>
                                    <td width="10%">
                                        <a href="<?=ROOT?>/admin/users/del/<?=$result['id']?>" style="padding:0.2rem 0.5rem;text-decoration:none;font-size:20px;border:solid 1px red;color:red;border-radius:3px"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <a href="<?=ROOT?>/admin/users/edit/<?=$result['id']?>" style="padding:0.2rem 0.5rem;text-decoration:none;font-size:20px;border:solid 1px green;color:green;border-radius:3px"><i class="fa fa-pen-square" aria-hidden="true"></i></a>
                                    </td>
                                    
                                
                                </tr>
                            <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
<?php include('inc/footer.php'); ?>