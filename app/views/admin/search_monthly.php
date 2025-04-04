<?php



if (isset($_POST['btn_seach_year'])) {

    $year = trim($_POST['year_search']);

    $rows = getTotalHoursByMonthYear($table, $year);
    
    

}

?>      
   
<main class="forms"> 
    <section>
        <div class="bcontent">

            <div class="container">
                <div class="form-">
                    <form action="" method="post">                        
                        <select name="year_search" style="max-width: 150px;padding:0.5rem;width:10rem;font-size:16px">
                            
                            <option value="A">Select Year</option>
                                <?php 
                                    $selectedYear = isset($_POST['year_search']) ? $_POST['year_search'] : ''; 
                                    for ($y = 2020; $y < 2060; $y++): 
                                ?>
                             <option value="<?=$y?>" <?= ($y == $selectedYear) ? 'selected' : '' ?>><?=$y?></option>
                             <?php endfor; ?>
                        </select>                    
                        <input type="submit" name="btn_seach_year" class="box_btn btnSbmt" value="Validate" style="max-width: 150px;padding:0.5rem;width:5rem;background:rgba(83, 83, 83, 0.33);border:solid 1px rgba(83, 83, 83, 0.33);color:#fff;font-size:16px;cursor:pointer ">
                        <a href="<?=ROOT?>/admin/search_monthly"  class="box_btn btnSbmt" style="max-width: 150px;padding:0.5rem;width:5rem;background:rgba(83, 83, 83, 0.33);border:solid 2px rgba(83, 83, 83, 0.33);color:#fff;font-size:16px;cursor:pointer;text-decoration:none "> Cancel</a>                       
                    </form> <br>
                </div>
                <hr>
                <?php if( count($mistake) > 0 ){echo ' No data Found for this year';} ?>
                <table border="0" style="width:100%;border-collapse:collapse">
                    <thead>
                    <tr style="border:solid 1px #c2c0c0;border-left:none;border-right:none;background-color:#fbfbfb">
                            <th style="padding:0.7rem">N*</th>
                            <th width="30%">Month</th>
                            <th width="20%">Year</th>
                            <th width="15%">Total Hours</th>
                            <th width="20%">Total Money</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($rows) :?>
                            <?php 
                                $i=1;
                                foreach($rows as $row):

                                    $month_year = $row['month_year'];
                                    list($year, $month) = explode('-', $month_year);
                            
                                    // Convert month number to month name
                                    $month_name = DateTime::createFromFormat('!m', $month)->format('F');
                                    
                                    // Get total hours
                                    $total_hours = $row['total_hours'];

                                    // Calculate money: Example $50 per hour (adjust as necessary)
                                    $total_money = $total_hours * 5;
                                                        ?>

                                <tr style='border-bottom:solid 1px #c2c0c0;'>
                                    <td  style='padding:0.5rem;text-align:center'><?=$i++?></td>
                                    <td  style='padding:0.5rem;text-align:center'><?=$month_name ?></td>
                                    <td  style='padding:0.5rem;text-align:center'><?=$year ?></td>
                                    <td  style='padding:0.5rem;text-align:center'><?= $total_hours ?></td>
                                    <td  style='padding:0.5rem;text-align:center'><?=$total_money?></td>
                                    <td  style='padding:0.5rem;text-align:center'><a href="<?=ROOT?>/admin/search_monthly/<?=$year ?>/<?=$month_name ?>" style="text-decoration:none;color:red;border:solid 1px red;padding:0.1rem 0.5rem;border-radius:0.2rem;font-size:14px"><?='Details'?></a></td>
                                </tr>

                            <?php endforeach;?>
                        <?php else:?>
                            <?php array_push($mistake, 'No result Found')?>
                        <?php endif;?>
                    </tbody>
                </table>
                <?php
                
                            if( isset($url[3]) && isset($url[2]) ){
                                
                                $month = date('n',  strtotime($url[3]));
                                $year = $url[2];
                                $DateMonth = $year. '-'. str_pad($month, 2, '0', STR_PAD_LEFT);

                            
                                

                                $table = 'my_times';
                                $rows_date = SelectMonthYear($table, $DateMonth);

                                if($rows_date){
                                    echo "<table border='1' style='border-collapse:collapse;width:100%'>";
                                    echo "
                                    <br>
                                    <tr style='border-bottom:solid 1px #c2c0c0;backround:#eee'>
                                        <th  style='padding:0.5rem;text-align:center'>Date Started</th>
                                        <th  style='padding:0.5rem;text-align:center'>Date Ended</th>
                                        <th  style='padding:0.5rem;text-align:center'> Hours</th>
                                        <th  style='padding:0.5rem;text-align:center'> Money</th>
                                        
                                    </tr>
                                ";

                                    foreach($rows_date as $row){
                                        echo "

                                            <tr style='border-bottom:solid 1px #c2c0c0;'>
                                                <td  style='padding:0.5rem;text-align:center'>". $row['time_started'] ."</td>
                                                <td  style='padding:0.5rem;text-align:center'>". $row['time_ended'] ."</td>
                                                <td  style='padding:0.5rem;text-align:center'>" . getTimeDifference($row['time_started'], $row['time_ended']) . "</td>
                                                <td  style='padding:0.5rem;text-align:center'><td>
                                                
                                            </tr>
                                        ";
                                  
                                    }
                                    echo "</table>";
                                }else{
                                    echo 'Not Found';
                                }
                                

                            }

                            // ====================================================================
                            
                
                ?>
            </div>
        </div>
    </section>
</main>

