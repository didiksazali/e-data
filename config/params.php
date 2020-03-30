<?php

return [
    'adminEmail' => 'admin@example.com',
    'googleDrive'=>[
                'applicationName'=> 'API GOOGLE DRIVE',
                'clientScreetPath'=> 'gdrive/setting.json',
                'credentialsPath'=> 'gdrive/drive-php-quickstart.json',
                'scope' =>implode(' ', array(
                        \Google_Service_Drive::DRIVE_METADATA_READONLY,
                        \Google_Service_Drive::DRIVE,
                        \Google_Service_Oauth2::USERINFO_EMAIL,
                        \Google_Service_Oauth2::USERINFO_PROFILE,
                        \Google_Service_Drive::DRIVE_READONLY,
                        \Google_Service_Drive::DRIVE_METADATA,
                        \Google_Service_Drive::DRIVE_FILE,
                        \Google_Service_Drive::DRIVE_SCRIPTS
                    )
                ),
                'folder'=>[
                        'general'=>'0B-VYjhIS76rYTzhtbmhQQnFOOEk',
                        ''=>'',
                ],
                'readUrl'=>'https://docs.google.com/uc?id=',
        ],
];
