
<?php

    $tot = 0;
    $totale = 0;
    $total_times = 0;
    $result = [];

    if (isset($_POST["btn-search"])) {
        unset($_POST["btn-search"]);
    
        $date1 = date('Y-m-d', strtotime($_POST["started"]));
        $date2 = date('Y-m-d', strtotime($_POST["ended"]));
    
        if (!empty($date1) && !empty($date2)) {
            global $conn;
            $sql = "SELECT * FROM my_times WHERE STR_TO_DATE(date_type, '%Y-%m-%d') BETWEEN ? AND ? ORDER BY date_type ASC";
            $stmt = $conn->prepare($sql);
    
            if ($stmt) {
                $stmt->bind_param("ss", $date1, $date2);
                if ($stmt->execute()) {
                    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                } else {
                    $result = [];
                    echo "Error in execution: " . $stmt->error;
                }
            } else {
                $result = [];
                echo "Error in query preparation: " . $conn->error;
            }
        } else {
            $result = [];
        }
    } else {
        $result = [];
    }


?>
       <!-- style="width:60%;margin:2rem auto; background:#fff;padding:1rem;min-height:300px" -->
   
<main class="forms"> 
<section>
        <div class="bcontent">

            <div class="container">
                    <form action="" method="post">

                        <div style="display:flex;">
                            <div style="width:40%;display:flex">
                                <input type="date" name="started" id="timeStart" value="<?=isset($_POST['started']) ? $_POST['started'] : '' ; ?>" placeholder="select date" style="max-width: 350px;padding:0.5rem;width:15rem;border:solid 1px rgba(83, 83, 83, 0.33);color:#000;font-size:16px;cursor:pointer">
                                <input type="date" name="ended" id="timeEnded" value="<?=isset($_POST['ended']) ? $_POST['ended'] : '' ; ?>" placeholder="select date" style="max-width: 350px;padding:0.5rem;width:15rem;border:solid 1px rgba(83, 83, 83, 0.33);color:#000;font-size:16px;cursor:pointer">
                            </div>  
                           
                            <div style="width:40%;display:flex"> 
                                <input type="submit" name="btn-search" class="box_btn btnSbmt" value="Validate" style="max-width: 350px;padding:0.5rem;width:8rem;border:solid 1px rgba(83, 83, 83, 0.33);color:#000;font-size:16px;cursor:pointer">
                                <input type="submit" name="btn_cancel" class="box_btn btnCancel" value="Cancel" style="max-width: 350px;padding:0.5rem;width:7.9rem;border:solid 1px rgba(83, 83, 83, 0.33);color:#000;font-size:16px;cursor:pointer">
                            </div> 
                        </div>   
                       
                    </form> <br>

                <table id="tblConten" width="100%" style="width:100%;border-collapse:collapse">
                    <thead>
                    
                    <tr style="border:solid 1px #c2c0c0;border-left:none;border-right:none;background-color:#fbfbfb">
                        <th width=10% style="text-align: center;padding:10px;color:black">N* </th>
                        <th width=20%>Time Started</th>
                        <th width=20%>Time Ended</th>
                        <th width=15%>Total Times</th>
                        <th width=15%>Money</th>
                        <th width=20%>Desc</th>
                    </tr>  
                    </thead>
                    <tbody>
                        <?php $i=1; if(count($result) > 0): ?>
                            <?php foreach($result as $date):?>
                                <tr  style='border-bottom:solid 1px #c2c0c0;'>
                                    <td style="text-align: center;padding:5px"><?=$i++ ?></td>
                                    <td style='padding:0.5rem;text-align:center'><?=$date['time_started']?></td>
                                    <td style='padding:0.5rem;text-align:center'><?=$date['time_ended']?></td>
                                    <td style='padding:0.5rem;text-align:center'>
                                        <?php
                                                $timeStart = strtotime($date['time_started']);
                                                $timeEnd = strtotime($date['time_ended']);
                                                $hourWork = ($timeEnd-$timeStart);
                                                echo floor($hourWork / (60*60));
                                                $total_times += floor($hourWork / (60*60));

                                        ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                            $money = floor($hourWork / (60*60)*5);
                                            echo $money;
                                            $totale += $money;                                        
                                        ?>
                                    </td>
                                    <td align="center">
                                        <?=$date['descriptions']?>
                                    </td>
                                </tr>

                            <?php endforeach;?>
                        <?php endif;?>

                        <tr colspan="6" id="tbllast" align="right">
                            <td colspan="3"><h3>  <?php //$total;?></h3></td>
                            <td  align="center"><h4 style="color:red"><?=$total_times . 'h';?> <?php //$total;?></h4></td>
                            <td  align="center"><h4 style="color:red"><?=' € ' . $totale;?><?php //$total;?></h4></td>
                            <td><a href="#" class="box_btn btn_history">Create story</a></td>

                        </tr>
                        <tr colspan="6" id="tbllast" align="right">
                            <td colspan="3"><h3>  <?php $total=0;?></h3></td>
                            <td colspan="2" align="center">
                                <h2>  
                                    <?=' € ' . $totale;?>
                                </h2>
                            </td>
                            <td align="center"><a href="#" class="box_btn btn_print">Print </a></td>

                        </tr>
                    </tbody>
                </table>
               
            </div>
        </div>
    </section>
   
</main>

