###FDA NDC:
https://www.fda.gov/drugs/drug-approvals-and-databases/national-drug-code-directory


productndc='81646-113'

###RXNORM
cd rrf
Run scripts manually:  
```"C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql" -u formulary  -pfTrapok#1 -hlocalhost --local-infile=1 formulary  <Table_scripts_mysql_rxn.sql  ```
   
```"C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql" -u formulary  -pfTrapok#1 -hlocalhost --local-infile=1 formulary  <Load_scripts_mysql_rxn_win.sql ```

##CMS 

RXCUI maps to RXNORM rxnconso

NDC is 11 digit, e.g. 00002143380
First 0 : discard : 002143380
Last 2 digits = labeler code : 00021433. Use this 2-digit in fda_package 
Remaining 8 digits: 0002-1433 . Use this 8 digits in FDA fda_ndc
