$(document).ready(function(){
    let page_title = $('.page_title').text();

    if(page_title == "User List"){
        $('.user-list').DataTable();

        $('.delete_user').click(function(e){
            e.preventDefault();
            let id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure you want to delete this user?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown animate__faster',
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp animate__faster',
                },
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = "delete/" + id;
                }
            });
        });

    } else if(page_title == "Add User" || page_title == "Edit User"){
        validateForm();
    }
});

function validateForm(){
    $('#submit_user').click(function(e){
        e.preventDefault();
        $('.err-fname').text('');
        $('.err-lname').text('');
        $('.err-email').text('');
        $('.err-mobile').text('');
        $('.err-password').text('');
        $('.err-confirm_password').text('');
        let firstname = $('.firstname').val();
        let lastname = $('.lastname').val();
        let email = $('.email').val();
        let mobile = $('.mobile').val();
        let password = $('.password').val();
        let confirm_password = $('.confirm_password').val();
        let k = 0;
        if(firstname == '' || firstname == null){
            $('.err-fname').text('Please enter first name.');
            k++;
        }
        if(lastname == '' || lastname == null){
            $('.err-lname').text('Please enter last name.');
            k++;
        }
        if(email == '' || email == null){
            $('.err-email').text('Please enter email ID.');
            k++;
        } else if(isEmail(email) == false){
            $('.err-email').text('Please enter valid email ID.');
            k++;
        }
        if(mobile == '' || mobile == null){
            $('.err-mobile').text('Please enter mobile no.');
            k++;
        } else if($.isNumeric(mobile) == false){
            $('.err-mobile').text('Please enter valid mobile no.');
            k++;
        }
        if(password == '' || password == null){
            $('.err-password').text('Please enter password.');
            k++;
        } 
        if(confirm_password  == '' || confirm_password == null){
            $('.err-confirm_password').text('Please enter password.');
            k++;
        } else if(confirm_password !== password){
            $('.err-confirm_password').text('Password does not match.');
            k++;
        }

        if(k == 0){
            $('#add_user').submit();
        }
    });
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}