<?php
namespace app\controllers;
use yii;
use app\gdrive\GDriveSetting;

class QuickstartController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Get the API client and construct the service object.
        $GDSetting = new GDriveSetting();
        $client = $GDSetting->getClient();
        $service = new \Google_Service_Drive($client);

        // Print the names and IDs for up to 10 files.
                $optParams = array(
                    'q'=>'parents in "'.yii::$app->params['googleDrive']['folder']['general'].'"',
                    'pageSize' => 10,
                    'fields' => '*',
        );
        $results = $service->files->listFiles($optParams);


        if (count($results->getFiles()) == 0) {
            print "No files found.\n";
        } else {
            print "Files:\n";
            //print_r($results);
            foreach ($results->getFiles() as $file) {
                printf("%s (%s)\n", $file->getName(), $file->getId());
                ///echo "<img src='https://docs.google.com/uc?id=".$file->getId()."' style='hight:100px; width: 200px' />";
            }
        }
    }

    public function actionUpload(){
        // Get the API client and construct the service object.
        $GDSetting = new GDriveSetting();
        $client = $GDSetting->getClient();
        $driveService = new \Google_Service_Drive($client);

        $fileMetadata = new \Google_Service_Drive_DriveFile(array(
            'name' => 'photo.jpg',
            'parents' => array(yii::$app->params['googleDrive']['folder']['general'])));
        $content = file_get_contents('gdrive/temp/tes.jpg');
        $file = $driveService->files->create($fileMetadata, array(
            'data' => $content,
            'mimeType' => 'image/jpeg',
            'uploadType' => 'multipart',
            'fields' => '*'));
        $permission = $GDSetting->getFilePermissions('public');
        if(!empty($file->id)):
            $driveService->permissions->create($file->id, $permission);
        endif;

        printf("File ID: %s\n", $file->id);
    }

    public function actionTest_upload(){
        $upload= new GDriveSetting();
        echo $upload->uploadGDrive('imron', 'gdrive/temp/tes.jpg', 'image/jpeg' );
    }

    public function actionTest_read_one(){
        $upload= new GDriveSetting();
        echo '<img src='.$upload->readGDriveOne('0B-VYjhIS76rYVHNtWmFmLXN5VWc').'>';
    }

    public function actionTest_read_all(){
        $upload= new GDriveSetting();
        print_r($upload->readGDriveAll(10));
    }
}
