<?php 
$log= new log();
$condition['where'] = array('user' => $sessData['userID'] );
$condition['order_by']="date desc";
$logData= $log->getRows($condition);
?>

<tbody class="list">
<?php 

if($logData){
foreach ($logData as $col) {
?>
                  <tr>
                    
                    <td class="text-center">
                      <a><?php echo $col['date']; ?></a>  
                    </td>
                    <td class="text-center">
                      <a><?php echo $col['des']; ?></a>  
                    </td>

                  </tr>

<?php } } ?>
                </tbody>