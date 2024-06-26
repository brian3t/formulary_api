#### REST API for Formulary app

Built on Yii 1.1 MVC Framework, YiiBooster and YiiBoilerPlate https://github.com/clevertech/YiiBoilerplate

Web Admin: https://formapi.socalappsolutions.com/f/

App published on iTunes: https://itunes.apple.com/us/app/formulary-medical/id949735021?mt=8

Sample API requests:
https://formapi.socalappsolutions.com/f/cmsplan/get/rxcui/formularyid/

Note: in ./assets folder, need static copy of bootstrap and font-awesome...

    RewriteCond %{DOCUMENT_ROOT}%{REQUEST_FILENAME} !-f
    RewriteCond %{DOCUMENT_ROOT}%{REQUEST_FILENAME} !-d
    # Otherwise forward the request to index.php
    RewriteRule f/.* /f/index.php

#### Installation:
- create f/protected/assets, make writable
- create f/assets, make writable
- cp -a ./assets/* ./f/assets/
- cd f/protected, run `composer install`
- web root is /f/
- db setting is at f/protected/config/main.php. If want to override, create override.php (refer to override_sample.php). Also need to create f/protected/config/override.json

### Source
DrugPlanStateController.php:129
$url = "http://lookup.decisionresourcesgroup.com/lookup/results.json" . $drug_name_param . "/" . $state . "/plans?" . http_build_query($queries); //http://www.fingertipformulary.com/drugs/Flomax/CA/plans?planName=Express+Scripts+High+Performance&planID=356

https://lookup.decisionresourcesgroup.com/lookup/results.json?drug_ids%5B%5D=1050&health_plan_ids%5B%5D=553&_=1610600343137

### RXCUI RXNORM database

MySQL setting:
MYSQL_HOME = /usr

### CMS Formulary
Drugs: fda_ndc
Plans: cplan
Formulary: cms_drug_form
