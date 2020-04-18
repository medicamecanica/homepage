<h1 class="my-4">Categorias</h1>
        <div class="list-group">
			<?php
			// Charge tableau des categories
			$cate_arbo = $categstatic->get_full_arbo($typetext);

			// Define fulltree array
			$fulltree=$cate_arbo;

			$upload_dir = $conf->categorie->multidir_output[$conf->entity];
			$photos=array();
			foreach($fulltree as $key => $val)
			{
				$categstatic->id=$val['id'];
				$categstatic->ref=$val['label'];
				$categstatic->color=$val['color'];
				$categstatic->type=$type;
				$li=$categstatic->getNomUrl(1, '', 60);
				$desc=dol_htmlcleanlastbr($val['description']);
				
				$pdir = get_exdir($categstatic->id, 2, 0, 0, $categstatic, 'category') . $categstatic->id ."/photos/";
		$dir = $upload_dir.'/'.$pdir;

		$listofphoto = $categstatic->liste_photos($dir);
//var_dump($dir,$listofphoto);
		if (is_array($listofphoto) && count($listofphoto))
		{
			$obj=$listofphoto[0];
			// Si fichier vignette disponible, on l'utilise, sinon on utilise photo origine
    			if ($obj['photo_vignette'])
    			{
    				$filename=$obj['photo_vignette'];
    			}
    			else
    			{
    				$filename=$obj['photo'];
    			}
				$filename=$obj['photo'];
    			// Nom affiche
    			$viewfilename=$obj['photo'];

    			// Taille de l'image
    			$categstatic->get_image_size($dir.$filename);
    			$imgWidth = ($categstatic->imgWidth < $maxWidth) ? $categstatic->imgWidth : $maxWidth;
    			$imgHeight = ($categstatic->imgHeight < $maxHeight) ? $categstatic->imgHeight : $maxHeight;
    			$src=DOL_URL_ROOT.'/viewimage.php?modulepart=category&entity='.$categstatic->entity.'&file='.urlencode($pdir.$filename);
				$photos[]=array('imgWidth'=>$imgWidth,'imgHeight'=>$imgHeight,'src'=>$src);
    			//print '<img border="0" width="'.$imgWidth.'" height="'.$imgHeight.'" src="'.DOL_URL_ROOT.'/viewimage.php?modulepart=category&entity='.$categstatic->entity.'&file='.urlencode($pdir.$filename).'">';

			
		}
				?>
				 <a href="#" class="list-group-item"><?php print $val['label']?></a>
				<?php
				
			}
			?>
        </div>
