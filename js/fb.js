function entrada(){
    var fb = document.getElementById('fb-root');
    if(fb)
        ;
    else{
        var divFbRoot = document.createElement('div');
        divFbRoot.id = 'fb-root';
        document.body.insertBefore(divFbRoot, document.body.firstChild);
    }
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
};
window.onload=entrada();
