function ajax(url, id)
{
  // create XMLHttpRequest object
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(id).innerHTML = this.responseText;
    }
  };

  xmlhttp.open("GET", url + id);
  xmlhttp.send();
}

function changeLikes(url, id)
{
  ajax(url, id);
  window.location.reload();
}
