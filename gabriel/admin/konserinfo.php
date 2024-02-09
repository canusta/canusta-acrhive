<?php

// PHPMaker 4 configuration
// Table level constants

define("ewTblVar", "konser", true);
define("ewTblRecPerPage", "RecPerPage", true);
define("ewSessionTblRecPerPage", "konser_RecPerPage", true);
define("ewTblStartRec", "start", true);
define("ewSessionTblStartRec", "konser_start", true);
define("ewTblShowMaster", "showmaster", true);
define("ewSessionTblMasterKey", "konser_MasterKey", true);
define("ewSessionTblMasterWhere", "konser_MasterWhere", true);
define("ewSessionTblDetailWhere", "konser_DetailWhere", true);
define("ewSessionTblAdvSrch", "konser_AdvSrch", true);
define("ewTblBasicSrch", "psearch", true);
define("ewSessionTblBasicSrch", "konser_psearch", true);
define("ewTblBasicSrchType", "psearchtype", true);
define("ewSessionTblBasicSrchType", "konser_psearchtype", true);
define("ewSessionTblSearchWhere", "konser_SearchWhere", true);
define("ewSessionTblSort", "konser_Sort", true);
define("ewSessionTblOrderBy", "konser_OrderBy", true);
define("ewSessionTblKey", "konser_Key", true);

// Table level SQL
define("ewSqlSelect", "SELECT * FROM `konser`", true);
define("ewSqlWhere", "", true);
define("ewSqlGroupBy", "", true);
define("ewSqlHaving", "", true);
define("ewSqlOrderBy", "", true);
define("ewSqlOrderBySessions", "", true);
define("ewSqlKeyWhere", "`id` = @id", true);
define("ewSqlUserIDFilter", "", true);
?>
