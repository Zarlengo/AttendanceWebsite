
	<!--//<script>waitingDialog.show();</script>--><?php
	$initialize = true;
	define('__ROOT__', dirname(dirname(__FILE__)));
	// Load specific data into HTML
	require_once(__ROOT__ . '/pages/header.php');
	require_once(__ROOT__ . '/pages/footer.php');
	echo '<div id="extraStuff">';
	require_once(__ROOT__ . '/pages/modals.php');
	require_once(__ROOT__ . '/includes/Classes_Variable.php');
	require_once(__ROOT__ . '/includes/BeltRanks.php');
	require_once(__ROOT__ . '/includes/Belt_List.php');
	require_once(__ROOT__ . '/AddRanks/clientList.php');
	require_once(__ROOT__ . '/pages/Load_Script.php');
	echo '</div>';
