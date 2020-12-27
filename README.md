#### REST API for Formulary app

Built on Yii 1.1 MVC Framework, YiiBooster.

Web Admin: https://usvsolutions.com/formulary_api/f/

App published on iTunes: https://itunes.apple.com/us/app/formulary-medical/id949735021?mt=8

Sample API requests:
https://usvsolutions.com/formulary_api/f/plan/get/name/a/state/CA/

Note: in ./assets folder, need static copy of bootstrap and font-awesome...

    RewriteCond %{DOCUMENT_ROOT}%{REQUEST_FILENAME} !-f
    RewriteCond %{DOCUMENT_ROOT}%{REQUEST_FILENAME} !-d
    # Otherwise forward the request to index.php
    RewriteRule formulary_api/f/.* /formulary_api/f/index.php
