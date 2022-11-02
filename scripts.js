let btnCancel = document.querySelector('#task-cancel-btn');
let btnDelete = document.querySelector('#task-delete-btn');
let btnUpdate = document.querySelector('#task-update-btn');
let btnSave = document.querySelector('#task-save-btn');


function addTask () {
    btnUpdate.style.display = 'none';
    btnDelete.style.display = 'none';

    btnCancel.style.display = 'block';
    btnSave.style.display = 'block';
}

function editTask (e,id) {
    
    var title = document.getElementById("task-title") ;
    var date = document.getElementById("task-date") ;
    var description = document.getElementById("task-description") ;

    console.log(title) ;
    console.log(date) ;
    console.log(description) ;
    
    document.getElementById('task-id').value = id;

    btnCancel.style.display = 'block';
    btnSave.style.display = 'none';
    btnUpdate.style.display = 'block';
    btnDelete.style.display = 'block';
}
