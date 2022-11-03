<?php
    include('database.php');
    session_start();

    if(isset($_POST['save']))        saveTask();
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();


    function getTasks($status)
    {
        require 'database.php';
         $query = " SELECT tasks.id as taskID ,title, task_date, description, priorities.name as taskPriority, types.name as taskType , statuses.id as tasksStatus
                    FROM tasks
                    JOIN priorities ON priorities.id = tasks.priority_id
                    JOIN types ON types.id = tasks.type_id 
                    JOIN statuses ON statuses.id = tasks.status_id
                    WHERE statuses.id = '$status'";

        $result = mysqli_query($connection,$query);
        while($data = mysqli_fetch_assoc($result)){

            if ($data["tasksStatus"] == 1) {
               $icon = 'bi bi-question-circle fs-3 text-success';
            }else if ($data["tasksStatus"] == 2) {
                $icon = 'spinner-border spinner-border-sm text-success mt-1';
            }else $icon = 'bi bi-check-circle fs-3 text-success';

           echo '
           <button onClick="editTask(this,'.$data['taskID'].')" data-bs-toggle="modal" href="#modal-task" class="row mx-0 bg-white p-1 border-0 border-bottom btn-tasks">
               <div class="col-1">
                 <i class="'.$icon.'"></i> 
               </div>
               <div class="col-10 text-start">
                  <div class="fw-normal fs-5 text-truncate">'.$data['title'].'</div>
                    <div >
                      <div value="'.$data['task_date'].'" class="text-black-50"> created in '.$data['task_date'].' </div>
                      <div class="mb-2 text-truncate" > '.$data['description'].' </div>
                    </div>
                    <div class="pb-1">
                      <span value="'.$data['taskPriority'].'" class="bg-primary text-white p-1 rounded-1 fw-bold">'.$data['taskPriority'].' </span>
                      <span value="'.$data['taskType'].'" class="bg-light-600 p-1 rounded-1 m-1 fw-bold"> '.$data['taskType'].' </span>
                    </div>
               </div>
            </button>';   
        }
    }

    function saveTask(){
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
		    // header('location: index.php');
    }

    function updateTask(){
        require 'database.php';

        $id = $_POST['id'];
        $title = $_POST['title'];
        $type = $_POST['task-type'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        
        $updateQuery = "UPDATE tasks 
                        SET title = '$title', description = '$description', type_id = '$type', priority_id = '$priority', status_id = '$status', task_date = '$date'
                        WHERE id = '$id'";

        mysqli_query($connection,$updateQuery);
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

      $countQuery = "SELECT * FROM tasks WHERE status_id = '$status' ";
      $query = mysqli_query($connection,$countQuery); 
      $rowCount = mysqli_num_rows($query);
      return $rowCount;
    }

?>