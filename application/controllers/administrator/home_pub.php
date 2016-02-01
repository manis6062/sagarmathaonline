<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_pub extends CI_Controller {
	private $errors="";
	private $allowed=array();
	
	 public function __construct()
       {
            parent::__construct();
				checkAdminAuth();
            // Your own constructor code
			$this->load->library('form_validation');
			$this->load->library('pagination');
			$this->form_validation->set_error_delimiters('<div class="red">', '</div>');
			 $this->load->helper(array('form', 'url'));
			 $this->load->helper('path');
			 
			
			//$this->load->model('auth_master_model');
			//$this->load->model('user_auth_model');
			$this->allowed=$this->Auth_master_model->getAuth();
       }

	
	public function index()
	{
		$this->show($page='');	
		
	}
	
	function show($page='')
	{
		
		$data['photoList'] = $this->Pub_home_slider_model->getAll('all');
		
		$data['title']="Recent Publications";
		$data['main_content'] = ADMIN_PATH."publicationimagelist_view";
		$this->load->view(ADMIN_PATH.'include/template', $data);
	}
	
	
	function galleryPhoto($gid)
	{
		$this->showGalleryImage();
	}
	
	function deleteAction($id,$offset)
	{
		if(in_array('photo_update',$this->allowed))
		{
			//check before delete if it is admin user or currently loggged in user
			$details=$this->Pub_home_slider_model->getPhotoDetails($id);
			if($this->Pub_home_slider_model->deletePhoto($id))
			{
				$path = PUB_IMAGE_PATH;
				
				$this->removeFile($details->path,$path);
				
				$this->session->set_flashdata("su_message", "Publication Deleted Successfully.");
				
			}
			else
			{
				$this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Publication Can't Be Deleted.</font>");
			}
		}
		else
		{
			$this->session->set_flashdata("su_message", "You Have No Permission To Delete This Publication");
		}
		
		redirect(ADMIN_PATH."home_pub/show/$offset");
	}
	
	
	
	
	function addAction()
	{
		
		
		
		
		$masterauth=new Auth_master_model();
		
		$data['mas_auth']=$masterauth->getAllAuth();
		$data['error']=$this->errors;
		$data['title']="Add Recent Publication";
		
		$data['main_content'] = ADMIN_PATH."publication_image_add_view";
		$this->load->view(ADMIN_PATH.'include/template', $data);
	}
	
	function add()
	{
		
		if(in_array('photo_add',$this->allowed))
		{
			if ($this->form_validation->run('publication_home_add') == FALSE)
			{
				$this->addAction();
			}
			else
			{
				//files validations
				$photo=TRUE;
				$ph="";
				$path="";
				if($_FILES['pub_image']['name'])
				{
					$path = PUB_IMAGE_PATH;
					
					$uploaded_details = $this->upload('pub_image',"$path");
					
					
					if ($uploaded_details=="")
						{
							$error = array('error' => $this->upload->display_errors('<p>', '</p>'));
							//$this->form_validation->set_message('Basic Document', "error");
							$this->errors=$error;
				
							$photo=false;
						}
						else
						{
							$ph = $uploaded_details['file_name'];
						}
					
				}
				
				if($photo)
				{
					$this->Pub_home_slider_model->insert($ph);
				
					$this->session->set_flashdata("su_message", "Publication Addded Successfully.");
					redirect(ADMIN_PATH."home_pub/index");
				}
				else
				{
					$this->addAction();
				}
			}
		}
		else
		{
			$this->session->set_flashdata("su_message", "You Have No Permission To Add New Publication");
			redirect(ADMIN_PATH."home_pub/index");
		}
		
	}
	
	function update($offset)
	{
		if(in_array('photo_update',$this->allowed))
		{
			if ($this->form_validation->run('publication_home_edit') == FALSE)
			{
				$this->updateAction($this->input->post('pub_id'),$offset);
			}
			else
			{
				//files validations
				$photo=TRUE;
				
				$ph="";
				$oldph=$this->input->post('old_image');
				
				$path="";
				
				$path = PUB_IMAGE_PATH;
				
				if($_FILES['pub_image']['name'])
				{
					
					
					$uploaded_details = $this->upload('pub_image',"$path");
					
					
					if ($uploaded_details=="")
						{
							$error = array('error' => $this->upload->display_errors('<p>', '</p>'));
							//$this->form_validation->set_message('Basic Document', "error");
							$this->errors=$error;
				
							$photo=FALSE;
						}
						else
						{
							$ph = $uploaded_details['file_name'];
							
						}
					
				}
				
				if($photo)
				{
					
					if($ph !="")
					{
						
						$this->removeFile($oldph,$path);
						
					}
					else
					{
						
						$ph=$oldph;
					}
					
					$this->Pub_home_slider_model->update($this->input->post('pub_id'),$ph);
				
					$this->session->set_flashdata("su_message", "Recent Publication Updated Successfully.");
					redirect(ADMIN_PATH."home_pub/show/$offset");
				}
				else
				{
					$this->updateAction($this->input->post('pub_id'),$offset);
				}
			}
		}
		else
		{
			$this->session->set_flashdata("su_message", "You Have No Permission To Add New Recent Publication");
			redirect(ADMIN_PATH."home_pub/show/$offset");
		}
	}
	
	
	
	function updateAction($id,$offset)
	{
		
		$masterauth=new Auth_master_model();
		$data['error']=$this->errors;
		$data['photoRecord'] = $this->Pub_home_slider_model->getPhotoDetails($id);
		$data['title']="Update Recent Publication";
		$data['pub_id']=$id;
		$data['offset']=$offset;
		$data['main_content'] = ADMIN_PATH."publication_photo_update_view";
		
		
		$data['mas_auth']=$masterauth->getAllAuth();
		
		$this->load->view(ADMIN_PATH.'include/template', $data);
	}
	
	
	
	
	
	function upload($file,$path)
	{
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['overwrite'] = false;
		
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['encrypt_name']  = true;
		$config['remove_spaces']  = true;

		$this->load->library('upload', $config);
  		if($this->upload->do_upload($file))
		{
			//$data = $this->upload->data();
			//Image Resizing
			$config['image_library'] = 'gd2';
	        $config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
			$config['new_image'] = $path;
	        $config['maintain_ratio'] = TRUE;
	        $config['width'] = 660;
	        $config['height'] = 251;
			 $this->load->library('image_lib', $config);
			 if ($this->image_lib->resize()){
	           $data = $this->upload->data();         
	        }
			else
			{
				$data="";
			}
		}
		else
		{
			$data="";
		}
		
		return $data;
	}

	function removeFile($file,$path)
			{
			
			if(file_exists($path.$file) && $file!="")
				unlink($path.$file);
			
			}
			
			
	
	function changeStatus($id,$value,$offset)
	{
		$stat="";
		if($value=='Yes')
		{
			$stat='No';
		}
		else
		{
			$stat='Yes';
		}
		
		if($this->Pub_home_slider_model->updateStatus($id,$stat))
			{
				$this->session->set_flashdata("su_message", "Status Updated Successfully.");
				
			}
			else
			{
				$this->session->set_flashdata("su_message", "Status Updated Successfully.");
			
			}
			redirect(ADMIN_PATH."home_pub/show/$offset");
	}
	
	function ifupoad_check($str)
			{
				if(!$_FILES['pub_image']['name'])
				{
					$this->form_validation->set_message('ifupoad_check', 'No Image Uploaded');
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}
			
			
	
		
	
}


?>