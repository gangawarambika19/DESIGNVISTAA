const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');
if(bar){
    bar.addEventListener('click',() =>{
        nav.classList.add('active');
    })
}
if(close){
    close.addEventListener('click',() =>{
        nav.classList.remove('active');
    })
}

const deleteIcons = document.querySelectorAll('.delete-icon');

// Loop through the icons and add a click event listener
deleteIcons.forEach(icon => {
    icon.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        const row = this.closest('tr'); // Find the closest parent <tr> element
        row.remove(); // Remove the row from the table
    });
});