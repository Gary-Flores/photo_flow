function clearForm(ele) {
    tags = document.getElementsByTagName('input');
    for(i = 0; i < tags.length; i++) {
        if (tags[i].name.startsWith(ele)) {
            switch(tags[i].type) {
                case 'tel':
                case 'date':
                case 'email':
                case 'password':
                case 'text':
                    tags[i].value = '';
                    break;
                case 'checkbox':
                case 'radio':
                    tags[i].checked = false;
                    break;
            }
        }
    }
    tags = document.getElementsByTagName('textarea');
    for(i = 0; i < tags.length; i++) {
        if (tags[i].name.startsWith(ele)) {
            tags[i].value = '';
        }
    }
    tags = document.getElementsByTagName('select');
    for(i = 0; i < tags.length; i++) {
        if(tags[i].type == 'select-one') {
            tags[i].selectedIndex = 0;
        }
        else {
            for(j = 0; j < tags[i].options.length; j++) {
                tags[i].options[j].selected = false;
            }
        }
    }
    document.getElementById(ele + "message").style.display = 'none';
}
