let btnCancel = document.querySelector('#task-cancel-btn');
let btnDelete = document.querySelector('#task-delete-btn');
let btnUpdate = document.querySelector('#task-update-btn');
let btnSave = document.querySelector('#task-save-btn');

// ________________________

var description = document.getElementById("task-description") ;

console.log(description)


// ________________________


// let data = document.getElementById("data") ;

// console.log(data.value);


function addTask () {
    btnUpdate.style.display = 'none';
    btnDelete.style.display = 'none';

    btnCancel.style.display = 'block';
    btnSave.style.display = 'block';
}

function editTask (e,id) {
    console.log(e);
    console.log(id) ;
    document.getElementById('task-id').value = id;

    btnCancel.style.display = 'block';
    btnSave.style.display = 'none';
    btnUpdate.style.display = 'block';
    btnDelete.style.display = 'block';
}
