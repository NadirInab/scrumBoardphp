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
    
    var myTitle = e.children[1].children[0].innerText ;
    var myDate = e.children[1].children[1].children[0].getAttribute('value') ;
    var myDescription = e.children[1].children[1].children[1].innerText ;
    var myPriority = e.children[1].children[2].children[0].getAttribute('value') ;
    var taskType = e.children[1].children[2].children[1].getAttribute('value') ;
    var formPriority ;
    var taskFeature = document.getElementById("task-type-feature") ;
    var taskBug = document.getElementById("task-type-bug") ;
    var title = document.getElementById("task-title") ;
    var date = document.getElementById("task-date") ;
    var description = document.getElementById("task-description") ;
    var priority = document.getElementById("task-priority") ;

    (myPriority == "Low") ? formPriority = 1 : (myPriority == "Medium") ? formPriority = 2 : (myPriority == "Hard") ? formPriority = 3 : formPriority = 4 ;
    (taskType == "Feature") ?  taskFeature.checked = true : taskBug.checked = true  ;
    title.value = myTitle ;
    date.value = myDate ;
    description.value = myDescription ;
    priority.value = formPriority ;

    document.getElementById('task-id').value = id;
    btnCancel.style.display = 'block';
    btnSave.style.display = 'none';
    btnUpdate.style.display = 'block';
    btnDelete.style.display = 'block';
}
