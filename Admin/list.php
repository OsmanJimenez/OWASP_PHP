<?php 
$forum= new Forum();
$condition['where'] = array('users.id' => 'forum.user' );
$forumData= $forum->getRows($condition);
$per=$sessData['permits'];

?>

<tbody class="list">
<?php 

if($forumData){
foreach ($forumData as $col) {
$url=$forum->encode($col['id']);
?>
                  <tr>
                    
                    <td class="text-center">
                      <a><?php echo $col['title']; ?></a>  
                    </td>
                    <td class="text-center">
                      <a><?php echo $col['entry']; ?></a>  
                    </td>
                    <td class="text-center">
                      <a><?php echo $col['created']; ?></a>  
                    </td>
                    <td class="text-center">
                      <a><?php echo $col['first_name']; ?></a>  
                    </td>
                    <td class="text-center">
                      <a><?php echo $col['modified']; ?></a>
                      <?php if($per!='1' && $per!='1111' ){ ?>  
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <?php if($per=="11" || $per=="111"){ ?>
                          <a class="dropdown-item" href="verpub.php?m=<?php echo $url; ?>">Editar</a>
                          <?php } if($per=="111"){ ?>
                          <a class="dropdown-item" href="entry.php?del=<?php echo $url; ?>">Eliminar</a>
                        <?php }} ?>
                        </div>
                      </div>
                    </td>

                  </tr>

<?php } } ?>
                </tbody>