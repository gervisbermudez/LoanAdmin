<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MY_Controller {

        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
                $this->load->view('upload_form', array('error' => ' ' ));
        }


        public function do_upload_user_avatar($id_user)
        {
                $this->load->model('User_model');
                $user = new User_model();
                $user->map($id_user);

                $config['upload_path']          = IMGPATH.'profile';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['file_name']            = $user->username.'_avatar';
                $config['overwrite']            = TRUE;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $this->ShowError($this->upload->display_errors());
                }
                else
                {
                    $data = $this->upload->data();
                    $user->avatar = $user->username.'_avatar'.$data['file_ext'];
                    $user->update();

                    $curuser = $this->session->userdata('user')['id'];

                    if($id_user === $curuser){
                        $_SESSION['user']['avatar'] =  $user->username.'_avatar'.$data['file_ext'];
                    }

                    redirect('admin/user/view/'.$user->id.'?alert=update_avatar');

                }
        }
}
?>