<?php

// PHPMaker 4 configuration
// Table level constants

define("ewTblVar", "haber", true);
define("ewTblRecPerPage", "RecPerPage", true);
define("ewSessionTblRecPerPage", "haber_RecPerPage", true);
define("ewTblStartRec", "start", true);
define("ewSessionTblStartRec", "haber_start", true);
define("ewTblShowMaster", "showmaster", true);
define("ewSessionTblMasterKey", "haber_MasterKey", true);
define("ewSessionTblMasterWhere", "haber_MasterWhere", true);
define("ewSessionTblDetailWhere", "haber_DetailWhere", true);
define("ewSessionTblAdvSrch", "haber_AdvSrch", true);
define("ewTblBasicSrch", "psearch", true);
define("ewSessionTblBasicSrch", "haber_psearch", true);
define("ewTblBasicSrchType", "psearchtype", true);
define("ewSessionTblBasicSrchType", "haber_psearchtype", true);
define("ewSessionTblSearchWhere", "haber_SearchWhere", true);
define("ewSessionTblSort", "haber_Sort", true);
define("ewSessionTblOrderBy", "haber_OrderBy", true);
define("ewSessionTblKey", "haber_Key", true);

// Table level SQL
define("ewSqlSelect", "SELECT * FROM `haber`", true);
define("ewSqlWhere", "", true);
define("ewSqlGroupBy", "", true);
define("ewSqlHaving", "", true);
define("ewSqlOrderBy", "", true);
define("ewSqlOrderBySessions", "", true);
define("ewSqlKeyWhere", "`id` = @id", true);
define("ewSqlUserIDFilter", "", true);
?>
