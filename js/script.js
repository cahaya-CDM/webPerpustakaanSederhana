let keyword = document.getElementById('keyword');
let cari = document.getElementById('cari');
let container = document.getElementById('container');

// event ajax
keyword.addEventListener('keyup', function(){

    let ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function(){
        if( ajax.readyState == 4 && ajax.status == 200 ){
            container.innerHTML = ajax.responseText;
        }
    }

    // eksekusi ajax 
    ajax.open('GET', 'ajax/buku.php?keyword=' + keyword.value, true);
    ajax.send();
});