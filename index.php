<?php
/* Copyright (C) 2001-2003	Rodolphe Quiedeville	<rodolphe@quiedeville.org>
 * Copyright (C) 2002-2003	Jean-Louis Bergamo		<jlb@j1b.org>
 * Copyright (C) 2004-2009	Laurent Destailleur		<eldy@users.sourceforge.net>
 * Copyright (C) 2012		Regis Houssin			<regis.houssin@inodbox.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *	\file       htdocs/public/members/public_list.php
 *	\ingroup    member
 *  \brief      File sample to list members
 */

if (! defined('NOLOGIN'))		define("NOLOGIN", 1);		// This means this output page does not require to be logged.
if (! defined('NOCSRFCHECK'))	define("NOCSRFCHECK", 1);	// We accept to go on this page from external web site.
if (! defined('NOIPCHECK'))		define('NOIPCHECK', '1');	// Do not check IP defined into conf $dolibarr_main_restrict_ip

// For MultiCompany module.
// Do not use GETPOST here, function is not defined and define must be done before including main.inc.php
// TODO This should be useless. Because entity must be retreive from object ref and not from url.
$entity=(! empty($_GET['entity']) ? (int) $_GET['entity'] : (! empty($_POST['entity']) ? (int) $_POST['entity'] : 1));
if (is_numeric($entity)) define("DOLENTITY", $entity);

require '../../main.inc.php';

// Security check
if (empty($conf->product->enabled)) accessforbidden('', 0, 0, 1);

require_once DOL_DOCUMENT_ROOT.'/categories/class/categorie.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/categories.lib.php';
require_once DOL_DOCUMENT_ROOT.'/core/lib/functions.lib.php';

$langs->loadLangs(array("main", "members", "companies", "other"));


/**
 * Show header for member list
 *
 * @param 	string		$title		Title
 * @param 	string		$head		More info into header
 * @return	void
 */
function llxHeaderVierge($title, $head = "")
{
	global $user, $conf, $langs;

	include_once 'header.tpl.php';
}

/**
 * Show footer for member list
 *
 * @return	void
 */
function llxFooterVierge()
{
   // printCommonFooter('public');
	include_once 'footer.tpl.php';
}


$sortfield = GETPOST("sortfield", 'alpha');
$sortorder = GETPOST("sortorder", 'alpha');
$limit = GETPOST('limit', 'int')?GETPOST('limit', 'int'):$conf->liste_limit;
$page = GETPOST("page", 'int');
if (empty($page) || $page == -1) { $page = 0; }     // If $page is not defined, or '' or -1
$offset = $limit * $page;
$pageprev = $page - 1;
$pagenext = $page + 1;

$filter=GETPOST('filter');
$statut=GETPOST('statut');

if (! $sortorder) {  $sortorder="ASC"; }
if (! $sortfield) {  $sortfield="lastname"; }


/*
 * View
 */

$form = new Form($db);

$morehead='';
if (! empty($conf->global->MEMBER_PUBLIC_CSS)) $morehead='<link rel="stylesheet" type="text/css" href="'.$conf->global->MEMBER_PUBLIC_CSS.'">';
else $morehead='<link rel="stylesheet" type="text/css" href="'.DOL_URL_ROOT.'/theme/eldy/style.css.php'.'">';
/*
 * View
 */

$categstatic = new Categorie($db);
$cat = new Categorie($db);
$form = new Form($db);
//$type;
if ($type == Categorie::TYPE_PRODUCT)       { $title=$langs->trans("ProductsCategoriesArea");  $typetext='product'; }
elseif ($type == Categorie::TYPE_SUPPLIER)  { $title=$langs->trans("SuppliersCategoriesArea"); $typetext='supplier'; }
elseif ($type == Categorie::TYPE_CUSTOMER)  { $title=$langs->trans("CustomersCategoriesArea"); $typetext='customer'; }
elseif ($type == Categorie::TYPE_MEMBER)    { $title=$langs->trans("MembersCategoriesArea");   $typetext='member'; }
elseif ($type == Categorie::TYPE_CONTACT)   { $title=$langs->trans("ContactsCategoriesArea");  $typetext='contact'; }
elseif ($type == Categorie::TYPE_ACCOUNT)   { $title=$langs->trans("AccountsCategoriesArea");  $typetext='bank_account'; }
elseif ($type == Categorie::TYPE_PROJECT)   { $title=$langs->trans("ProjectsCategoriesArea");  $typetext='project'; }
elseif ($type == Categorie::TYPE_USER)      { $title=$langs->trans("UsersCategoriesArea");     $typetext='user'; }
else 

llxHeaderVierge($title, $morehead);
if (is_numeric($type)) $type=Categorie::$MAP_ID_TO_CODE[$type];	// For backward compatibility

if($ref){
	$cat->fetch('',$ref);
}else{
	$cat->fetch('',$conf->global->DEFAULT_CAT_IN_WEBPAGE);
}

$products=$cat->getObjectsInCateg(Categorie::TYPE_PRODUCT);
?>
 <div class="row">

      <div class="col-lg-3">

        <?php include_once 'categories.tpl.php'?>
        </div>
         <!-- /.col-lg-3 -->

		<div class="col-lg-9">
			<?php include_once 'carousel.tpl.php'?>
			<?php include_once 'products.tpl.php'?>
		</div>	

 </div>
      
<?php

 

//$sql = "SELECT rowid, firstname, lastname, societe, zip, town, email, birth, photo";
//$sql.= " FROM ".MAIN_DB_PREFIX."adherent";
//$sql.= " WHERE entity = ".$entity;
//$sql.= " AND statut = 1";
//$sql.= " AND public = 1";
//$sql.= $db->order($sortfield, $sortorder);
//$sql.= $db->plimit($conf->liste_limit+1, $offset);
//$sql = "SELECT d.rowid, d.firstname, d.lastname, d.societe, zip, town, d.email, t.libelle as type, d.morphy, d.statut, t.subscription";
//$sql .= " FROM ".MAIN_DB_PREFIX."adherent as d, ".MAIN_DB_PREFIX."adherent_type as t";
//$sql .= " WHERE d.fk_adherent_type = t.rowid AND d.statut = $statut";
//$sql .= " ORDER BY $sortfield $sortorder " . $db->plimit($conf->liste_limit, $offset);
/*
$result = $db->query($sql);
if ($result)
{
	$num = $db->num_rows($result);
	$i = 0;

	$param="&statut=$statut&sortorder=$sortorder&sortfield=$sortfield";
	

	while ($i < $num && $i < $conf->liste_limit)
	{
		$objp = $db->fetch_object($result);

		if (isset($objp->photo) && $objp->photo != '')
		{
			
			//print $form->showphoto('memberphoto', $objp, 64);
			
		}
		else
		{
			//print "<td>&nbsp;</td>\n";
		}
		
		$i++;
	}
	
}
else
{
	dol_print_error($db);
}

*/
llxFooterVierge();

$db->close();
