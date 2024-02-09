<?php

// PHPMaker 4 configuration
// Table level constants

define("ewTblVar", "program", true);
define("ewTblRecPerPage", "RecPerPage", true);
define("ewSessionTblRecPerPage", "program_RecPerPage", true);
define("ewTblStartRec", "start", true);
define("ewSessionTblStartRec", "program_start", true);
define("ewTblShowMaster", "showmaster", true);
define("ewSessionTblMasterKey", "program_MasterKey", true);
define("ewSessionTblMasterWhere", "program_MasterWhere", true);
define("ewSessionTblDetailWhere", "program_DetailWhere", true);
define("ewSessionTblAdvSrch", "program_AdvSrch", true);
define("ewTblBasicSrch", "psearch", true);
define("ewSessionTblBasicSrch", "program_psearch", true);
define("ewTblBasicSrchType", "psearchtype", true);
define("ewSessionTblBasicSrchType", "program_psearchtype", true);
define("ewSessionTblSearchWhere", "program_SearchWhere", true);
define("ewSessionTblSort", "program_Sort", true);
define("ewSessionTblOrderBy", "program_OrderBy", true);
define("ewSessionTblKey", "program_Key", true);

// Table level SQL
define("ewSqlSelect", "SELECT * FROM `program`", true);
define("ewSqlWhere", "", true);
define("ewSqlGroupBy", "", true);
define("ewSqlHaving", "", true);
define("ewSqlOrderBy", "", true);
define("ewSqlOrderBySessions", "", true);
define("ewSqlKeyWhere", "`id` = @id", true);
define("ewSqlUserIDFilter", "", true);
?>
