const url = 'http://localhost/adevirp/';
const forms = document.querySelectorAll('form');

forms.forEach((item)=>{
    item.addEventListener('submit', (e)=>{
        e.preventDefault();
        const form = document.querySelector('[name="'+e.target.name+'"]');
        const page = url+e.target.name;
        removeAlerts(form);
        
        postRequest(form, page);
    });
});

function postRequest(form, page){
    const formData = new FormData(form);

    fetch(page, {headers: {'X-Requested-With': 'XMLHttpRequest'}, method: 'post', body: formData})
   
        // Converting received data to JSON
        .then(response => response.json())
        .then(json => {
            console.log(json);
            if(json.isValid === false && typeof json.failure != 'undefined'){
                const br = document.createElement('br');
                form.prepend(br);
                form.prepend(createAlert('failure', json.failure));
            }else if(json.isValid === true && typeof json.redirect != 'undefined'){
                window.location.replace(json.redirect);
            }else if(json.isValid === true && typeof json.success != 'undefined'){
                const type = json.success.split(' ')[1];
                if(type === 'adicionado'){
                    form.reset();
                }
                const br = document.createElement('br');
                form.prepend(br);
                form.prepend(createAlert('success', json.success));
            }else if(json.isValid === false){
                setAlerts(json.alerts);
            }
    });
}

function testRequest(form, page){
    const formData = new FormData(form);

    fetch(page, {headers: {'X-Requested-With': 'XMLHttpRequest'}, method: 'post', body: formData})
   
        // Converting received data to JSON
        .then(response => response.text())
        .then(text => {
            console.log(text);
    });
}

function setAlerts(alerts){
    for (const [inputName, value] of Object.entries(alerts)) {
        if(value != true){
            const input = inputError(inputName);
            const alert = createAlert('error', value);
            insertAfter(alert, input);
        }
    }
}

function removeAlerts(form){
    const alerts = form.querySelectorAll('.alert');
    alerts.forEach(alert => {
        alert.remove();
    });

    const inputsErrors = form.querySelectorAll('.input--error');
    inputsErrors.forEach(error =>{
        error.classList.remove('input--error');
    });
}

function inputError(name){
    let input = document.getElementsByName(name);
    input[0].classList.add('input--error');

    return input[0];
}

function createAlert(type, text){
    let alert = document.createElement('span');
    alert.classList.add('alert');
    alert.classList.add('alert--'+type);
    alert.innerHTML = text;

    return alert;
}

function insertAfter(newNode, existingNode) {
    existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
}