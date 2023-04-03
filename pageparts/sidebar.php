




<div class="container">
  <div>
            
    <div class="user-container">
        <h3>Members:</h3>    
      <?php 
          // https://www.bootdey.com/snippets/view/light-user-list#html         
          $sql="SELECT * FROM users";
          $result_side=$conn->query($sql);
          foreach($result_side as $row4){
            ?>
            <a href="./myPage.php?userid=<?php echo $row4["ID"]?>">
            <div class="user">
                <div class="case">
                  <div >
                    <!-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user" class="profile-photo-lg"> -->
                    <img class="profile-photo-lg" src="./images/<?php if($row4['profile']){echo $row4['profile'];}else{echo "avatar7.png";}?>"></div>
                  <div >
                    <h5 class="h5-test" ><?php echo $row4["First_Name"]." ".$row4["Last_Name"] ?> Page</h5>
                    <p>Software Engineer</p>
                    <p class="text-muted">500m away</p>
                  </div>
                  <!-- <div class="col-md-3 col-sm-3">
                    <button class="btn btn-primary pull-right">Add Friend</button>
                  </div> -->
                </div>
              </div>
            </a>
      <?php }?>

    </div>
            
  </div>
</div>
 










<!-- <tr class="users-list">
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


 -->
