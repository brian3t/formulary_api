###FDA NDC:
https://www.fda.gov/drugs/drug-approvals-and-databases/national-drug-code-directory


productndc='81646-113'

###RXNORM
cd rrf
Run scripts manually:  
```"C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql" -u formulary  -pfTrapok#1 -hlocalhost --local-infile=1 formulary  <Table_scripts_mysql_rxn.sql  ```
   
```"C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql" -u formulary  -pfTrapok#1 -hlocalhost --local-infile=1 formulary  <Load_scripts_mysql_rxn_win.sql ```

##CMS 


## NLM RXNorm:
RXCUI maps to RXNORM rxnconso

List of NXNorms:
https://www.nlm.nih.gov/research/umls/rxnorm/docs/appendix5.html


NDC is 11 digit, e.g. 00002143380
First 0 : discard : 002143380
Last 2 digits = labeler code : 00021433. Use this 2-digit in fda_package 
Remaining 8 digits: 0002-1433 . Use this 8 digits in FDA fda_ndc

### file `basic drugs formulary file sample 20210731.txt`
FORMULARY_ID|FORMULARY_VERSION|CONTRACT_YEAR|RXCUI|NDC|TIER_LEVEL_VALUE|QUANTITY_LIMIT_YN|QUANTITY_LIMIT_AMOUNT|QUANTITY_LIMIT_DAYS|PRIOR_AUTHORIZATION_YN|STEP_THERAPY_YN
formulary_id|formulary_version|contract_year|rxcui|ndc|tier_level_value|quantity_limit_yn|quantity_limit_amount|quantity_limit_days|prior_authorization_yn|step_therapy_yn

00021000|14|2021|1551300|00002143380|2|Y|2|28|N|N
SQL Table: cms_drug_form
