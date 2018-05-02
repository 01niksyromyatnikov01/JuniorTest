function AjaxRequest(info) {
    $.ajax({ // инициaлизируeм ajax зaпрoс
        type: info['type'], // oтпрaвляeм в POST фoрмaтe, мoжнo GET
        url: '/api/'+info['url'],
        dataType: 'json', // oтвeт ждeм в json фoрмaтe
        data: info['data'], // дaнныe для oтпрaвки
        beforeSend: function (data) {
            if(info['field'] != '')  document.getElementById(info['field']).disabled = true;
        },
        success: function (data) {
            if (data['error']) { // eсли oбрaбoтчик вeрнул oшибку

            }
            else if(data['result']) { // eсли всe прoшлo oк
                ChangeButton(info['buttonText'],info['data']['user_id'])
            }

        },
        error: function (jqXHR) {
        },
        complete: function (data) { // сoбытиe пoслe любoгo исхoдa
            if(info['field'] != '')
                document.getElementById(info['field']).disabled = false;
        }

    });

}
// Comments
function Subscribe(id) {
   //status = document.getElementById('sub_button').isDisabled;
    //if(!status) {
        var info = {};
        info['type'] = "POST";
        info['url'] = "users/subscribe";
        info['field'] = "sub_button";
        info['data'] = {};
        info['data']['user_id'] = id;
        info['buttonText'] = 'Unsubscribe';
        AjaxRequest(info);
    //}
}

function ChangeButton(action,id) {
   var counter =  parseInt(document.getElementById('subs_counter').innerText);
   var block = document.getElementById('sub_button_block');
   if(action === 'Unsubscribe')  counter += 1;
   else counter-= 1;
   block.innerHTML = '<button id="sub_button" class="btn btn-outline-danger" onclick="'+action+'('+id+')" >'+action+': <span id="subs_counter">'+counter+'</span></button>';

}

function Unsubscribe(id) {
    //if(!status) {
        var info = {};
        info['type'] = "DELETE";
        info['url'] = "users/unsubscribe";
        info['field'] = "sub_button";
        info['data'] = {};
        info['data']['user_id'] = id;
        info['buttonText'] = 'Subscribe';
        AjaxRequest(info);

    //}
}
