<html>
<header>
        <?php 
        require_once 'cachebrk.php';
        require 'globalvar.php';
        Header("Content-Security-Policy: default-src 'self' fonts.googleapis.com http://${domainname} ${domainname} www.${domainname} http://${domainname} http://www.${domainname} allowthiscsp.${domainname} 'unsafe-inline'; font-src 'self' fonts.gstatic.com data:; script-src 'self' http://${domainname} ${domainname} www.${domainname} allowthiscsp.${domainname} 'unsafe-inline'; frame-src 'none'; child-src 'self'; report-uri /fpcodes_gen/csprpt.php\n");
        http_response_code(200);
         ?>
        <title>Custom err</title>
</header>
<body>
        customized err page, with 200 code requests.
        <?php 
        require '/var/www/fpcodes_gen/prtfpcode.php';
        ?>
        
</body>
</html>


