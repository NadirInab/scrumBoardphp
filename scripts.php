<?php
    include('database.php');
    session_start();

    if(isset($_POST['save']))        saveTask();
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();

    $count = 0;
    function getTasks($status)
    {
        require 'database.php';
        $query = "SELECT * FROM tasks WHERE status_id = '$status' ";
        $result = mysqli_query($connection,$query);
        global $count;
        while ($row = mysqli_fetch_array($result)) {
            $count++;
            $priority_id =  $row['priority_id'];
            $priorityQuery = "SELECT * FROM priorities WHERE id = ${priority_id}";
            $priorityData = mysqli_query($connection,$priorityQuery);
            $priorityResult =  mysqli_fetch_array($priorityData);

            $type_id = $row['type_id'];
            $typeQuery = "SELECT * FROM types WHERE id = ${type_id} ";
            $typeData = mysqli_query($connection,$typeQuery);
            $typeResult = mysqli_fetch_array($typeData);

            if ($status == 1) {
               $icon = 'bi bi-question-circle fs-3 text-success';
            }else if ($status == 2) {
                $icon = 'spinner-border spinner-border-sm text-success mt-1';
            }else $icon = 'bi bi-check-circle fs-3 text-success';
        
           echo '
           <button onClick="editTask(this,'.$row['id'].')" data-bs-toggle="modal" href="#modal-task" class="row mx-0 bg-white p-1 border-0 border-bottom btn-tasks">
           <input type="hidden" id="data" value="">
               <div class="col-1">
                 <i class="'.$icon.'"></i> 
               </div>
               <div class="col-10 text-start">
                  <div "class="fw-bold fs-5 text-truncate">'.$row['title'].'</div>
                    <div >
                      <div class="text-black-50">#'.$count.' created in '.$row['task_date'].' </div>
                      <div class="mb-2 text-truncate" title="as they can be helpful in reproducing the steps that caused the problem in the first place."> '.$row['description'].' </div>
                    </div>
                    <div class="pb-1">
                      <span class="bg-primary text-white p-1 rounded-1 fw-bold"> '.$priorityResult['name'].' </span>
                      <span class="bg-light-600 p-1 rounded-1 m-1 fw-bold"> '.$typeResult['name'].' </span>
                    </div>

               </div>
         </button>';   
        }
    }


    function saveTask()
    {
        require 'database.php';

        $title = $_POST['title'];
        $type = $_POST['task-type'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        $insertQuery = "INSERT INTO tasks(`title`, `type_id`, `priority_id`, `status_id`, `task_date`, `description`) 
                        VALUES('$title', '$type', '$priority', '$status', '$date', '$description')";
        $query = mysqli_query($connection,$insertQuery);
        $_SESSION['message'] = "Task has been added successfully !";
		    header('location: index.php');
    }

    function updateTask(){
        require 'database.php';
        // echo "<pre>" ;
        //   var_dump($_POST) ;
        // echo "</pre>" ; 

        //die() ;

        $id = $_POST['id'];
        $title = $_POST['title'];
        $type = $_POST['task-type'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $date = $_POST['date'];
        $description = $_POST['description'];

        $updateQuary = "UPDATE tasks 
                        SET title = '$title', description = '$description', type_id = '$type', priority_id = '$priority', status_id = '$status', task_date = '$date'
                        WHERE id = '$id'";
        mysqli_query($connection,$updateQuary);
        $_SESSION['message'] = "Task has been updated successfully !";
		    header('location: index.php');
    }



    function deleteTask(){
      require 'database.php';
        $id = $_POST['id'];
        $deleteQuery = "DELETE FROM tasks WHERE id='$id'";
         $result= mysqli_query($connection,$deleteQuery);
        $_SESSION['message'] = "Task has been deleted successfully !";
		    header('location: index.php');
    }



    function counter($status){
      require 'database.php';

      $countAllRows = "SELECT * FROM tasks WHERE status_id = '$status' ";

      $query1 = mysqli_query($connection,$countAllRows); 
      $count1 = mysqli_num_rows($query1);
      return $count1;
    }

?>