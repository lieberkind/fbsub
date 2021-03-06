<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>FB Subscription Test</title>
</head>
<body>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '1459015154407859',
          xfbml      : true,
          version    : 'v2.4'
        });

        FB.login(function(response) {
           if (response.authResponse) {
            console.log(response);
             console.log('Welcome!  Fetching your information.... ');
             FB.api('/me', function(response) {
               console.log('Good to see you, ' + response.name + '.');
             });
           } else {
             console.log('User cancelled login or did not fully authorize.');
           }
         });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
</body>
</html>
