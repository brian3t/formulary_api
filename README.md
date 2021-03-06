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

#### Installation:
- create f/protected/assets, make writable
- create f/assets, make writable
- cd f/protected, run `composer install`

### Source
DrugPlanStateController.php:129
$url = "http://lookup.decisionresourcesgroup.com/lookup/results.json" . $drug_name_param . "/" . $state . "/plans?" . http_build_query($queries); //http://www.fingertipformulary.com/drugs/Flomax/CA/plans?planName=Express+Scripts+High+Performance&planID=356

https://lookup.decisionresourcesgroup.com/lookup/results.json?drug_ids%5B%5D=1050&health_plan_ids%5B%5D=553&_=1610600343137

