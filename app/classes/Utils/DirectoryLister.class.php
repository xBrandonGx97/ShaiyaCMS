<?php
	namespace Classes\Utils;
	if(!defined('IN_CMS')){die('<b>'.__NAMESPACE__.'\DiectoryLister</b>: unauthorized access detected, exiting...');}

	class DirectoryLister {
		const VERSION = '2.7.0';

		// Reserve some variables
		protected $_themeName		=	null;
		protected $_directory		=	null;
		protected $_appDir			=	null;
		protected $_appURL			=	null;
		protected $_config			=	null;
		protected $_fileTypes		=	null;
		protected $_systemMessage	=	null;

		public $_open_new_tab = null;

		public function __construct($Arrays){
			$this->Arrays	=	$Arrays;

			# Config array
			$this->_config = $this->Arrays->_get_Array('dir_lister_cfg');
			// Set the file types array to a global variable
			$this->_fileTypes = $this->Arrays->_get_Array('filetypes');

			$this->_icon_arr();
		}
		public function _icon_arr(){
			$this->_open_new_tab	=	array(
												"fa-level-up",
												"fa-folder",
												"fa-youtube-play"
			);
		}
		public function isZipEnabled(){
			foreach($this->_config['zip_disable'] as $disabledPath){
				if(fnmatch($disabledPath,$this->_directory)){
					return false;
				}
			}

			return $this->_config['zip_dirs'];
		}
		public function zipDirectory($directory){
			if($this->_config['zip_dirs']){
				// Cleanup directory path
				$directory = $this->setDirectoryPath($directory);
				if($directory != '.' && $this->_isHidden($directory)){
					echo "Access denied.";
				}

				$filename_no_ext = basename($directory);

				if($directory == '.'){
					$filename_no_ext = $this->_config['home_label'];
				}

				// We deliver a zip file
				header('Content-Type: archive/zip');
				// Filename for the browser to save the zip file
				header("Content-Disposition: attachment; filename=\"$filename_no_ext.zip\"");
				//change directory so the zip file doesnt have a tree structure in it.
				chdir($directory);
				// TODO: Probably we have to parse exclude list more carefully
				$exclude_list = implode(' ', array_merge($this->_config['hidden_files'], array('index.php')));
				$exclude_list = str_replace("*", "\*", $exclude_list);

				if($this->_config['zip_stream']){
					// zip the stuff (dir and all in there) into the streamed zip file
					$stream = popen('/usr/bin/zip -' . $this->_config['zip_compression_level'] . ' -r -q - * -x ' . $exclude_list, 'r');
					if($stream){
						fpassthru($stream);
						fclose($stream);
					}
				}
				else{
					// get a tmp name for the .zip
					$tmp_zip = tempnam('tmp', 'tempzip') . '.zip';
					// zip the stuff (dir and all in there) into the tmp_zip file
					exec('zip -' . $this->_config['zip_compression_level'] . ' -r ' . $tmp_zip . ' * -x ' . $exclude_list);
					// calc the length of the zip. it is needed for the progress bar of the browser
					$filesize = filesize($tmp_zip);
					header("Content-Length: $filesize");
					// deliver the zip file
					$fp = fopen($tmp_zip, 'r');
					echo fpassthru($fp);
					// clean up the tmp zip file
					unlink($tmp_zip);
				}
			}
		}
		public function listDirectory($directory){
			// Set directory
			$directory = $this->setDirectoryPath($directory);
			// Set directory variable if left blank
			if($directory === null){
				$directory = $this->_directory;
			}

			// Get the directory array
			$directoryArray = $this->_readDirectory($directory);

			// Return the array
			return $directoryArray;
		}
		public function listBreadcrumbs($directory = null){
			// Set directory variable if left blank
			if($directory === null){
				$directory = $this->_directory;
			}

			// Explode the path into an array
			$dirArray = explode('/', $directory);
			// Statically set the Home breadcrumb
			$breadcrumbsArray[] = array(
				'link' => $this->_appURL,
				'text' => $this->_config['home_label']
			);
			// Generate breadcrumbs
			$dirPath  = null;

			foreach($dirArray as $key=>$dir){
				if($dir != '.'){
					// Build the directory path
					$dirPath = is_null($dirPath) ? $dir : $dirPath . '/' .  $dir;
					// Combine the base path and dir path
					$link = $this->_appURL . '?dir=' . rawurlencode($dirPath);
					$breadcrumbsArray[] = array(
						'link' => $link,
						'text' => $dir
					);
				}
			}
			// Return the breadcrumb array
			return $breadcrumbsArray;
		}
		public function containsIndex($dirPath){
			// Check if links_dirs_with_index is enabled
			if($this->linksDirsWithIndex()){
				// Check if directory contains an index file
				foreach($this->_config['index_files'] as $indexFile){
					if(file_exists($dirPath.'/'.$indexFile)){
						return true;
					}
				}
			}

			return false;
		}
		public function getListedPath(){
			// Build the path
			if($this->_directory == '.'){
				$path = $this->_appURL;
			}
			else{
				$path = $this->_appURL.$this->_directory;
			}

			// Return the path
			return $path;
		}
		public function getThemeName(){
			// Return the theme name
			return $this->_config['theme_name'];
		}
		public function externalLinksNewWindow(){
			return $this->_config['external_links_new_window'];
		}
		public function linksDirsWithIndex(){
			return $this->_config['links_dirs_with_index'];
		}
		public function getThemePath($absolute = false){
			if($absolute){
				// Set the theme path
				$themePath = $this->_appDir . '/themes/' . $this->_themeName;
			}
			else{
				// Get relative path to application dir
				$realtivePath = $this->_getRelativePath(getcwd(), $this->_appDir);
				// Set the theme path
				$themePath = $realtivePath . '/themes/' . $this->_themeName;
			}

			return $themePath;
		}
		public function getSystemMessages(){
			if(isset($this->_systemMessage) && is_array($this->_systemMessage)){
				return $this->_systemMessage;
			}
			else{
				return false;
			}
		}
		function getFileSize($filePath){
			// Get file size
			$bytes = filesize($filePath);
			// Array of file size suffixes
			$sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
			// Calculate file size suffix factor
			$factor = floor((strlen($bytes) - 1) / 3);
			// Calculate the file size
			$fileSize = sprintf('%.2f', $bytes / pow(1024, $factor)) . $sizes[$factor];

			return $fileSize;
		}
		public function getFileHash($filePath){
			// Placeholder array
			$hashArray = array();
			// Verify file path exists and is a directory
			if(!file_exists($filePath)){
				return json_encode($hashArray);
			}
			// Prevent access to hidden files
			if($this->_isHidden($filePath)){
				return json_encode($hashArray);
			}
			// Prevent access to parent folders
			if(
				strpos($filePath,'<') !== false ||
				strpos($filePath,'>') !== false ||
				strpos($filePath, '..') !== false ||
				strpos($filePath, '/') === 0
			){
				return json_encode($hashArray);
			}
			// Prevent hashing if file is too big
			if(filesize($filePath) > $this->_config['hash_size_limit']){
				// Notify user that file is too large
				$hashArray['md5']  = '[ File size exceeds threshold ]';
				$hashArray['sha1'] = '[ File size exceeds threshold ]';
			}
			else{
				// Generate file hashes
				$hashArray['md5']  = hash_file('md5', $filePath);
				$hashArray['sha1'] = hash_file('sha1', $filePath);
			}

			// Return the data
			return $hashArray;
		}
		public function setDirectoryPath($path = null){
			// Set the directory global variable
			$this->_directory = $this->_setDirectoryPath($path);

			return $this->_directory;
		}
		public function getDirectoryPath(){
			return $this->_directory;
		}
		public function setSystemMessage($type, $text){
			// Create empty message array if it doesn't already exist
			if(isset($this->_systemMessage) && !is_array($this->_systemMessage)){
				$this->_systemMessage = array();
			}
			// Set the error message
			$this->_systemMessage[] = array(
				'type'  => $type,
				'text'  => $text
			);

			return true;
		}
		protected function _setDirectoryPath($dir){
			// Check for an empty variable
			if(empty($dir) || $dir == '.'){
				return '.';
			}
			// Eliminate double slashes
			while(strpos($dir,'//')){
				$dir = str_replace('//', '/', $dir);
			}
			// Remove trailing slash if present
			if(substr($dir,-1,1) == '/'){
				$dir = substr($dir, 0, -1);
			}
			// Verify file path exists and is a directory
			if(!file_exists($dir) || !is_dir($dir)){
				// Set the error message
				$this->setSystemMessage('danger', '<b>ERROR:</b> File path does not exist');

				// Return the web root
				return '.';
			}
			// Prevent access to hidden files
			if($this->_isHidden($dir)){
				// Set the error message
				$this->setSystemMessage('danger', '<b>ERROR:</b> Access denied');
				// Set the directory to web root
				return '.';
			}
			// Prevent access to parent folders
			if(
				strpos($dir, '<') !== false ||
				strpos($dir, '>') !== false ||
				strpos($dir, '..') !== false ||
				strpos($dir, '/') === 0
			){
				// Set the error message
				$this->setSystemMessage('danger', '<b>ERROR:</b> An invalid path string was detected');

				// Set the directory to web root
				return '.';
			}
			else{
				// Should stop all URL wrappers (Thanks to Hexatex)
				$directoryPath = $dir;
			}

			// Return
			return $directoryPath;
		}
		protected function _readDirectory($directory,$sort='natcase'){
			// Initialize array
			$directoryArray = array();
			// Get directory contents
			$files = scandir($directory);
			// Read files/folders from the directory
			foreach($files as $file){
				if($file != '.'){
					// Get files relative path
					$relativePath = $directory . '/' . $file;
					if(substr($relativePath,0,2) == './'){
						$relativePath = substr($relativePath,2);
					}
					// Don't check parent dir if we're in the root dir
					if($this->_directory == '.' && $file == '..'){
						continue;
					}
					else{
						// Get files absolute path
						$realPath = realpath($relativePath);
						// Determine file type by extension
						if(is_dir($realPath)){
							$iconClass = 'fa-folder';
							$sort = 1;
						}
						else{
							// Get file extension
							$fileExt = strtolower(pathinfo($realPath, PATHINFO_EXTENSION));

							if(isset($this->_fileTypes[$fileExt])){
								$iconClass = $this->_fileTypes[$fileExt];
							}
							else{
								$iconClass = $this->_fileTypes['blank'];
							}
							$sort = 2;
						}
					}

					if($file == '..'){
						if($this->_directory != '.'){
							// Get parent directory path
							$pathArray = explode('/', $relativePath);
							unset($pathArray[count($pathArray)-1]);
							unset($pathArray[count($pathArray)-1]);
							$directoryPath = implode('/', $pathArray);

							if(!empty($directoryPath)){
								$directoryPath = '?dir='.rawurlencode($directoryPath);
							}
							// Add file info to the array
							$directoryArray['..'] = array(
								'file_path'		=>	$this->_appURL.$directoryPath,
								'url_path'		=>	$this->_appURL.$directoryPath,
								'file_size'		=>	'-',
								'mod_time'		=>	date($this->_config['date_format'],filemtime($realPath)),
								'icon_class'	=>	'fa-level-up',
								'sort'			=>	0
							);
						}
					}
					elseif (!$this->_isHidden($relativePath)){
						// Add all non-hidden files to the array
						if($this->_directory != '.' || $file != 'index.php'){
							// Build the file path
							$urlPath = implode('/',array_map('rawurlencode',explode('/',$relativePath)));
							if(is_dir($relativePath)){
								$urlPath = $this->containsIndex($relativePath) ? $relativePath : '?dir='.$urlPath;
							}
							// Add the info to the main array
							$directoryArray[pathinfo($relativePath, PATHINFO_BASENAME)] = array(
								'file_path'		=>	$relativePath,
								'url_path'		=>	$urlPath,
								'file_size'		=>	is_dir($realPath) ? '-' : $this->getFileSize($realPath),
								'mod_time'		=>	date($this->_config['date_format'], filemtime($realPath)),
								'icon_class'	=>	$iconClass,
								'sort'			=>	$sort
							);
						}
					}
				}
			}
			// Sort the array
			$reverseSort = in_array($this->_directory, $this->_config['reverse_sort']);
			$sortedArray = $this->_arraySort($directoryArray, $this->_config['list_sort_order'], $reverseSort);

			// Return the array
			return $sortedArray;
		}
		protected function _arraySort($array,$sortMethod,$reverse=false){
			// Create empty arrays
			$sortedArray = array();
			$finalArray  = array();

			// Create new array of just the keys and sort it
			$keys = array_keys($array);

			switch($sortMethod){
				case 'asort'		:	asort($keys);		break;
				case 'arsort'		:	arsort($keys);		break;
				case 'ksort'		:	ksort($keys);		break;
				case 'krsort'		:	krsort($keys);		break;
				case 'natcasesort'	:	natcasesort($keys);	break;
				case 'natsort'		:	natsort($keys);		break;
				case 'shuffle'		:	shuffle($keys);		break;
			}
			// Loop through the sorted values and move over the data
			if($this->_config['list_folders_first']){
				foreach($keys as $key){
					if($array[$key]['sort'] == 0){
						$sortedArray['0'][$key] = $array[$key];
					}
				}
				foreach($keys as $key){
					if($array[$key]['sort'] == 1){
						$sortedArray[1][$key] = $array[$key];
					}
				}
				foreach($keys as $key){
					if($array[$key]['sort'] == 2){
						$sortedArray[2][$key] = $array[$key];
					}
				}
				if($reverse){
					$sortedArray[1] = array_reverse($sortedArray[1]);
					$sortedArray[2] = array_reverse($sortedArray[2]);
				}
			}
			else{
				foreach($keys as $key){
					if($array[$key]['sort'] == 0){
						$sortedArray[0][$key] = $array[$key];
					}
				}
				foreach ($keys as $key) {
					if ($array[$key]['sort'] > 0) {
						$sortedArray[1][$key] = $array[$key];
					}
				}
				if($reverse){
					$sortedArray[1] = array_reverse($sortedArray[1]);
				}
			}
			// Merge the arrays
			foreach($sortedArray as $array){
				if(empty($array)) continue;
				foreach ($array as $key => $value){
					$finalArray[$key] = $value;
				}
			}

			// Return sorted array
			return $finalArray;
		}
		protected function _isHidden($filePath){
			// Add dot files to hidden files array
			if($this->_config['hide_dot_files']){
				$this->_config['hidden_files'] = array_merge(
					$this->_config['hidden_files'],
					array('.*', '*/.*')
				);
			}
			// Compare path array to all hidden file paths
			foreach($this->_config['hidden_files'] as $hiddenPath){
				if(fnmatch($hiddenPath,$filePath)){
					return true;
				}
			}

			return false;
		}
		protected function _getAppUrl(){
			// Get the server protocol
			if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'){
				$protocol = 'https://';
			}
			else{
				$protocol = 'http://';
			}
			// Get the server hostname
			if(isset($_SERVER['HTTP_X_FORWARDED_HOST'])){
				$host = $_SERVER['HTTP_X_FORWARDED_HOST'];
			}
			else{
				$host = $_SERVER['HTTP_HOST'];
			}
			// Get the URL path
			$pathParts = pathinfo($_SERVER['PHP_SELF']);
			$path      = $pathParts['dirname'];
			// Remove backslash from path (Windows fix)
			if(substr($path,-1) == '\\'){
				$path = substr($path,0,-1);
			}
			// Ensure the path ends with a forward slash
			if(substr($path,-1) != '/'){
				$path = $path.'/';
			}
			// Build the application URL
			$appUrl = $protocol.$host.$path;

			// Return the URL
			return $appUrl;
		}
		protected function _getRelativePath($fromPath,$toPath){
			// Define the OS specific directory separator
			if(!defined('DS')){
				define('DS', DIRECTORY_SEPARATOR);
			}
			// Remove double slashes from path strings
			$fromPath	=	str_replace(DS.DS,DS,$fromPath);
			$toPath		=	str_replace(DS.DS,DS,$toPath);
			// Explode working dir and cache dir into arrays
			$fromPathArray	=	explode(DS,$fromPath);
			$toPathArray	=	explode(DS,$toPath);
			// Remove last fromPath array element if it's empty
			$x = count($fromPathArray) - 1;

			if(!trim($fromPathArray[$x])){
				array_pop($fromPathArray);
			}
			// Remove last toPath array element if it's empty
			$x = count($toPathArray) - 1;
			if(!trim($toPathArray[$x])) {
				array_pop($toPathArray);
			}
			// Get largest array count
			$arrayMax = max(count($fromPathArray), count($toPathArray));
			// Set some default variables
			$diffArray = array();
			$samePath = true;
			$key = 1;
			// Generate array of the path differences
			while($key <= $arrayMax){
				// Get to path variable
				$toPath = isset($toPathArray[$key]) ? $toPathArray[$key] : null;
				// Get from path variable
				$fromPath = isset($fromPathArray[$key]) ? $fromPathArray[$key] : null;
				if($toPath !== $fromPath || $samePath !== true){
					// Prepend '..' for every level up that must be traversed
					if(isset($fromPathArray[$key])){
						array_unshift($diffArray,'..');
					}
					// Append directory name for every directory that must be traversed
					if(isset($toPathArray[$key])){
						$diffArray[] = $toPathArray[$key];
					}
					// Directory paths have diverged
					$samePath = false;
				}
				// Increment key
				$key++;
			}
			// Set the relative thumbnail directory path
			$relativePath = implode('/', $diffArray);

			// Return the relative path
			return $relativePath;
		}
	}