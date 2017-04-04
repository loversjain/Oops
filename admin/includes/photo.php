<?php


class Photo extends db_object{
	protected static $table="photos";
	protected static $class_properties =['photo_id','title','description','filename','type','size'];
	public $photo_id;
	public $title;
	public $description;
	public $filename;
	public $type;
	public $size;
	public $upload_directory ='upload';
	public $tmp_path;
	public $custom_error =[];
	// public $error = '';
	public $upload_error = [

	'UPLOAD_ERR_OK'=>'There is no error, the file uploaded with success.',
	'UPLOAD_ERR_INI_SIZE   '=>'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
	'UPLOAD_ERR_FORM_SIZE  '=>'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the 	
							HTML form.',
	'UPLOAD_ERR_PARTIAL    '=>'The uploaded file was only partially uploaded.',
	'UPLOAD_ERR_NO_FILE    '=>'No file was uploaded.',
	'UPLOAD_ERR_NO_TMP_DIR '=>'Missing a temporary folder.',
	'UPLOAD_ERR_CANT_WRITE '=>'Failed to write file to disk.',
	'UPLOAD_ERR_EXTENSION  '=>' A PHP extension stopped the file upload.'
		];

	public function set_file($file){
	
	if(empty($file || $file || !is_array($file))){
		$this->error[]="there is something error";
		return false;
	}
	elseif($file ['error'] != 0){
		$this->error[] = $this->upload_error[$file['error']];
		return false;
	}else{
	
			$this->filename =basename($file['name']);
			$this->tmp_path = $file['tmp_name'];
			$this->type = $file['type'];
			$this->size =$file['size'];

	}

	}
	public  function img_path(){
	return $this->upload_directory.DS.$this->filename;
	}

	public function save(){
		if($this->photo_id){
			$this->update();
		}else{
			if(!empty($this->error)){
				return false;
			}
		

		if(empty($this->filename) || empty($this->tmp_path)){
			$this->error[]='error in file name';
			return false;
		}
			$target_path = $this->upload_directory.DS.$this->filename;

			if(file_exists($target_path)){
				$this->error[]='file already exist. Try new one';
				return false;
			}
			if(move_uploaded_file($this->tmp_path, $target_path)){
				if($this->create()){
					unset($this->tmp_path);
					return true;
				}else{
					$this->error[]='Error is uploading';
				}
			}
		}
	}

	public function delete_img($id){
		if(is_numeric($id) && $id!='' && $id!=null){
		// $sql = "delete from ".self::$table. " where photo_id=$id";
			
		}
		return false;
	}


	}
?>