<?php include 'session.php'; ?>
<?php include 'function.php'; ?>
<?php include 'ffam-function.php'; ?>
<?php include 'decide_lang.php'; ?>

<?php
// Ajout v2.1
if ($_SESSION['username'] == "ANONYMOUS") {
  echo TXT_LOGGEDOUT;
  exit();
}
// Fin ajout v2.1
?>

<?php
	$rep = "";

  echo "toto";

	$sqladmin = "
	  SELECT
		paramvalue
	  FROM
		core_settings
	  WHERE
		paramname = 'INSTALLATION'";
	$rowisntall = $PROD->GetRow($sqladmin);

	if ($rowisntall['paramvalue'] == 'WINDOWS') {
		$rep = $rep."\\";
		$rmcmd = "del";

		$sqlinstmysql = "
		  SELECT
			paramvalue
		  FROM
			core_settings
		  WHERE
			paramname = 'INSTREPMYSQL'
			AND paramactive = 1";
		$rowinstmysql = $PROD->GetRow($sqlinstmysql);
		$repmysql = str_replace("\\", "\\\\", $rowinstmysql['paramvalue']);
	} else {
		$rep = $rep."/";
		$rmcmd = "rm";
		$repmysql = "/usr/sbin/";
	}

  system($rmcmd." ".$rep.PROD_DBNAME."*.sql");



?>
