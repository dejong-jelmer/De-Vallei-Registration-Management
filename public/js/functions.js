const ids = [];

// Wait untill DOM is loaded
document.addEventListener('DOMContentLoaded', function (event){
    

    // on form change make submit button visable
    if(document.querySelector('#form')) {
        var form = document.querySelector('#form');
        
        form.addEventListener('change', function(){
            var form = document.querySelector('#formSubmit');

            formSubmit.classList.remove('hidden');

        } );
        
    }

    // set the selected color as background color of the select
    if(document.querySelector('.colorSelect')) {
    
        var colorSelects = document.getElementsByClassName('colorSelect');

        for(var i = 0; i < colorSelects.length; i++){
            colorSelects[i].addEventListener('change', function(i){
                this.style.background = this.selectedOptions[0].style.background;
            });
        }
        
    }


    // select all students in the multiple sudent select (aanwezigheid.index)
    if(document.querySelector('#allStudents') && document.querySelector('#allStatuses') && document.querySelector('#studentSelect')) {
        var selectAllStudents = document.querySelector('#allStudents');
        var students = document.querySelector('#studentSelect').options;

        selectAllStudents.addEventListener('click', function(){
            if(this.checked) {
                for(var i = 0; i < students.length; i++) {
                    students[i].selected = true;
                }
            } else {
                for(var i = 0; i < students.length; i++) {
                    students[i].selected = false;
                }
            }
        });
    }

    // if 'verwijder' checkbox is checked make delete button visable
    if(document.querySelector('#deleteCheck') && document.querySelector('#deleteBtn')) {
        var deleteCheck = document.querySelector('#deleteCheck');
        var deleteBtn = document.querySelector('#deleteBtn');
        deleteCheck.addEventListener('click', function(){
            if(this.checked) {
                deleteBtn.removeAttribute('hidden');
                this.parentNode.setAttribute('hidden', 'true');
                this.checked = false;
            }
        });

        // safety confirm before student details are softdeleted
        deleteBtn.addEventListener('click', function(){
            if(confirm('Weet je zeker dat je deze leerling/coach en alle gegevens wilt verwijderen?')) {
                document.deleteForm.submit(); 

            } else {
                deleteBtn.setAttribute('hidden', 'true');
                deleteCheck.parentNode.removeAttribute('hidden');

            }
        });
    }

    // check all selectboxes with classname 'form-checkbox'
    if(document.querySelector('#selectCheckboxes')) {
        var allCheckboxes = document.getElementsByClassName('form-checkbox');
        var selectCheckboxes = document.querySelector('#selectCheckboxes');

        selectCheckboxes.addEventListener('click', function() {
            if(this.checked) {
                for(var i = 0; i < allCheckboxes.length; i++) {
                    allCheckboxes[i].checked = true;
                }
            } else {
                for(var i = 0; i < allCheckboxes.length; i++) {
                    allCheckboxes[i].checked = false;
                }
            }

        });
    }

    // 
    if(document.querySelector('.idCheckbox')){
        var idCheckbox = document.getElementsByClassName('idCheckbox');

        for(var i = 0; i < idCheckbox.length; i++) {
            idCheckbox[i].checked = false;
            idCheckbox[i].addEventListener('click', function(){
                document.getElementById('submitIds').value = setIds(this);
                
            });
        }
    }




});

function setIds(e)
{
    
    if(e.checked) {
        ids.push(e.value);

    } else {

        var index = ids.indexOf(e.value);
        if(index !== -1) {
            ids.splice(index, 1);
        }

    }
    console.log(ids);
    return ids
}

// add id to submit url
function setSubmitIdToUrl(url, id)
{
    // split url to array and reverse array
    url = url.split('/');
    url = url.reverse();

    
    if(isNumeric(url[0])) {
        url.shift();
        // if first element of array is still a number reverse and join array for recursion
        if(isNumeric(url[0])) {
            url = url.reverse();
            url = url.join('/');
            setSubmitIdToUrl(url, id);
        }
    }

    // reverse array back to original and add the new status id
    url = url.reverse();
    url.push(id);

    // join array back together to string
    url = url.join('/');

    // console.log(url);
    return url;

}

// check if var is a number
function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}

// add a class to elements selected by their classname
// excepts object with class:'new classname' and classname: [array of classnames as query selector]
function addClassToElementByClassName(obj) {

    var newClass = obj.class;
    for(var index = 0; index < obj.classnames.length; index++) {

        classname = obj.classnames[index];

        var e = document.getElementsByClassName(classname);
        
        for(var i = 0; i < e.length; i++ ) {

            e[i].classList.add(newClass);
        }
    }
}

// remove a class from elements selected by their classname
// excepts object with class:'old classname' and classname: [array of classnames as query selector]
function removeClassToElementByClassName(obj) {

    var oldClass = obj.class;
    for(var index = 0; index < obj.classnames.length; index++) {

        classname = obj.classnames[index];

        var e = document.getElementsByClassName(classname);
        
        for(var i = 0; i < e.length; i++ ) {

            e[i].classList.remove(oldClass);
        }
    }
}