<html>
<body>
    <a id='p1'></a>
    <a></a>
    <a id='p2'></a>

    <?php
        require_once '../pages/Load_Script.php';
        if ($siteID == '-99') {
            require_once './clientList.php';
                
            $creds = new SourceCredentials($sourcename, $password, array($siteID));
            $usercreds = new UserCredentials($username, $userpass, array($userid));
            $clientService = new MBClientService();
            $clientService->SetDefaultCredentials($creds);
            $clientService->SetDefaultUserCredentials($usercreds);
            $classService = new MBClassService();
            $classService->SetDefaultCredentials($creds);
            $classService->SetDefaultUserCredentials($usercreds);
            $cdsHtml = '';
            $clientIDs = array();
            $ListSize = count($clientList);
                    $cnt = 0;

        ?><script>document.getElementById('p2').innerHTML=<?php echo $ListSize-1; ?>;</script><?
            for ($x = 0; $x < $ListSize; $x++) {//count($clientList)
                
                $clientID = $clientList[$x][0];
                $rankValue = $clientList[$x][3];
                $activeValue = $clientList[$x][4];
                $customPromoteDate = $clientList[$x][5];
                $classCount = $clientList[$x][6];
                if ($cnt >= 5){
                    $clientIDs[] = $clientID;
                    $cnt = 0;
                }
                $cnt = $cnt + 1;
                    
                $clientArray = array('Id' => $clientID, 'CustomClientFields' => array(  array( 'ID' => $customRankID,  'Value' => $rankValue), 
                                                                                        array( 'ID' => $customShowAtt, 'Value' => $activeValue),
                                                                                        array( 'ID' => $customRankDate, 'Value' => $customPromoteDate)));
    
                $result = $clientService->AddOrUpdateClients($clientArray);
                ?><script>document.getElementById('p1').innerHTML=<?php echo $x; ?>;</script><?
            };
            echo 'Complete';
        } else { ?><script>alert("Not in Test Mode!");</script><? };
    ?>
<!-- <script>window.location.replace(document.referrer);</script> -->
</body>
</html>