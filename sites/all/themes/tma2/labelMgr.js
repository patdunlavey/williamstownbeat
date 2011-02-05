function showLabel(type){
if (type == "username"){

if (window.document.getElementById('custom-edit-name').value.length != 0){
  window.document.getElementById('custom-username-label').style.visibility = 'visible';
alert('make username label visible');
  }

}else{

if (window.document.getElementById('custom-edit-pass').value.length != 0){
  window.document.getElementById('custom-password-label').style.visibility = 'visible';
alert('make password label visible');
}

}

}

function hideLabel(type){

if (type == "username"){

window.document.getElementById('custom-username-label').style.visibility = 'hidden';
alert('hide username label');

}else{

window.document.getElementById('custom-password-label').style.visibility = 'hidden';
alert('hide password label');

}

}

/*

in the inputs for the username and password add the following

labels:
id="username-label"
id="password-label"

inputs:
onfocus="hideLabel('username')" onblur="showLabel('username')"
onfocus="hideLabel()" or onblur="showLabel()"

*/