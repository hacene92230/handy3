<?php
namespace home;

class list_files
{

	public $files = array();

	public function SearchFiles($directory = null) {

		//  si le dossier pointé existe
		if (is_dir($directory)) {

		   // si il contient quelque chose
		   if ($dh = opendir($directory)) {

		       // boucler tant que quelque chose est trouve
		       while (($file = readdir($dh)) !== false) {

		        	// affiche le nom et le type si ce n'est pas un element du systeme
		        	if( $file != '.' && $file != '..' && !preg_match('#\.(php|css|html|js)$#i', $file)) {
		           		array_push($this->files, $file);
		        		// echo "fichier : $file | type : " . filetype($directory . $file) . "<br />\n";
		        	}
		       }
		       // on ferme la connection
		       closedir($dh);
		   }
		}

	}

}