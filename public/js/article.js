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
                return false;
            }
            else { // eсли всe прoшлo oк
                if(info['action'] === 'getComments') {
                    ShowComments(data);
                    document.getElementById('comments_list').innerHTML = '';
                    for (var i = 0; i < data.length; i++) AppendComment(data[i]);
                }
                else if(info['action'] === 'sendComment') {
                    var comments_list = document.getElementById('comments_list');
                    var HTML = comments_list.innerHTML;
                     var HTML = '<li class=list-group-item><span class="commentator"><strong>'+data['user_name']+'</strong></span>: <span class="comment_text">'+data['comment']+'</span><span style="float: right;"><small>A moment ago</small></span></li>' + HTML;
                        comments_list.innerHTML = HTML;
                }
                return true;
            }

        },
            error: function (jqXHR) {
            return false;
            },
            complete: function (data) { // сoбытиe пoслe любoгo исхoдa
                if(info['field'] != '')
                    document.getElementById(info['field']).disabled = false;
            }

        });

}
// DELETE
function Delete(id) {
    var info = {};
    info['type'] = "Delete";
    info['action'] = 'DeleteArticle';
    info['url'] = "article/" + id;
    info['field'] = "icon_delete";
    info['data'] = '';
    var result = AjaxRequest(info);
    document.getElementById('tr_'+id).style.display = 'none';

}

//UPDATE
function Update(id,value,button_name) {
    var info = {};
    info['type'] = "PUT";
    info['action'] = 'UpdateArticle';
    info['url'] = "article/" + id;
    info['field'] = "btn_"+id;
    info['data'] = {};
    info['data']['active'] = value;

    var result = AjaxRequest(info);
    var button = document.getElementById('btn_'+id);
    var text = button.innerText;
    button.innerText = button_name;
    if(value == 1) { button.className = "btn btn-sm btn-outline-success"; button.onclick=function () {Update(id,0,text)};}
    else {button.className = "btn btn-sm btn-outline-primary"; button.onclick= function() {Update(id,1,text)};}

}



// Comments
function getComments(id) {
    var container = document.getElementById('comments_container');
    var status = container.style.display;
    if(status === 'none') {
        var info = {};
        info['type'] = "GET";
        info['url'] = "comments/" + id;
        info['field'] = "comments_button";
        info['data'] = '';
        info['action'] = 'getComments';
        var result = AjaxRequest(info);
    }
    else container.style.display = 'none';
}

function SendComment(id) {
    var container = document.getElementById('button_send_comment');
    if(!container.isDisabled) {
        var info = {};
        info['type'] = "POST";
        info['data'] = {};
        info['action'] = 'sendComment';
            info['data']['text'] = document.getElementById('CommentTextForm').value;
            info['data']['article_id'] = id;

        info['url'] = "comments";
        info['field'] = "button_send_comment";
        var result = AjaxRequest(info);
        document.getElementById("CommentTextForm").value = "";
    }
    else container.isDisabled = true;
}



function ShowForm() {
    var block = document.getElementById('add_comment_block');
    var display = block.style.display;
    if(display === 'none') block.style.display = 'block';
    else block.style.display = 'none';
}

function ShowComments(data) {
  document.getElementById('comments_container').style.display = 'block';
}

function AppendComment(data) {
    var list = document.getElementById('comments_list');
    list.innerHTML += '<li class="list-group-item"><span class="commentator"><strong>'+data['user_name']+':</strong></span><span class="comment_text">'+data['text']+'</span><span style="float:right;"><small>'+data['created_at'].substr(0,16)+'</small></span></li>';
}

