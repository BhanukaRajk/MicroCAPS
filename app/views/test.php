
<?php

// print_r($data['user']);

if (isset($data['example'])){
    echo '<h1>Hi'.$data['example'].'</h1>';
} else {
    echo '<form action="'.URL_ROOT.'test/viewtest" method="POST">
    <input type="text" name="example" value="'.$data['user']->firstname.'">
    <button type="submit">Submit</button>
    </form>';
}


<div class="container2">
    
  <form action="'.URL_ROOT.'admins/editEmployee" method="POST">
    <div class="row1">
        <div class="column left">
            <input type="text" id="ctry" name="lastname" placeholder="last Name" value="<?php echo $data['user']->Firstname?>">  
        </div>
        <div class="column right">
            <!-- <input type="text" id="ctry" name="firstname" placeholder="first Name" value="<?php //echo $data['user']->lastname?>"> -->
        </div>
      </div>

      <input type="text" id="fname" name="nic" placeholder="nic" value="<?php echo $data['user']->NIC?>">
      <input type="text" id="fname" name="contact" placeholder="contact" value="<?php echo $data['user']->TelephoneNo?>">
      <input type="text" id="fname" name="email" placeholder="email" value="<?php echo $data['user']->Email?>">
      <input type="text" id="fname" name="role" placeholder="role" value="<?php echo $data['user']->Position?>">
      <div class="text-center margin-top-3">
                    <button class="btn btn-primary" type="button" onclick="editEmployee()">
                        Submit
                    </button>
                </div>

     
  </form>' ;
  </div>
</div>


