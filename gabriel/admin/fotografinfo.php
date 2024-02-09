<?php

// PHPMaker 4 configuration
// Table level constants

define("ewTblVar", "fotograf", true);
define("ewTblRecPerPage", "RecPerPage", true);
define("ewSessionTblRecPerPage", "fotograf_RecPerPage", true);
define("ewTblStartRec", "start", true);
define("ewSessionTblStartRec", "fotograf_start", true);
define("ewTblShowMaster", "showmaster", true);
define("ewSessionTblMasterKey", "fotograf_MasterKey", true);
define("ewSessionTblMasterWhere", "fotograf_MasterWhere", true);
define("ewSessionTblDetailWhere", "fotograf_DetailWhere", true);
define("ewSessionTblAdvSrch", "fotograf_AdvSrch", true);
define("ewTblBasicSrch", "psearch", true);
define("ewSessionTblBasicSrch", "fotograf_psearch", true);
define("ewTblBasicSrchType", "psearchtype", true);
define("ewSessionTblBasicSrchType", "fotograf_psearchtype", true);
define("ewSessionTblSearchWhere", "fotograf_SearchWhere", true);
define("ewSessionTblSort", "fotograf_Sort", true);
define("ewSessionTblOrderBy", "fotograf_OrderBy", true);
define("ewSessionTblKey", "fotograf_Key", true);

// Table level SQL
define("ewSqlSelect", "SELECT * FROM `fotograf`", true);
define("ewSqlWhere", "", true);
define("ewSqlGroupBy", "", true);
define("ewSqlHaving", "", true);
define("ewSqlOrderBy", "", true);
define("ewSqlOrderBySessions", "", true);
define("ewSqlKeyWhere", "`id` = @id", true);
define("ewSqlUserIDFilter", "", true);
?>
