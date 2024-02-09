<?php

// PHPMaker 4 configuration
// Table level constants

define("ewTblVar", "seri", true);
define("ewTblRecPerPage", "RecPerPage", true);
define("ewSessionTblRecPerPage", "seri_RecPerPage", true);
define("ewTblStartRec", "start", true);
define("ewSessionTblStartRec", "seri_start", true);
define("ewTblShowMaster", "showmaster", true);
define("ewSessionTblMasterKey", "seri_MasterKey", true);
define("ewSessionTblMasterWhere", "seri_MasterWhere", true);
define("ewSessionTblDetailWhere", "seri_DetailWhere", true);
define("ewSessionTblAdvSrch", "seri_AdvSrch", true);
define("ewTblBasicSrch", "psearch", true);
define("ewSessionTblBasicSrch", "seri_psearch", true);
define("ewTblBasicSrchType", "psearchtype", true);
define("ewSessionTblBasicSrchType", "seri_psearchtype", true);
define("ewSessionTblSearchWhere", "seri_SearchWhere", true);
define("ewSessionTblSort", "seri_Sort", true);
define("ewSessionTblOrderBy", "seri_OrderBy", true);
define("ewSessionTblKey", "seri_Key", true);

// Table level SQL
define("ewSqlSelect", "SELECT * FROM `seri`", true);
define("ewSqlWhere", "", true);
define("ewSqlGroupBy", "", true);
define("ewSqlHaving", "", true);
define("ewSqlOrderBy", "", true);
define("ewSqlOrderBySessions", "", true);
define("ewSqlKeyWhere", "`id` = @id", true);
define("ewSqlUserIDFilter", "", true);
?>
