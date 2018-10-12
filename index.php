<html>
   <header>
     <title>Black or White</title>
   </header>
   <body>
     <h1>
       Welcome to the Microsoft TechSummit Azure Networking Lab
     </h1>
     <br>
     <?php
       $hosts = array ("bing.com", "172.0.2.4");
       $allReachable = true;
       $hostip = exec ("nslookup myip.opendns.com resolver1.opendns.com | tail -n 2 | head -n 1");
       foreach ($hosts as $host) {
         $result = exec ("ping -c 1 -W 1 " . $host . " 2>&1 | grep received");
         $pos = strpos ($result, "1 received");
         if ($pos === false) {
           $allReachable = false;
           break;
         }
       }
       if ($allReachable === false) {
         // Ping did not work
         http_response_code (299);
         print ("The target hosts do not seem to be all reachable (" . $host . ")\n");
       } else {
         // Ping did work
         http_response_code (200);
         print ("All target hosts seem to be reachable\n");
       }
      print ("     My IP $hostip .\n");
     ?>
   </body>
</html>
