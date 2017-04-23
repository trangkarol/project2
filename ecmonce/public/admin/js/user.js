$(document).ready(function() {
	// click on search
    $(document).on('click', '#btn-search', function(){
        search(0);
    });

    // delelete
    $(document).on('click', '.btn-delete', function(event) {
        $(this).parents('.delete-form-user').addClass('current');
        event.preventDefault();
        bootbox.confirm('Are you want to delete?', function(result) {
            if (result) {
                $('.delete-form-user.current').submit();
            }
        });
    });

    //handel pagination by ajax
    $(document).on('click', '.search.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        search(page);
    });

});

function search(page) {
    var data = $('#user-search').serialize();

	url = action['user_search'];
	if (page) {
		url += '?page=' + page;
	}

	$.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data,
       	success:function(data) {
            console.log(data);
            if (data.result) {
                $('#result-users').empty();
                $('#result-users').html(data.html);
                $('.pagination').addClass('search');
                if (page){
                    location.hash='?page='+page;
                }
            }
        }
    });
}

function addSkill(event, flag) {
    var skillId = $('#skillId-skill').val();
    var userId = $('#userId-skill').val();
    var exeper = $('.exeper').val();
    var level = $('.level').val();

    $.ajax({
        type: 'POST',
        url: action['user_add_skill'],
        dataType: 'json',
        data: {
            skillId : skillId,
            exeper : exeper,
            level : level,
            userId : userId,
            flag : flag,
        },
        success:function(data){
            if (data.result) {
                $('#result-skill').html();
                $('#result-skill').html(data.html);
                $.colorbox.close();
                var messages = trans['msg_edit_skill_sucess'];
                if (flag == 1) {
                    messages = trans['msg_add_skill_sucess'];
                }

                bootbox.alert(messages);
                $('.skill:checked').parent().remove();
            } else {
                bootbox.alert(trans['msg_fail']);
            }

            $('.err-exeper').html();
        },
        error: function(data){
            var errors = data.responseJSON;
           $('.err-exeper').text(errors.exeper);
        }
    });
}


function deleteSkill(skillId) {
    var userId = $('#userId').val();

    $.ajax({
        type: 'POST',
        url: action['user_delete_skill'],
        dataType: 'json',
        data: {
            skillId : skillId,
            userId : userId,
        },
        success:function(data) {
            if (data.result) {
                bootbox.alert(trans['msg_delete_skill_sucess'], function() {
                    $('#result-skill').html();
                    $('#result-skill').html(data.html);
                });

            } else {
                bootbox.alert('Fail!');
            }
        }
    });
}

function positionTeam(teamId, flag) {
    var userId = $('#userId').val();

    $.ajax({
        type : 'POST',
        url : action['user_position_team'],
        dataType : 'json',
        data : {
            teamId : teamId,
            userId : userId,
            flag : flag,
        },
        success:function(data) {
            $.colorbox({ html: data.html });
        }
    });
}

function addTeam(event,flag) {
    var teamId = $('#teamId-postion').val();
    var userId = $('#userId-postion').val();

    var positions = [];
    $('.position:checked').each(function() {
        positions.push($(this).val());
    });

    $.ajax({
        type : 'POST',
        url : action['user_add_team'],
        dataType : 'json',
        data : {
            teamId : teamId,
            userId : userId,
            positions : positions,
            flag : flag,
        },
        success:function(data) {
            $.colorbox.close();
            if (data.result) {
                var messages = trans['msg_update_success'];
                if (data.flag) {
                    messages = trans['msg_insert_success'];
                }

                bootbox.alert(messages);
                $('#result-team').html();
                $('#result-team').html(data.html);
                $('.team:checked').parent().remove();

            } else {
                var messages = trans['msg_update_fail'];
                if (data.flag) {
                    messages = trans['msg_insert_fail'];
                }

                bootbox.alert(messages);
            }

            $('.err-position').html();
        },
        error: function(data){
            var errors = data.responseJSON;
            console.log(errors);
            $('.err-position').text(errors.position);
        }
    });
}

function deleteTeam(teamId) {
    var userId = $('#userId').val();

    $.ajax({
        type : 'POST',
        url : action['user_delete_team'],
        dataType : 'json',
        data: {
            teamId : teamId,
            userId : userId,
        },
        success:function(data) {
            if (data.result) {
                    $.colorbox.close();
                    bootbox.alert(trans['msg_delete_success'], function() {
                        $('#result-team').html();
                        $('#result-team').html(data.html);
                    });
                } else {
                    bootbox.alert(trans['msg_delete_fail']);
                }
            }
    });
}

/*skill*/
function  getFormSkill(skillId, flag) {
    var userId = $('#userId').val();

    $.ajax({
        type : 'POST',
        url : action['user_get_skill'],
        dataType : 'json',
        data : {
            skillId : skillId,
            userId : userId,
            flag : flag,
        },
        success:function(data) {
            $.colorbox({ html: data.html });
        }
    });
}

function exportFile(type) {
    $('#teamId-export').attr('value', $('#team').val());
    $('#position-export').attr('value', $('#position').val());
    $('#positionTeam-export').attr('value', $('#positionTeams').val());
    $('#type-export').attr('value', type);

    $('#form-export-user').submit();
    $.colorbox.close();
}
