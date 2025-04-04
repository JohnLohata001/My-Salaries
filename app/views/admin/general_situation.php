<main class="forms">          
        <section >
            <div class="bcontent">
                <div class="container">  <br>
                    <!-- <button type="button" onclick="window.location.href='monthly_list'" class="btn-print" style="width: 150px;color:white" target="_blank">Print All info</button><br><br> -->
                    <a href="<?=ROOT?>/admin/print-current-month" class="btn-printer" style="width: 150px;color:white;padding:12px;background:red;text-decoration:none" ><i class="fa fa-print" aria-hidden="true"></i> Print All info</a><br><br>
                    <div class="bcontent">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Start Date</th>
                                    <th>Time Started </th>
                                    <th>End Date</th>
                                    <th>Ended Time</th>
                                    <th>Total Times</th>
                                    <th>Money</th>
                                    <th>Actioins</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                            <?php 
                                $total=0; 
                                $i=1; 
                                $rows = current_date('my_times');  

                                foreach($rows as $row):
                            ?>

                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=substr($row['time_started'],0, 10) ?></td>
                                    <td><?=substr($row['time_started'], 10, 16) ?></td>
                                    <td><?=substr($row['time_ended'],0, 10) ?></td>
                                    <td><?=substr($row['time_ended'], 10, 16) ?></td>
                                    <td>
                                    <?php
                                        $timeStart = strtotime($row['time_started']);
                                        $timeEnd = strtotime($row['time_ended']);
                                        $hourWork = ($timeEnd-$timeStart);
                                        echo floor($hourWork / (60*60));
                                    ?>
                                    </td>
                                    <td>
                                        <?php 
                                                            
                                            echo "€ " . number_format(floor($hourWork / (60*60)*5), 2);
                                            $tot = floor($hourWork / (60*60)*5);
                                            $total=$total+$tot;

                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?=ROOT?>/home/<?=$row['id'];?>" class="font-edit" style="padding:5px;color:green;border:solid 1px green"><i class="fas fa-edit"></i></a>
                                        <a href="<?=ROOT?>/home/<?=$row['id'];?>" class="font-del" style="padding:5px;color:red;border:solid 1px red"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                    </td>
                                </tr>
                                <?php endforeach;?>  
                            <tfoot>
                                <tr>
                                    <th colspan="4"><h1>General Total</h1></th>
                                    <th>
                                    <h1><?=number_format($total, 2); ?></h1>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </section>
</main>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>