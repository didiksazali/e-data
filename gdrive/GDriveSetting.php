<?php
namespace app\gdrive;
use Yii;

/**
 * ContactForm is the model behind the contact form.
 */
class GDriveSetting
{
    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */
    function getClient() {
        //$this->service = Google_Sevice_Drive($client)

        $client = new \Google_Client();
        $client->setApplicationName(yii::$app->params['googleDrive']['applicationName']);
        $client->setScopes(yii::$app->params['googleDrive']['scope']);
        $client->setAuthConfig(yii::$app->params['googleDrive']['clientScreetPath']);
        $client->setAccessType('offline');

        // Load previously authorized credentials from a file.
        $credentialsPath = $this->expandHomeDirectory(yii::$app->params['googleDrive']['credentialsPath']);
        if (file_exists($credentialsPath)) {
            $accessToken = json_decode(file_get_contents($credentialsPath), true);
        } else {

            if(@$_GET["code"]){
                $authCode = trim(@$_GET["code"]);
                 //Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                // Store the credentials to disk.
               if(!file_exists(dirname($credentialsPath))) {
                    mkdir(dirname($credentialsPath), 0700, true);
               }
               file_put_contents($credentialsPath, json_encode($accessToken));
            }
            else{
                $authUrl =  $client->createAuthUrl();
                header("location: ".$authUrl);
                exit();
            }
        }
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        // Refresh the token if it's expired.
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents($credentialsPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

    function expandHomeDirectory($path) {
        $homeDirectory = getenv('HOME');
        if (empty($homeDirectory)) {
            $homeDirectory = getenv('HOMEDRIVE') . getenv('HOMEPATH');
        }
        return str_replace('~', realpath($homeDirectory), $path);
    }

    /**
     * @param string $allow
     * @return \Google_Service_Drive_Permission
     */
    public function getFilePermissions($allow="private") {
        $permission = new \Google_Service_Drive_Permission();
        switch($allow):
            case "private":
                $permission->setType('user');
                $permission->setRole('owner');
                break;
            case "public":
                $permission->setAllowFileDiscovery(true);
                $permission->setType('anyone');
                $permission->setRole('reader');
                break;
            default:
                $permission->setType('anyone');
                $permission->setRole('reader');
                break;
        endswitch;
        return $permission;
    }

    public function uploadGDrive($title, $path, $mimeType, $folder, $permission='private'){
            // Get the API client and construct the service object.
            $client = $this->getClient();
            $driveService = new \Google_Service_Drive($client);

            $fileMetadata = new \Google_Service_Drive_DriveFile(array(
                'name' => $title,
                'parents' => array($folder)));
            $content = file_get_contents($path);
            $file = $driveService->files->create($fileMetadata, array(
                'data' => $content,
                'mimeType' => $mimeType,
                'uploadType' => 'multipart',
                'fields' => '*'));
            $permission = $this->getFilePermissions($permission);
            if(!empty($file->id)):
                $driveService->permissions->create($file->id, $permission);
            endif;
            return $file->id;
    }

    public function readGDriveOne($fileId){
        return yii::$app->params['googleDrive']['readUrl'].$fileId;
    }

    public function readGDriveAll($pageSize){
        // Get the API client and construct the service object.
        $client = $this->getClient();
        $service = new \Google_Service_Drive($client);

        // Print the names and IDs for up to 10 files.
        $optParams = array(
            'q'=>'parents in "'.yii::$app->params['googleDrive']['folder']['general'].'"',
            'pageSize' => $pageSize,
            'fields' => '*',
        );
        $results = $service->files->listFiles($optParams);


        if (count($results->getFiles()) == 0) {
            return "No files found.\n";
        } else {
            foreach ($results->getFiles() as $key=> $file) {
                $response[$key]['title']=$file->getName();
                $response[$key]['id']=$file->getId();
            }
            return $response= ['data'=>$response, 'nextPageToken'=>'ertyuiIUYTRRtyiUY$%^&oiuyg'];
        }
    }

}
