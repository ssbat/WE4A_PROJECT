




<div class="conteneur">
    
         
    <div class="user-dashboard-info-box table-responsive ">
        <table class="table manage-users-top ">
          <thead>
                <tr>
                  <th>Candidate Name</th>
                  
                </tr>
            </thead>
            <tbody>
            <?php 
              // echo "ho";
              // !!!!!!!!!!!!1
              // https://www.bootdey.com/snippets/view/light-user-list#html         
              $sql="SELECT * FROM users";
              $result_side=$conn->query($sql);
              // echo $result_side->rowC
              // echo $result_side->rowCount();
              foreach($result_side as $row4){
                ?>
                  <tr class="users-list">
                    <td class="title">
                        <a href="./myPage.php?userid=<?php echo $row4["ID"]?>">
                        
                          <div class="thumb">
                              <img class="img-fluid" src="./images/<?php
                                                                if($row4['profile']){
                                                                echo $row4['profile'];
                                                                // echo "HI";
                                                                }else{
                                                                echo "unknown.png";
                                                                }

                                                        ?>">
                          </div>
                        </a>
                        <a href="./myPage.php?userid=<?php echo $row4["ID"]?>" >
                          <div class="user-list-details">
                              <div class="user-list-info">
                                  <div class="user-list-title">
                                      <h5 ><?php echo $row4["First_Name"]." ".$row4["Last_Name"] ?></h5>
                                  </div>
                                  <div class="user-list-option">
                                      <ul class="list-unstyled">
                                          <li>Information Technology</li>
                                          <li>Rolling Meadows, IL 60008</li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                        
                        </a>
                      </td>
                  </tr> 
          
                <?php }?>
            </tbody>
        </table>
    </div>

</div>















