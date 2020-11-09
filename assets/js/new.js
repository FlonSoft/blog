function deletePost(id, name) {
    if(confirm('Delete post "'+ name +'"?')) {
        console.log('Delete post #'+ id);
        var xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var data = JSON.parse(xhttp.responseText);
            if(data.error == 'ok') {
                location.href = rootUrl;
            }else {
                alert('Error: '+ data.error);
            }
        };
        xhttp.open('GET', rootApiUrl+'action/delete.post.php?id='+id, true);
        xhttp.send();
    }else {
        
    }
}