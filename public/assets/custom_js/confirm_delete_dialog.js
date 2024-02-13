

function delete_item(url)
{
    Swal.fire({
        title: 'Are you sure ?',
        html: "<div style='margin: 10px 0'><b>You will delete this record permanently !</b></div>",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        width:400,
    }).then((result) =>{
        if(result.value){
            // $('deleteItemForm').attr({'action': url});
            $('#deleteItemForm').attr('action', url).submit();
        }
    })

}


function approved_item(url)
{
    Swal.fire({
        title: 'Are you sure ?',
        html: "<div style='margin: 10px 0'><b>You will approved this record !</b></div>",
        type: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approved it!',
        width:400,
    }).then((result) =>{
        if(result.value){
            window.location = url;
        }
    })

}





function unapproved_item(url)
{
    Swal.fire({
        title: 'Are you sure ?',
        html: "<div style='margin: 10px 0'><b>You will unapproved this record !</b></div>",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, unapproved it!',
        width:400,
    }).then((result) =>{
        if(result.value){
            window.location = url;
        }
    })

}
