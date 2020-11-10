<?php 
$userData= $user->getRows();
$forum=new Forum();
?>

<tbody class="list">
<?php 
foreach ($userData as $col) {
if($col['id']!=$sessData['userID']){
  $id=rand(100,999)."a".$forum->encode($col['id'])."".rand(100,999)."z";
  $permits=$forum->encode($col['permits']);
  $url=$id;
?>
                  <tr>
                    <td class="text-center">
                      <a><?php echo $col['first_name']; ?></a>  
                    </td>
                    <td class="text-center">
                      <a><?php echo $col['last_name']; ?></a>  
                    </td>
                    <td class="text-center">
                      <a><?php echo $col['created']; ?></a>  
                    </td>
                    <td>
                      <a><?php echo $col['modified']; ?></a>  
                    </td>
                    <td class="text-center">
                      <form action="../userAccount.php" method="POST">
                        <input type="hidden" name="atc" value="<?php echo $id; ?>">
                      <select name="ptc">
                        <option value="1"<?php if($col['permits']=='1'){ ?> selected="selected"<?php } ?> >Leer</option>
                        <option value="11"<?php if($col['permits']=='11'){?> selected="selected" <?php } ?> >Agregar</option>
                        <option value="111" <?php if($col['permits']=='111'){?> selected="selected" <?php } ?>?>Eliminar</option>
                      </select>
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <input type="submit" name="perSubmit" class="dropdown-item" value="Actualizar">
                          <a class="dropdown-item" href="../userAccount.php?dtc=<?php echo $url; ?>">Eliminar</a>
                        </form>
                        </div>
                      </div>
                    </td>

                  </tr>

<?php } } ?>
                </tbody>